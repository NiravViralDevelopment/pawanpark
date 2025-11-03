@extends('admin.layouts.admin')

@section('title', 'View Project')
@section('page-title', 'Project Details')

@section('content')
<div class="project-view-page">
    <!-- Header Actions -->
    <div class="page-header">
        <div class="header-left">
            <a href="{{ route('admin.projects.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Edit Project
            </a>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Project Title & Status -->
    <div class="card project-header">
        <div class="card-body">
            <div class="project-title-section">
                <h1 class="project-title">{{ $project->title }}</h1>
                <div class="status-badges">
                    @if($project->is_featured)
                        <span class="badge badge-warning">
                            <i class="fas fa-star"></i> Featured
                        </span>
                    @endif
                    @if($project->is_completed)
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle"></i> Completed
                        </span>
                    @endif
                    @if($project->is_ongoing)
                        <span class="badge badge-info">
                            <i class="fas fa-spinner"></i> Ongoing
                        </span>
                    @endif
                </div>
            </div>
            @if($project->location)
                <div class="project-location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $project->location }}
                </div>
            @endif
        </div>
    </div>

    <div class="content-grid">
        <!-- Left Column -->
        <div class="left-column">
            <!-- Project Images -->
            @if($project->images && count($project->images) > 0)
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-images"></i> Project Images</h3>
                    </div>
                    <div class="card-body">
                        <div class="images-gallery">
                            @foreach($project->images as $image)
                                <div class="gallery-item">
                                    <img src="{{ asset($image) }}" alt="{{ $project->title }}" onclick="openImageModal(this.src)">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Description -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-align-left"></i> Description</h3>
                </div>
                <div class="card-body">
                    <div class="description-text">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Features & Amenities -->
            @if($project->features_amenities && count($project->features_amenities) > 0)
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-list-check"></i> Features & Amenities</h3>
                    </div>
                    <div class="card-body">
                        <div class="features-grid">
                            @foreach($project->features_amenities as $feature)
                                <div class="feature-item">
                                    <i class="fas fa-check-circle"></i>
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Property Overview -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-home"></i> Property Overview</h3>
                </div>
                <div class="card-body">
                    <div class="overview-grid">
                        @if($project->bedrooms)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <div class="overview-details">
                                    <div class="overview-label">Bedrooms</div>
                                    <div class="overview-value">{{ $project->bedrooms }}</div>
                                </div>
                            </div>
                        @endif

                        @if($project->bathrooms)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-bath"></i>
                                </div>
                                <div class="overview-details">
                                    <div class="overview-label">Bathrooms</div>
                                    <div class="overview-value">{{ $project->bathrooms }}</div>
                                </div>
                            </div>
                        @endif

                        @if($project->sqft)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-ruler-combined"></i>
                                </div>
                                <div class="overview-details">
                                    <div class="overview-label">Square Feet</div>
                                    <div class="overview-value">{{ number_format($project->sqft) }} sqft</div>
                                </div>
                            </div>
                        @endif

                        @if($project->year_built)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="overview-details">
                                    <div class="overview-label">Year Built</div>
                                    <div class="overview-value">{{ $project->year_built }}</div>
                                </div>
                            </div>
                        @endif

                        @if($project->property_type)
                            <div class="overview-item">
                                <div class="overview-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="overview-details">
                                    <div class="overview-label">Property Type</div>
                                    <div class="overview-value">{{ $project->property_type }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Brochure -->
            @if($project->brochure)
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-file-pdf"></i> Project Brochure</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ asset($project->brochure) }}" target="_blank" class="brochure-link">
                            <div class="brochure-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="brochure-text">
                                <div class="brochure-title">Download Brochure</div>
                                <div class="brochure-subtitle">PDF Document</div>
                            </div>
                            <div class="brochure-action">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Project Info -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-info-circle"></i> Project Information</h3>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-label">Created</div>
                            <div class="info-value">{{ $project->created_at->format('F d, Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Last Updated</div>
                            <div class="info-value">{{ $project->updated_at->format('F d, Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Total Images</div>
                            <div class="info-value">{{ $project->images ? count($project->images) : 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="modal">
    <span class="modal-close" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
@endsection

@section('extra_css')
<style>
    .project-view-page {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-right {
        display: flex;
        gap: 10px;
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

    .btn {
        padding: 10px 20px;
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

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e5e5;
    }

    .card-header h3 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .card-header h3 i {
        color: #666;
    }

    .card-body {
        padding: 25px;
    }

    .project-header {
        margin-bottom: 25px;
    }

    .project-title-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .project-title {
        font-size: 32px;
        font-weight: 600;
        color: #333;
        margin: 0;
        flex: 1;
    }

    .status-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge {
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .badge-info {
        background: #d1ecf1;
        color: #0c5460;
    }

    .project-location {
        color: #666;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .project-location i {
        color: #dc3545;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .images-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .gallery-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    .gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .description-text {
        color: #555;
        line-height: 1.8;
        font-size: 15px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 6px;
        font-size: 14px;
        color: #333;
    }

    .feature-item i {
        color: #28a745;
    }

    .overview-grid {
        display: grid;
        gap: 15px;
    }

    .overview-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .overview-icon {
        width: 50px;
        height: 50px;
        background: #333;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        flex-shrink: 0;
    }

    .overview-details {
        flex: 1;
    }

    .overview-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .overview-value {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .brochure-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .brochure-link:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .brochure-icon {
        width: 60px;
        height: 60px;
        background: #dc3545;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 30px;
        flex-shrink: 0;
    }

    .brochure-text {
        flex: 1;
    }

    .brochure-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }

    .brochure-subtitle {
        font-size: 13px;
        color: #999;
    }

    .brochure-action {
        color: #666;
        font-size: 20px;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 6px;
    }

    .info-label {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .info-value {
        font-size: 14px;
        color: #333;
        font-weight: 600;
    }

    /* Image Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        animation: fadeIn 0.3s ease;
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 90%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 8px;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .modal-close:hover {
        color: #ddd;
    }

    .d-inline {
        display: inline;
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .header-right {
            width: 100%;
        }

        .header-right form {
            flex: 1;
        }

        .header-right .btn {
            flex: 1;
            justify-content: center;
        }

        .project-title {
            font-size: 24px;
        }

        .project-title-section {
            flex-direction: column;
            gap: 15px;
        }

        .images-gallery {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }

        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('extra_js')
<script>
    function openImageModal(src) {
        document.getElementById('imageModal').style.display = 'block';
        document.getElementById('modalImage').src = src;
    }

    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
    }

    // Close modal on click outside
    document.getElementById('imageModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>
@endsection

