@extends('admin.layouts.admin')

@section('title', 'Create Service')
@section('page-title', 'Add New Service')

@section('content')
<div class="service-form-page">
    <div class="form-header">
        <a href="{{ route('admin.services.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Services
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Title <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('title') }}"
                        placeholder="Enter service title"
                        required
                    >
                    @error('title')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        class="form-control @error('image') is-invalid @enderror" 
                        accept="image/*"
                        onchange="previewImage(event)"
                    >
                    <small class="form-text">Max 2MB. Formats: JPG, PNG, GIF, WEBP</small>
                    @error('image')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" style="display: none; margin-top: 15px;">
                        <label>Preview:</label>
                        <div class="image-preview-container">
                            <img id="preview" src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descriptions">Descriptions <span class="required">*</span></label>
                    <textarea 
                        id="descriptions" 
                        name="descriptions" 
                        class="form-control @error('descriptions') is-invalid @enderror" 
                        rows="6"
                        placeholder="Enter detailed description of the service..."
                        required
                    >{{ old('descriptions') }}</textarea>
                    @error('descriptions')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- SEO Meta Information --}}
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-search"></i>
                        SEO Meta Information
                    </h3>
                    <p class="section-description">Optimize service page for search engines and social media sharing.</p>
                    
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input 
                            type="text" 
                            id="meta_title" 
                            name="meta_title" 
                            class="form-control @error('meta_title') is-invalid @enderror" 
                            value="{{ old('meta_title') }}" 
                            placeholder="e.g., Property Buying Service | Gurukrupa Marketing"
                            maxlength="60"
                        >
                        <small class="form-text">Recommended: 50-60 characters. Leave blank to use default.</small>
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
                            placeholder="Brief description about the service..."
                            maxlength="160"
                        >{{ old('meta_description') }}</textarea>
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
                            value="{{ old('meta_keywords') }}" 
                            placeholder="service, real estate, property"
                        >
                        <small class="form-text">Separate keywords with commas.</small>
                        @error('meta_keywords')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .service-form-page {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-header {
        margin-bottom: 25px;
    }

    .btn-back {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }

    .btn-back:hover {
        color: #333;
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .required {
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
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
        font-size: 12px;
        margin-top: 5px;
    }

    .image-preview-container {
        width: 200px;
        height: 150px;
        border: 2px dashed #ddd;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9f9f9;
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .form-section {
        margin-top: 35px;
        padding-top: 35px;
        border-top: 2px solid #f0f0f0;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #c49b63;
    }

    .section-description {
        color: #666;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #f0f0f0;
    }

    .btn {
        padding: 12px 28px;
        border-radius: 6px;
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #333;
        color: white;
    }

    .btn-primary:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
        background: #f0f0f0;
        color: #666;
    }

    .btn-secondary:hover {
        background: #e0e0e0;
        color: #333;
    }
</style>
@endsection

@section('extra_js')
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

