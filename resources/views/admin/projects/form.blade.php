{{-- Basic Information --}}
<div class="form-section">
    <h3 class="section-title">Basic Information</h3>
    
    <div class="form-group">
        <label for="title">Project Title <span class="required">*</span></label>
        <input 
            type="text" 
            id="title" 
            name="title" 
            class="form-control @error('title') is-invalid @enderror" 
            value="{{ old('title', $project->title ?? '') }}" 
            required
        >
        @error('title')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description <span class="required">*</span></label>
        <textarea 
            id="description" 
            name="description" 
            class="form-control @error('description') is-invalid @enderror" 
            rows="5" 
            required
        >{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="location">Location</label>
        <input 
            type="text" 
            id="location" 
            name="location" 
            class="form-control @error('location') is-invalid @enderror" 
            value="{{ old('location', $project->location ?? '') }}" 
            placeholder="e.g., Beverly Hills, CA"
        >
        @error('location')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="location_iframe">
            <i class="fas fa-map-marker-alt"></i>
            Location Map (Iframe Embed Code)
        </label>
        <textarea 
            id="location_iframe" 
            name="location_iframe" 
            class="form-control @error('location_iframe') is-invalid @enderror" 
            rows="4" 
            placeholder="Paste Google Maps iframe embed code here..."
        >{{ old('location_iframe', $project->location_iframe ?? '') }}</textarea>
        <small class="form-text">Paste the full iframe embed code from Google Maps or other mapping services</small>
        @error('location_iframe')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- Images --}}
<div class="form-section">
    <h3 class="section-title">Project Images</h3>
    
    <div class="form-group">
        <label for="images">Upload Images (Multiple allowed)</label>
        <input 
            type="file" 
            id="images" 
            name="images[]" 
            class="form-control @error('images.*') is-invalid @enderror" 
            multiple 
            accept="image/*"
        >
        <small class="form-text">You can select multiple images. Max 2MB per image. Formats: JPG, PNG, GIF</small>
        @error('images.*')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    @if(isset($project) && $project->images && count($project->images) > 0)
        <div class="existing-images">
            <label>Existing Images</label>
            <div class="images-grid">
                @foreach($project->images as $index => $image)
                    <div class="image-item">
                        <img src="{{ asset($image) }}" alt="Project Image">
                        <a href="{{ route('admin.projects.delete-image', $project) }}?image_index={{ $index }}" 
                           class="btn-delete-image" 
                           onclick="event.preventDefault(); if(confirm('Delete this image?')) { deleteImage({{ $project->id }}, {{ $index }}); }">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

{{-- Brochure --}}
<div class="form-section">
    <h3 class="section-title">Project Brochure</h3>
    
    <div class="form-group">
        <label for="brochure">Upload Brochure (PDF)</label>
        <input 
            type="file" 
            id="brochure" 
            name="brochure" 
            class="form-control @error('brochure') is-invalid @enderror" 
            accept=".pdf"
        >
        <small class="form-text">PDF file only. Max 10MB</small>
        @error('brochure')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    @if(isset($project) && $project->brochure)
        <div class="existing-file">
            <i class="fas fa-file-pdf"></i>
            <a href="{{ asset($project->brochure) }}" target="_blank">View Current Brochure</a>
        </div>
    @endif
</div>

{{-- Video --}}
<div class="form-section">
    <h3 class="section-title">Project Video</h3>
    
    <div class="form-group">
        <label for="video">
            <i class="fas fa-video"></i>
            Upload Video
        </label>
        <input 
            type="file" 
            id="video" 
            name="video" 
            class="form-control @error('video') is-invalid @enderror" 
            accept="video/*"
        >
        <small class="form-text">Video file. Max 50MB. Formats: MP4, AVI, MOV, WMV</small>
        @error('video')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    @if(isset($project) && $project->video)
        <div class="existing-file">
            <i class="fas fa-file-video"></i>
            <a href="{{ asset($project->video) }}" target="_blank">View Current Video</a>
            <div class="video-preview" style="margin-top: 10px;">
                <video controls style="max-width: 400px; width: 100%; border-radius: 4px;">
                    <source src="{{ asset($project->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    @endif
