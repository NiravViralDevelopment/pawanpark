<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of all contact submissions
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Search by name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Search by email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Search by phone
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'read') {
                $query->where('is_read', true);
            } elseif ($request->status === 'unread') {
                $query->where('is_read', false);
            }
        }

        // Search in message
        if ($request->filled('message')) {
            $query->where('message', 'like', '%' . $request->message . '%');
        }

        $contacts = $query->latest()->paginate(15)->withQueryString();
        
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified contact
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing a contact
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the contact with follow-up reason
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        
        $request->validate([
            'follow_up_reason' => 'required|string|max:1000',
        ]);
        
        $contact->update([
            'follow_up_reason' => $request->follow_up_reason,
        ]);
        
        return redirect()->route('admin.contacts.show', $contact->id)
            ->with('success', 'Follow-up reason added successfully.');
    }

    /**
     * Mark contact as read/unread
     */
    public function toggleRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => !$contact->is_read]);
        
        return back()->with('success', 'Contact status updated successfully.');
    }

    /**
     * Delete a contact
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Export contacts to CSV
     */
    public function export(Request $request)
    {
        $query = Contact::query();

        // Apply same filters as index
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'read') {
                $query->where('is_read', true);
            } elseif ($request->status === 'unread') {
                $query->where('is_read', false);
            }
        }

        if ($request->filled('message')) {
            $query->where('message', 'like', '%' . $request->message . '%');
        }

        $contacts = $query->latest()->get();

        // Generate CSV
        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Message', 'Status', 'Received Date']);

            // Add data rows
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->message,
                    $contact->is_read ? 'Read' : 'Unread',
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
