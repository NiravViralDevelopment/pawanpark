<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Ensure upload directories exist
     */
    private function ensureDirectoriesExist()
    {
        $directories = [
            public_path('projects/images'),
            public_path('projects/brochures'),
            public_path('projects/videos'),
        ];

        foreach ($directories as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->ensureDirectoriesExist();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brochure' => 'nullable|mimes:pdf|max:10240',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv,flv,mkv|max:51200',
            'location' => 'nullable|string|max:255',
            'location_iframe' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'sqft' => 'nullable|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'property_type' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // Handle multiple image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('projects/images'), $fileName);
                $imagePaths[] = 'projects/images/' . $fileName;
            }
        }

        // Handle brochure upload
        $brochurePath = null;
        if ($request->hasFile('brochure')) {
            $fileName = time() . '_' . uniqid() . '.' . $request->file('brochure')->getClientOriginalExtension();
            $request->file('brochure')->move(public_path('projects/brochures'), $fileName);
            $brochurePath = 'projects/brochures/' . $fileName;
        }

        // Handle video upload
        $videoPath = null;
        if ($request->hasFile('video')) {
            $fileName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('projects/videos'), $fileName);
            $videoPath = 'projects/videos/' . $fileName;
        }

        // Create project
        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'images' => $imagePaths,
            'brochure' => $brochurePath,
            'video' => $videoPath,
            'is_featured' => $request->has('is_featured'),
            'is_completed' => $request->has('is_completed'),
            'is_ongoing' => $request->has('is_ongoing'),
            'location' => $validated['location'] ?? null,
            'location_iframe' => $validated['location_iframe'] ?? null,
            'features_amenities' => $request->input('features_amenities', []),
            'bedrooms' => $validated['bedrooms'] ?? null,
            'bathrooms' => $validated['bathrooms'] ?? null,
            'sqft' => $validated['sqft'] ?? null,
            'year_built' => $validated['year_built'] ?? null,
            'property_type' => $validated['property_type'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->ensureDirectoriesExist();
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brochure' => 'nullable|mimes:pdf|max:10240',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv,flv,mkv|max:51200',
            'location' => 'nullable|string|max:255',
            'location_iframe' => 'nullable|string',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'sqft' => 'nullable|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'property_type' => 'nullable|string|max:100',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
        ]);
        
        \Log::info('Validation passed');

        // Handle multiple image uploads
        $imagePaths = $project->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('projects/images'), $fileName);
                $imagePaths[] = 'projects/images/' . $fileName;
            }
        }

        // Handle brochure upload
        $brochurePath = $project->brochure;
        if ($request->hasFile('brochure')) {
            // Delete old brochure
            if ($project->brochure && file_exists(public_path($project->brochure))) {
                unlink(public_path($project->brochure));
            }
            $fileName = time() . '_' . uniqid() . '.' . $request->file('brochure')->getClientOriginalExtension();
            $request->file('brochure')->move(public_path('projects/brochures'), $fileName);
            $brochurePath = 'projects/brochures/' . $fileName;
        }

        // Handle video upload
        $videoPath = $project->video;
        if ($request->hasFile('video')) {
            // Delete old video
            if ($project->video && file_exists(public_path($project->video))) {
                unlink(public_path($project->video));
            }
            $fileName = time() . '_' . uniqid() . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('projects/videos'), $fileName);
            $videoPath = 'projects/videos/' . $fileName;
        }

        // Update project (explicitly set checkboxes to handle unchecked state)
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->images = $imagePaths;
        $project->brochure = $brochurePath;
        $project->video = $videoPath;
        $project->is_featured = $request->has('is_featured') ? 1 : 0;
        $project->is_completed = $request->has('is_completed') ? 1 : 0;
        $project->is_ongoing = $request->has('is_ongoing') ? 1 : 0;
        $project->location = $validated['location'] ?? null;
        $project->location_iframe = $validated['location_iframe'] ?? null;
        $project->features_amenities = $request->input('features_amenities', []);
        $project->bedrooms = $validated['bedrooms'] ?? null;
        $project->bathrooms = $validated['bathrooms'] ?? null;
        $project->sqft = $validated['sqft'] ?? null;
        $project->year_built = $validated['year_built'] ?? null;
        $project->property_type = $validated['property_type'] ?? null;
        $project->meta_title = $validated['meta_title'] ?? null;
        $project->meta_description = $validated['meta_description'] ?? null;
        $project->meta_keywords = $validated['meta_keywords'] ?? null;
        $project->save();
        
        \Log::info('Project updated successfully. ID: ' . $project->id);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete images
        if ($project->images) {
            foreach ($project->images as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        // Delete brochure
        if ($project->brochure && file_exists(public_path($project->brochure))) {
            unlink(public_path($project->brochure));
        }

        // Delete video
        if ($project->video && file_exists(public_path($project->video))) {
            unlink(public_path($project->video));
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Delete a specific image from a project
     */
    public function deleteImage(Request $request, Project $project)
    {
        $imageIndex = $request->input('image_index');
        $images = $project->images ?? [];

        if (isset($images[$imageIndex])) {
            // Delete file from public folder
            if (file_exists(public_path($images[$imageIndex]))) {
                unlink(public_path($images[$imageIndex]));
            }
            
            // Remove from array
            unset($images[$imageIndex]);
            $images = array_values($images); // Re-index array
            
            // Update project
            $project->update(['images' => $images]);
        }

        return back()->with('success', 'Image deleted successfully!');
    }
}
