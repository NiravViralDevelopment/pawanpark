@extends('layouts.app')

@section('title', $blog->title . ' - Luxury Villas Blog')

@section('content')
<!-- Blog Header -->
<section class="blog-detail-header">
    @if($blog->image)
        <div class="blog-detail-header-bg" style="background-image: url('{{ asset($blog->image) }}');"></div>
    @else
        <div class="blog-detail-header-bg" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1920&q=80');"></div>
    @endif
    <div class="blog-detail-header-overlay"></div>
    <div class="blog-detail-header-content">
        <div class="container">
            <div class="blog-detail-meta">
                <span><i class="far fa-calendar"></i> {{ $blog->date->format('F d, Y') }}</span>
                <span><i class="far fa-user"></i> {{ $blog->posted_by }}</span>
            </div>
            <h1>{{ $blog->title }}</h1>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="blog-detail-content">
    <div class="container">
        <div class="blog-detail-layout">
            <!-- Main Content -->
            <div class="blog-detail-main">
                <article class="blog-article">
                    <div class="blog-article-content">
                        {!! nl2br(e($blog->description)) !!}
                    </div>
                </article>

                <!-- Navigation -->
                <div class="blog-navigation">
                    <a href="{{ route('blog') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Blog
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="blog-detail-sidebar">
                <!-- Related Posts -->
                @if($relatedBlogs->count() > 0)
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Related Articles</h3>
                        <div class="related-posts">
                            @foreach($relatedBlogs as $relatedBlog)
                                <article class="related-post">
                                    <div class="related-post-image">
                                        @if($relatedBlog->image)
                                            <img src="{{ asset($relatedBlog->image) }}" alt="{{ $relatedBlog->title }}">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400&q=80" alt="{{ $relatedBlog->title }}">
                                        @endif
                                    </div>
                                    <div class="related-post-content">
                                        <h4><a href="{{ route('blog.detail', $relatedBlog->id) }}">{{ $relatedBlog->title }}</a></h4>
                                        <div class="related-post-meta">
                                            <i class="far fa-calendar"></i> {{ $relatedBlog->date->format('M d, Y') }}
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Contact CTA -->
                <div class="sidebar-widget sidebar-cta">
                    <h3>Looking for Your Dream Villa?</h3>
                    <p>Get in touch with our luxury real estate experts today.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
    .blog-detail-header {
        position: relative;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .blog-detail-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
    }

    .blog-detail-header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
    }

    .blog-detail-header-content {
        position: relative;
        z-index: 1;
        width: 100%;
        text-align: center;
        color: white;
    }

    .blog-detail-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .blog-detail-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .blog-detail-header h1 {
        font-size: 48px;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
        max-width: 900px;
        margin: 0 auto;
    }

    .blog-detail-content {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .blog-detail-layout {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 50px;
    }

    .blog-detail-main {
        background: white;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }

    .blog-article-content {
        font-size: 18px;
        line-height: 1.8;
        color: #444;
        margin-bottom: 30px;
    }

    .blog-article-content p {
        margin-bottom: 20px;
    }

    .blog-navigation {
        display: flex;
        justify-content: center;
    }

    .blog-detail-sidebar {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .sidebar-widget {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }

    .widget-title {
        font-size: 24px;
        margin-bottom: 25px;
        color: #333;
    }

    .related-posts {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .related-post {
        display: flex;
        gap: 15px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e5e5;
    }

    .related-post:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .related-post-image {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .related-post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-post-content h4 {
        font-size: 16px;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .related-post-content h4 a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .related-post-content h4 a:hover {
        color: #666;
    }

    .related-post-meta {
        font-size: 13px;
        color: #999;
    }

    .sidebar-cta {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        color: white;
        text-align: center;
    }

    .sidebar-cta h3 {
        color: white;
        margin-bottom: 15px;
    }

    .sidebar-cta p {
        margin-bottom: 20px;
        color: rgba(255, 255, 255, 0.9);
    }

    .btn {
        display: inline-block;
        padding: 12px 30px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: white;
        color: #333;
    }

    .btn-primary:hover {
        background: #f0f0f0;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    @media (max-width: 992px) {
        .blog-detail-layout {
            grid-template-columns: 1fr;
        }

        .blog-detail-main {
            padding: 30px;
        }

        .blog-detail-header h1 {
            font-size: 36px;
        }
    }

    @media (max-width: 768px) {
        .blog-detail-header {
            height: 400px;
        }

        .blog-detail-header h1 {
            font-size: 28px;
        }

        .blog-detail-meta {
            flex-direction: column;
            gap: 10px;
        }

        .blog-detail-main {
            padding: 20px;
        }

        .blog-article-content {
            font-size: 16px;
        }
    }
</style>
@endsection