</div>

{{-- Status --}}
<div class="form-section">
    <h3 class="section-title">Project Status</h3>
    
    <div class="checkbox-group">
        <div class="checkbox-item">
            <input 
                type="checkbox" 
                id="is_featured" 
                name="is_featured" 
                value="1"
                {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}
            >
            <label for="is_featured">
                <i class="fas fa-star"></i>
                Featured Project
            </label>
        </div>

        <div class="checkbox-item">
            <input 
                type="checkbox" 
                id="is_completed" 
                name="is_completed" 
                value="1"
                {{ old('is_completed', $project->is_completed ?? false) ? 'checked' : '' }}
            >
            <label for="is_completed">
                <i class="fas fa-check-circle"></i>
                Completed
            </label>
        </div>

        <div class="checkbox-item">
            <input 
                type="checkbox" 
                id="is_ongoing" 
                name="is_ongoing" 
                value="1"
                {{ old('is_ongoing', $project->is_ongoing ?? false) ? 'checked' : '' }}
            >
            <label for="is_ongoing">
                <i class="fas fa-spinner"></i>
                Ongoing
            </label>
        </div>
    </div>
</div>

{{-- Features & Amenities --}}
<div class="form-section">
    <h3 class="section-title">Features & Amenities</h3>
    
    <div class="checkbox-group">
        @php
            $allFeatures = [
                'Swimming Pool',
                'Gym',
                'Garden',
                'Parking',
                'Security',
                'Elevator',
                'Balcony',
                'Terrace',
                'Clubhouse',
                'Kids Play Area',
                'Power Backup',
                'CCTV',
            ];
            $selectedFeatures = old('features_amenities', $project->features_amenities ?? []);
        @endphp

        @foreach($allFeatures as $feature)
            <div class="checkbox-item">
                <input 
                    type="checkbox" 
                    id="feature_{{ $loop->index }}" 
                    name="features_amenities[]" 
                    value="{{ $feature }}"
                    {{ in_array($feature, $selectedFeatures) ? 'checked' : '' }}
                >
                <label for="feature_{{ $loop->index }}">
                    {{ $feature }}
                </label>
            </div>
        @endforeach
    </div>
</div>

