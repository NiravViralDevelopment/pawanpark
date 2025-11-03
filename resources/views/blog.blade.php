@extends('layouts.app')

@section('title', 'Blog - Luxury Villas')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('{{ asset('assets/images/Media (7).jpg') }}');"></div>
    <div class="page-header-content">
        <div class="container">
            <h1>Our Blog</h1>
            <p>Insights, trends, and news from the luxury real estate world</p>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section">
    <div class="container">
        @if($blogs->count() > 0)
            <div class="blog-grid">
                @foreach($blogs as $blog)
                    <article class="blog-card">
                        <div class="blog-image">
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80" alt="{{ $blog->title }}">
                            @endif
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> {{ $blog->date->format('F d, Y') }}</span>
                                <span><i class="far fa-user"></i> {{ $blog->posted_by }}</span>
                            </div>
                            <h3>{{ $blog->title }}</h3>
                            <p>{{ Str::limit($blog->description, 150) }}</p>
                            <a href="{{ route('blog.detail', $blog->id) }}" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Laravel Pagination -->
            @if($blogs->hasPages())
                <div class="pagination">
                    @if ($blogs->onFirstPage())
                        <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i> Previous</button>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}" class="pagination-btn"><i class="fas fa-chevron-left"></i> Previous</a>
                    @endif

                    <div class="pagination-numbers">
                        @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                            @if ($i == $blogs->currentPage())
                                <span class="pagination-number active">{{ $i }}</span>
                            @else
                                <a href="{{ $blogs->url($i) }}" class="pagination-number">{{ $i }}</a>
                            @endif
                        @endfor
                    </div>

                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" class="pagination-btn">Next <i class="fas fa-chevron-right"></i></a>
                    @else
                        <button class="pagination-btn" disabled>Next <i class="fas fa-chevron-right"></i></button>
                    @endif
                </div>
            @endif
        @else
            <div class="empty-state" style="text-align: center; padding: 60px 20px;">
                <i class="fas fa-blog" style="font-size: 60px; color: #ddd; margin-bottom: 20px;"></i>
                <h3 style="font-size: 22px; color: #333; margin-bottom: 10px;">No Blog Posts Yet</h3>
                <p style="color: #999;">Check back soon for new articles and updates.</p>
            </div>
        @endif
    </div>
</section>
@endsection

