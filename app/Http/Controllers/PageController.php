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
        
        // Get featured projects for home page
        $featuredProjects = Project::where('is_featured', true)
            ->latest()
            ->take(6)
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
}

