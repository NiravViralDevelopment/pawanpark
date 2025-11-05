@extends('layouts.app')

@section('title', 'Our Services - Gurukrupa Marketing | Real Estate Solutions')

@section('meta_tags')
    <meta name="description" content="Explore our comprehensive real estate services including property buying, selling, investment consulting, property management, and legal assistance. Expert guidance for all your property needs.">
    <meta name="keywords" content="real estate services, property buying, property selling, investment consulting, property management, real estate solutions, gurukrupa services">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/services') }}">
    <meta property="og:title" content="Our Services - Gurukrupa Marketing | Real Estate Solutions">
    <meta property="og:description" content="Explore our comprehensive real estate services including property buying, selling, investment consulting, and property management.">
    <meta property="og:image" content="{{ asset('assets/images/Media (5).jpg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/services') }}">
    <meta property="twitter:title" content="Our Services - Gurukrupa Marketing | Real Estate Solutions">
    <meta property="twitter:description" content="Explore our comprehensive real estate services including property buying, selling, investment consulting, and property management.">
    <meta property="twitter:image" content="{{ asset('assets/images/Media (5).jpg') }}">
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('{{ asset('assets/images/Media (5).jpg') }}');"></div>
    <div class="page-header-content">
        <div class="container">
            <h1>Our Services</h1>
            <p>Comprehensive luxury real estate solutions tailored to your needs</p>
        </div>
    </div>
</section>

<!-- Services Introduction -->
<section class="services-intro-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">What We Offer</span>
            <h2 class="section-title">Premium Real Estate Services</h2>
            <div class="title-divider"></div>
        </div>
        <p class="services-intro-text">
            At Gurukrupa Marketing, we offer a comprehensive suite of services designed to meet all your real estate needs. From property sales and acquisitions to property management and investment advisory, our team of experts is dedicated to providing exceptional service at every stage of your real estate journey.
        </p>
    </div>
</section>

<!-- Main Services -->
<section class="main-services-section">
    <div class="container">
        @if($services && $services->count() > 0)
            <div class="services-grid-large">
                @foreach($services as $service)
                    <div class="service-card-large">
                        <div class="service-image">
                            @if($service->image)
                                <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80" alt="{{ $service->title }}">
                            @endif
                            <div class="service-overlay">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                        </div>
                        <div class="service-content">
                            <h3>{{ $service->title }}</h3>
                            <p>{{ Str::limit($service->descriptions, 200) }}</p>
                            <a href="{{ route('service.detail', $service->id) }}" class="btn btn-secondary">Learn More</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-concierge-bell"></i>
                <h3>Services Coming Soon</h3>
                <p>We're preparing exciting services for you. Stay tuned!</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Get Started?</h2>
            <p>Let our team of luxury real estate experts assist you with your next move</p>
            <div class="cta-buttons">
                <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us Today</a>
                <a href="{{ route('project') }}" class="btn btn-secondary">View Properties</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
/* Mobile Responsive Styles for Services Page */
@media (max-width: 768px) {
    /* Services Introduction Section */
    .services-intro-section {
        padding: 50px 0 30px !important;
    }

    .services-intro-text {
        font-size: 15px !important;
        padding: 0 15px;
    }

    .section-header {
        margin-bottom: 40px !important;
    }

    .section-title {
        font-size: 28px !important;
        margin: 12px 0 15px !important;
    }

    .section-subtitle {
        font-size: 12px !important;
    }

    /* Main Services Section */
    .main-services-section {
        padding: 50px 0 !important;
    }

    .services-grid-large {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }

    .service-card-large {
        margin-bottom: 0;
    }

    .service-image {
        height: 250px !important;
    }

    .service-content {
        padding: 25px 20px !important;
    }

    .service-content h3 {
        font-size: 22px !important;
        margin-bottom: 12px !important;
    }

    .service-content p {
        font-size: 14px !important;
        margin-bottom: 20px !important;
        line-height: 1.7;
    }

    .service-content .btn {
        padding: 12px 24px;
        font-size: 14px;
    }

    /* CTA Section */
    .cta-section {
        padding: 60px 0 !important;
    }

    .cta-content h2 {
        font-size: 28px !important;
        margin-bottom: 15px !important;
    }

    .cta-content p {
        font-size: 16px !important;
        margin-bottom: 30px !important;
    }

    .cta-buttons {
        flex-direction: column !important;
        gap: 15px !important;
    }

    .cta-buttons .btn {
        width: 100%;
        padding: 14px 30px;
    }

    /* Empty State */
    .empty-state {
        padding: 40px 20px !important;
    }

    .empty-state i {
        font-size: 50px !important;
        margin-bottom: 15px !important;
    }

    .empty-state h3 {
        font-size: 20px !important;
        margin-bottom: 10px !important;
    }

    .empty-state p {
        font-size: 14px !important;
    }
}

@media (max-width: 480px) {
    .services-intro-section {
        padding: 40px 0 20px !important;
    }

    .services-intro-text {
        font-size: 14px !important;
    }

    .section-title {
        font-size: 24px !important;
    }

    .main-services-section {
        padding: 40px 0 !important;
    }

    .services-grid-large {
        gap: 25px !important;
    }

    .service-image {
        height: 220px !important;
    }

    .service-content {
        padding: 20px 15px !important;
    }

    .service-content h3 {
        font-size: 20px !important;
    }

    .service-content p {
        font-size: 13px !important;
    }

    .cta-section {
        padding: 50px 0 !important;
    }

    .cta-content h2 {
        font-size: 24px !important;
    }

    .cta-content p {
        font-size: 15px !important;
    }

    .empty-state {
        padding: 30px 15px !important;
    }

    .empty-state i {
        font-size: 40px !important;
    }

    .empty-state h3 {
        font-size: 18px !important;
    }

    .empty-state p {
        font-size: 13px !important;
    }
}

/* Tablet adjustments */
@media (min-width: 769px) and (max-width: 1024px) {
    .services-grid-large {
        grid-template-columns: 1fr !important;
        gap: 35px !important;
    }

    .service-image {
        height: 280px !important;
    }
}
</style>
@endsection

