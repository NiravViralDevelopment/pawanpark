<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function home()
    {
        // Get active banners ordered by order field
        $banners = \App\Models\Banner::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        // Get all projects for home page (latest first)
        $featuredProjects = Project::latest()
            ->get();
        
        // Get testimonials for home page (latest 6)
        $testimonials = \App\Models\Testimonial::latest()
            ->take(6)
            ->get();
        
        return view('home', compact('banners', 'featuredProjects', 'testimonials'));
    }

    public function about()
    {
        // Get all team members
        $teams = \App\Models\Team::latest()->get();
        
        return view('about', compact('teams'));
    }

    public function services()
    {
        return view('services');
    }

    public function project()
    {
        // Get all completed projects for projects page
        $projects = Project::where('is_completed', true)
            ->orWhere('is_ongoing', true)
            ->latest()
            ->paginate(12);
        
        return view('projects', compact('projects'));
    }

    public function projectDetail($id)
    {
        $project = Project::findOrFail($id);
        
        // Get related projects (same property type, excluding current)
        $relatedProjects = Project::where('property_type', $project->property_type)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();
        
        return view('project-detail', compact('project', 'relatedProjects'));
    }

    public function blog()
    {
        // Get all blogs paginated
        $blogs = \App\Models\Blog::latest('date')->paginate(9);
        
        return view('blog', compact('blogs'));
    }

    public function blogDetail($id)
    {
        // Get single blog post
        $blog = \App\Models\Blog::findOrFail($id);
        
        // Get related blogs (latest 3, excluding current)
        $relatedBlogs = \App\Models\Blog::where('id', '!=', $id)
            ->latest('date')
            ->take(3)
            ->get();
        
        return view('blog-detail', compact('blog', 'relatedBlogs'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function brochureDownload(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:10',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:1000',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Get the project
        $project = Project::findOrFail($validated['project_id']);

        // Store contact information
        \App\Models\Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'message' => $validated['message'] ?? 'Brochure download request for: ' . $project->title,
            'is_read' => false,
        ]);

        // Return success response with brochure URL
        return response()->json([
            'success' => true,
            'brochure_url' => asset($project->brochure),
            'message' => 'Thank you for your interest!',
        ]);
    }

    public function propertyContact(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:10',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string|max:1000',
            'property_name' => 'nullable|string|max:255',
        ]);

        // Create message with property name if provided
        $message = $validated['message'];
        if (!empty($validated['property_name'])) {
            $message = 'Property Inquiry for: ' . $validated['property_name'] . "\n\n" . $message;
        }

        // Store contact information
        \App\Models\Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'],
            'message' => $message,
            'is_read' => false,
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Thank you for your inquiry! We will contact you soon.',
        ]);
    }
}