{{-- Property Overview --}}
<div class="form-section">
    <h3 class="section-title">Property Overview</h3>
    
    <div class="form-row">
        <div class="form-group">
            <label for="bedrooms">
                <i class="fas fa-bed"></i>
                Bedrooms
            </label>
            <input 
                type="number" 
                id="bedrooms" 
                name="bedrooms" 
                class="form-control @error('bedrooms') is-invalid @enderror" 
                value="{{ old('bedrooms', $project->bedrooms ?? '') }}" 
                min="0"
            >
            @error('bedrooms')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="bathrooms">
                <i class="fas fa-bath"></i>
                Bathrooms
            </label>
            <input 
                type="number" 
                id="bathrooms" 
                name="bathrooms" 
                class="form-control @error('bathrooms') is-invalid @enderror" 
                value="{{ old('bathrooms', $project->bathrooms ?? '') }}" 
                min="0"
            >
            @error('bathrooms')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="sqft">
                <i class="fas fa-ruler-combined"></i>
                Square Feet
            </label>
            <input 
                type="number" 
                id="sqft" 
                name="sqft" 
                class="form-control @error('sqft') is-invalid @enderror" 
                value="{{ old('sqft', $project->sqft ?? '') }}" 
                min="0" 
                step="0.01"
            >
            @error('sqft')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="year_built">
                <i class="fas fa-calendar"></i>
                Year Built
            </label>
            <input 
                type="number" 
                id="year_built" 
                name="year_built" 
                class="form-control @error('year_built') is-invalid @enderror" 
                value="{{ old('year_built', $project->year_built ?? '') }}" 
                min="1800" 
                max="{{ date('Y') + 1 }}"
            >
            @error('year_built')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="property_type">
            <i class="fas fa-home"></i>
            Property Type
        </label>
        <select 
            id="property_type" 
            name="property_type" 
            class="form-control @error('property_type') is-invalid @enderror"
        >
            <option value="">Select Type</option>
            <option value="Villa" {{ old('property_type', $project->property_type ?? '') == 'Villa' ? 'selected' : '' }}>Villa</option>
            <option value="Apartment" {{ old('property_type', $project->property_type ?? '') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
            <option value="Penthouse" {{ old('property_type', $project->property_type ?? '') == 'Penthouse' ? 'selected' : '' }}>Penthouse</option>
            <option value="Mansion" {{ old('property_type', $project->property_type ?? '') == 'Mansion' ? 'selected' : '' }}>Mansion</option>
            <option value="Estate" {{ old('property_type', $project->property_type ?? '') == 'Estate' ? 'selected' : '' }}>Estate</option>
            <option value="Townhouse" {{ old('property_type', $project->property_type ?? '') == 'Townhouse' ? 'selected' : '' }}>Townhouse</option>
        </select>
        @error('property_type')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- SEO Meta Information --}}
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-search"></i>
        SEO Meta Information
    </h3>
    <p class="section-description">Optimize your project for search engines. These fields help improve visibility in search results.</p>
    
    <div class="form-group">
        <label for="meta_title">Meta Title</label>
        <input 
            type="text" 
            id="meta_title" 
            name="meta_title" 
            class="form-control @error('meta_title') is-invalid @enderror" 
            value="{{ old('meta_title', $project->meta_title ?? '') }}" 
            placeholder="e.g., Luxury Villa in Beverly Hills | Premium Real Estate"
            maxlength="60"
        >
        <small class="form-text">Recommended: 50-60 characters. Leave blank to use project title.</small>
        @error('meta_title')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <textarea 
            id="meta_description" 
            name="meta_description" 
            class="form-control @error('meta_description') is-invalid @enderror" 
            rows="3"
            placeholder="Brief description of the property for search results..."
            maxlength="160"
        >{{ old('meta_description', $project->meta_description ?? '') }}</textarea>
        <small class="form-text">Recommended: 150-160 characters. This appears in search results.</small>
        @error('meta_description')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="meta_keywords">Meta Keywords</label>
        <input 
            type="text" 
            id="meta_keywords" 
            name="meta_keywords" 
            class="form-control @error('meta_keywords') is-invalid @enderror" 
            value="{{ old('meta_keywords', $project->meta_keywords ?? '') }}" 
            placeholder="luxury villa, beverly hills, real estate, property"
        >
        <small class="form-text">Separate keywords with commas. Example: luxury villa, beverly hills, real estate</small>
        @error('meta_keywords')
            <div class="error-text">{{ $message }}</div>
        @enderror
    </div>
</div>

<style>
    .form-section {
        margin-bottom: 35px;
        padding-bottom: 35px;
        border-bottom: 1px solid #e5e5e5;
    }

    .form-section:last-of-type {
        border-bottom: none;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .form-group label i {
        color: #666;
        margin-right: 5px;
    }

    .required {
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.2s;
        outline: none;
    }

    .form-control:focus {
        border-color: #333;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .form-text {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #999;
    }

    .error-text {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .checkbox-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .checkbox-item label {
        margin: 0;
        cursor: pointer;
        font-weight: 400;
        font-size: 14px;
    }

    .existing-images {
        margin-top: 15px;
    }

    .existing-images label {
        display: block;
        font-weight: 500;
        color: #333;
        margin-bottom: 10px;
    }

    .images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 15px;
    }

    .image-item {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .image-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        display: block;
    }

    .delete-image-form {
        position: absolute;
        top: 5px;
        right: 5px;
    }

    .btn-delete-image {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: none;
        color: #dc3545;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-delete-image:hover {
        background: #dc3545;
        color: white;
    }

    .existing-file {
        margin-top: 10px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .existing-file i {
        color: #dc3545;
        font-size: 20px;
    }

    .existing-file a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
    }

    .existing-file a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .checkbox-group {
            grid-template-columns: 1fr;
        }

        .images-grid {
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        }
    }
</style>

