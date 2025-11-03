@extends('layouts.app')

@section('title', 'Projects - Luxury Villas')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1920&q=80');"></div>
    <div class="page-header-content">
        <div class="container">
            <h1>Our Projects</h1>
            <p>Explore our exclusive collection of luxury villas</p>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section class="projects-section">
    <div class="container">
        @if($projects->count() > 0)
            <div class="villas-grid">
                @foreach($projects as $project)
                    <div class="villa-card">
                        <div class="villa-image">
                            @if($project->images && count($project->images) > 0)
                                <img src="{{ asset($project->images[0]) }}" alt="{{ $project->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80" alt="{{ $project->title }}">
                            @endif
                            
                            @if($project->is_featured)
                                <div class="villa-badge">Featured</div>
                            @elseif($project->is_ongoing)
                                <div class="villa-badge">Ongoing</div>
                            @elseif($project->is_completed)
                                <div class="villa-badge">Completed</div>
                            @endif
                        </div>
                        <div class="villa-info">
                            <h3>{{ $project->title }}</h3>
                            
                            @if($project->location)
                                <p class="villa-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $project->location }}
                                </p>
                            @endif
                            
                            <p class="villa-description">
                                {{ Str::limit($project->description, 150) }}
                            </p>
                            
                            <div class="villa-features">
                                @if($project->bedrooms)
                                    <span><i class="fas fa-bed"></i> {{ $project->bedrooms }} Beds</span>
                                @endif
                                
                                @if($project->bathrooms)
                                    <span><i class="fas fa-bath"></i> {{ $project->bathrooms }} Baths</span>
                                @endif
                                
                                @if($project->sqft)
                                    <span><i class="fas fa-ruler-combined"></i> {{ number_format($project->sqft) }} sqft</span>
                                @endif
                            </div>
                            
                            <div class="villa-footer">
                                @if($project->property_type)
                                    <span class="villa-type">{{ $project->property_type }}</span>
                                @endif
                                <a href="{{ route('project.detail', $project->id) }}" class="btn btn-secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="pagination-container">
                    <div class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($projects->onFirstPage())
                            <span class="page-link disabled">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $projects->previousPageUrl() }}" class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $projects->lastPage(); $i++)
                            @if ($i == $projects->currentPage())
                                <span class="page-link active">{{ $i }}</span>
                            @else
                                <a href="{{ $projects->url($i) }}" class="page-link">{{ $i }}</a>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($projects->hasMorePages())
                            <a href="{{ $projects->nextPageUrl() }}" class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="page-link disabled">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                    
                    <div class="pagination-info">
                        Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} properties
                    </div>
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-home"></i>
                <h3>No Projects Available</h3>
                <p>Please check back later for new luxury properties.</p>
            </div>
        @endif
    </div>
</section>

<style>
.pagination-container {
    margin-top: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.pagination {
    display: flex;
    align-items: center;
    gap: 8px;
}

.page-link {
    min-width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    background: white;
}

.page-link:hover:not(.disabled):not(.active) {
    background: #f8f9fa;
    border-color: #333;
    color: #333;
    transform: translateY(-2px);
}

.page-link.active {
    background: #2c3e50;
    color: white;
    border-color: #2c3e50;
}

.page-link.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: #f8f9fa;
}

.pagination-info {
    font-size: 14px;
    color: #666;
}

.projects-section .villa-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 20px;
    flex-wrap: wrap;
    gap: 12px;
}

.villa-type {
    font-size: 13px;
    color: #c49b63;
    font-weight: 600;
    padding: 6px 16px;
    background: #faf6f0;
    border: 1px solid #e5d4b8;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-transform: capitalize;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-state i {
    font-size: 80px;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 28px;
    color: #333;
    margin-bottom: 10px;
}

.empty-state p {
    font-size: 16px;
    color: #999;
}

@media (max-width: 768px) {
    .projects-section .villa-footer {
        flex-direction: column;
        align-items: stretch;
    }
    
    .villa-type {
        text-align: center;
        justify-content: center;
    }
    
    .projects-section .villa-footer .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
