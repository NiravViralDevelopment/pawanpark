@extends('admin.layouts.admin')

@section('title', 'Edit Team Member')
@section('page-title', 'Edit Team Member')

@section('content')
<div class="team-form-page">
    <div class="form-header">
        <a href="{{ route('admin.teams.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to Team Members
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Full Name <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name', $team->name) }}"
                        placeholder="Enter full name"
                        required
                    >
                    @error('name')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="position">Position / Role <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="position" 
                        name="position" 
                        class="form-control @error('position') is-invalid @enderror" 
                        value="{{ old('position', $team->position) }}"
                        placeholder="e.g., CEO, Project Manager, Sales Executive"
                        required
                    >
                    @error('position')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Photo</label>
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        class="form-control @error('image') is-invalid @enderror" 
                        accept="image/*"
                        onchange="previewImage(event)"
                    >
                    <small class="form-text">Recommended size: 500x500px (square). Max 5MB. Leave empty to keep current photo</small>
                    @error('image')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                    
                    <!-- Current Image -->
                    @if($team->image)
                        <div style="margin-top: 15px;">
                            <label>Current Photo:</label>
                            <div class="image-preview-container">
                                <img id="currentImage" src="{{ asset($team->image) }}" alt="{{ $team->name }}">
                            </div>
                        </div>
                    @endif
                    
                    <!-- New Image Preview -->
                    <div id="imagePreview" style="display: none; margin-top: 15px;">
                        <label>New Photo Preview:</label>
                        <div class="image-preview-container">
                            <img id="preview" src="" alt="Preview">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone_number">Phone Number <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="phone_number" 
                            name="phone_number" 
                            class="form-control @error('phone_number') is-invalid @enderror" 
                            value="{{ old('phone_number', $team->phone_number) }}"
                            placeholder="1234567890"
                            maxlength="10"
                            minlength="10"
                            required
                        >
                        <small class="form-text">Must be exactly 10 digits</small>
                        @error('phone_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="whatsapp_number">WhatsApp Number <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="whatsapp_number" 
                            name="whatsapp_number" 
                            class="form-control @error('whatsapp_number') is-invalid @enderror" 
                            value="{{ old('whatsapp_number', $team->whatsapp_number) }}"
                            placeholder="1234567890"
                            maxlength="10"
                            minlength="10"
                            required
                        >
                        <small class="form-text">Must be exactly 10 digits</small>
                        @error('whatsapp_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Team Member
                    </button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
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
    .team-form-page {
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

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
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

