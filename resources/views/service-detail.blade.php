@extends('layouts.app')

@section('title', $service->meta_title ?? $service->title . ' - Gurukrupa Marketing')

@section('meta_tags')
    <meta name="description" content="{{ $service->meta_description ?? Str::limit(strip_tags($service->descriptions), 160) }}">
    <meta name="keywords" content="{{ $service->meta_keywords ?? 'service, real estate, property, gurukrupa marketing' }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $service->meta_title ?? $service->title }}">
    <meta property="og:description" content="{{ $service->meta_description ?? Str::limit(strip_tags($service->descriptions), 160) }}">
    @if($service->image)
        <meta property="og:image" content="{{ asset($service->image) }}">
    @endif
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $service->meta_title ?? $service->title }}">
    <meta property="twitter:description" content="{{ $service->meta_description ?? Str::limit(strip_tags($service->descriptions), 160) }}">
    @if($service->image)
        <meta property="twitter:image" content="{{ asset($service->image) }}">
    @endif
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('{{ $service->image ? asset($service->image) : asset('assets/images/Media (5).jpg') }}');"></div>
    <div class="page-header-content">
        <div class="container">
            <h1>{{ $service->title }}</h1>
            <p>Expert Real Estate Services</p>
        </div>
    </div>
</section>

<!-- Service Detail Content -->
<section class="service-detail-section">
    <div class="container">
        <div class="service-detail-wrapper">
            <!-- Main Content -->
            <div class="service-detail-content">
                @if($service->image)
                    <div class="service-featured-image">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                    </div>
                @endif

                <div class="service-detail-text">
                    <h2>{{ $service->title }}</h2>
                    <div class="service-description">
                        {!! nl2br(e($service->descriptions)) !!}
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="service-cta-box">
                    <div class="cta-box-content">
                        <i class="fas fa-phone-alt"></i>
                        <h3>Interested in This Service?</h3>
                        <p>Contact us today to learn more about how we can help you</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us Now</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="service-sidebar">
                <!-- Other Services -->
                @if($otherServices && $otherServices->count() > 0)
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Other Services</h3>
                        <div class="other-services-list">
                            @foreach($otherServices as $otherService)
                                <a href="{{ route('service.detail', $otherService->id) }}" class="other-service-item">
                                    @if($otherService->image)
                                        <div class="other-service-thumb">
                                            <img src="{{ asset($otherService->image) }}" alt="{{ $otherService->title }}">
                                        </div>
                                    @endif
                                    <div class="other-service-info">
                                        <h4>{{ $otherService->title }}</h4>
                                        <p>{{ Str::limit($otherService->descriptions, 80) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Contact Widget -->
                <div class="sidebar-widget contact-widget">
                    <h3 class="widget-title">Need Help?</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span>Call Us</span>
                                <a href="tel:+919510312047">+91 9510312047</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <span>Email Us</span>
                                <a href="mailto:info@gurukripamarketing.com">info@gurukripamarketing.com</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fab fa-whatsapp"></i>
                            <div>
                                <span>WhatsApp</span>
                                <a href="https://wa.me/919510312047" target="_blank">+91 9510312047</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Services Button -->
                <div class="sidebar-widget">
                    <a href="{{ route('services') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left"></i> View All Services
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
    /* Service Detail Section */
    .service-detail-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .service-detail-wrapper {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
    }

    .service-detail-content {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    .service-featured-image {
        width: 100%;
        height: 450px;
        overflow: hidden;
    }

    .service-featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .service-detail-text {
        padding: 40px;
    }

    .service-detail-text h2 {
        font-size: 32px;
        color: #1a2335;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .service-description {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
        margin-bottom: 30px;
    }

    .service-description p {
        margin-bottom: 15px;
    }

    /* CTA Box */
    .service-cta-box {
        margin: 40px;
        margin-top: 0;
        background: linear-gradient(135deg, #c49b63 0%, #b88b53 100%);
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        color: white;
    }

    .cta-box-content i {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .cta-box-content h3 {
        font-size: 24px;
        margin-bottom: 15px;
        color: white;
    }

    .cta-box-content p {
        font-size: 16px;
        margin-bottom: 25px;
        opacity: 0.95;
    }

    /* Sidebar */
    .service-sidebar {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .sidebar-widget {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    .widget-title {
        font-size: 20px;
        color: #1a2335;
        margin-bottom: 20px;
        font-weight: 700;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    /* Other Services */
    .other-services-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .other-service-item {
        display: flex;
        gap: 15px;
        padding: 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        background: #f8f9fa;
    }

    .other-service-item:hover {
        background: #c49b63;
        transform: translateX(5px);
    }

    .other-service-item:hover .other-service-info h4,
    .other-service-item:hover .other-service-info p {
        color: white;
    }

    .other-service-thumb {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .other-service-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .other-service-info h4 {
        font-size: 16px;
        color: #1a2335;
        margin-bottom: 5px;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .other-service-info p {
        font-size: 13px;
        color: #666;
        line-height: 1.5;
        margin: 0;
        transition: color 0.3s ease;
    }

    /* Contact Widget */
    .contact-widget {
        background: linear-gradient(135deg, #1a2335 0%, #2c3e50 100%);
    }

    .contact-widget .widget-title {
        color: white;
        border-bottom-color: rgba(255, 255, 255, 0.2);
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        color: white;
    }

    .contact-item i {
        font-size: 24px;
        color: #c49b63;
        margin-top: 3px;
    }

    .contact-item > div {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .contact-item span {
        font-size: 13px;
        opacity: 0.8;
    }

    .contact-item a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .contact-item a:hover {
        color: #c49b63;
    }

    /* Button Styles */
    .btn-block {
        width: 100%;
        text-align: center;
        justify-content: center;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #1a2335;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
        font-size: 16px;
    }

    /* Mobile Responsive */
    @media (max-width: 992px) {
        .service-detail-wrapper {
            grid-template-columns: 1fr;
        }

        .service-sidebar {
            order: -1;
        }
    }

    @media (max-width: 768px) {
        .service-detail-section {
            padding: 50px 0;
        }

        .service-featured-image {
            height: 300px;
        }

        .service-detail-text {
            padding: 30px 20px;
        }

        .service-detail-text h2 {
            font-size: 24px;
        }

        .service-cta-box {
            margin: 30px 20px;
            padding: 30px 20px;
        }

        .cta-box-content h3 {
            font-size: 20px;
        }

        .sidebar-widget {
            padding: 20px;
        }

        .other-service-item {
            flex-direction: column;
        }

        .other-service-thumb {
            width: 100%;
            height: 150px;
        }
    }
</style>
@endsection

