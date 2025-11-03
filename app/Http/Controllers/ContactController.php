<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Normalize phone number (remove spaces)
        $phone = str_replace(' ', '', $request->phone ?? '');
        
        $validator = Validator::make([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'message' => $request->message,
        ], [
            'name' => 'required|string|min:2|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => ['required', 'string', 'max:15', 'regex:/^(\+91|91|0)?[6-9]\d{9}$/'],
            'message' => 'nullable|string',
        ], [
            'phone.regex' => 'Please enter a valid Indian phone number (10 digits starting with 6-9). Formats: +91XXXXXXXXXX, 91XXXXXXXXXX, 0XXXXXXXXXX, or XXXXXXXXXX',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        Contact::create([
            'name' => $request->name,
            'email' => $request->email ?: null,
            'phone' => $phone,
            'message' => $request->message ?: null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting us! We\'ll get back to you within 24 hours.'
        ]);
    }
}
