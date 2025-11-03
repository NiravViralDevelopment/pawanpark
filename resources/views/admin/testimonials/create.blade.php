@extends('admin.layouts.admin')

@section('title', 'Create Testimonial')
@section('page-title', 'Add New Testimonial')

@section('content')
<div class="testimonial-form-page">
    <div class="form-header">
        <a href="{{ route('admin.testimonials.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="name">Customer Name <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}"
                        placeholder="Enter customer name"
                        required
                    >
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position">Position / Title <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="position" 
                        name="position" 
                        class="form-control @error('position') is-invalid @enderror" 
                        value="{{ old('position') }}"
                        placeholder="e.g., CEO at ABC Company, Home Owner, Real Estate Investor"
                        required
                    >
                    @error('position')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Testimonial / Review <span class="required">*</span></label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="5"
                        placeholder="Enter customer testimonial or review..."
                        required
                    >{{ old('description') }}</textarea>
                    <small class="form-text">Minimum 10 characters</small>
                    @error('description')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Customer Photo <span class="required">*</span></label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        class="form-control @error('image') is-invalid @enderror" 
                        accept="image/*"
                        required
                        onchange="previewImage(event)"
                    >
                    <small class="form-text">Recommended size: 500x500px (square). Max 5MB. Formats: JPG, PNG, GIF, WEBP</small>
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
                    <label for="rating">Rating <span class="required">*</span></label>
                    <div class="rating-selector">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="star-label" data-rating="{{ $i }}">
                                <input 
                                    type="radio" 
                                    name="rating" 
                                    value="{{ $i }}" 
                                    {{ old('rating') == $i ? 'checked' : '' }}
                                    {{ $i == 5 && !old('rating') ? 'checked' : '' }}
                                    required
                                >
                                <i class="fas fa-star"></i>
                            </label>
                        @endfor
                    </div>
                    <small class="form-text">Click on stars to select rating (1-5 stars)</small>
                    @error('rating')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
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
    .testimonial-form-page {
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
        font-family: inherit;
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

    .image-preview-container {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .rating-selector {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-top: 10px;
    }

    .star-label {
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    .star-label input[type="radio"] {
        display: none;
    }

    .star-label i {
        font-size: 32px;
        color: #ddd;
        transition: all 0.2s;
    }

    .star-label:hover i,
    .star-label input[type="radio"]:checked ~ i {
        color: #ffc107;
        transform: scale(1.1);
    }

    .star-label input[type="radio"]:checked ~ i {
        color: #ffc107;
    }

    /* Show filled stars for all labels up to the checked one */
    .rating-selector:has(input[value="1"]:checked) .star-label[data-rating="1"] i {
        color: #ffc107;
    }

    .rating-selector:has(input[value="2"]:checked) .star-label[data-rating="1"] i,
    .rating-selector:has(input[value="2"]:checked) .star-label[data-rating="2"] i {
        color: #ffc107;
    }

    .rating-selector:has(input[value="3"]:checked) .star-label[data-rating="1"] i,
    .rating-selector:has(input[value="3"]:checked) .star-label[data-rating="2"] i,
    .rating-selector:has(input[value="3"]:checked) .star-label[data-rating="3"] i {
        color: #ffc107;
    }

    .rating-selector:has(input[value="4"]:checked) .star-label[data-rating="1"] i,
    .rating-selector:has(input[value="4"]:checked) .star-label[data-rating="2"] i,
    .rating-selector:has(input[value="4"]:checked) .star-label[data-rating="3"] i,
    .rating-selector:has(input[value="4"]:checked) .star-label[data-rating="4"] i {
        color: #ffc107;
    }

    .rating-selector:has(input[value="5"]:checked) .star-label i {
        color: #ffc107;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid #e5e5e5;
    }

    .btn {
        padding: 12px 24px;
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
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }
</style>
@endsection

@section('extra_js')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection

