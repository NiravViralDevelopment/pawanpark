<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Ensure upload directory exists
     */
    private function ensureDirectoryExists()
    {
        $directory = public_path('testimonials');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->ensureDirectoryExists();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('testimonials'), $fileName);
            $imagePath = 'testimonials/' . $fileName;
        }

        // Create testimonial
        Testimonial::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'rating' => $validated['rating'],
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $this->ensureDirectoryExists();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Handle image upload
        $imagePath = $testimonial->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }
            $fileName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('testimonials'), $fileName);
            $imagePath = 'testimonials/' . $fileName;
        }

        // Update testimonial
        $testimonial->update([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'rating' => $validated['rating'],
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete image
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }
}

