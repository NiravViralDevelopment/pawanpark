@extends('layouts.app')

@section('title', 'About Us - Gurukrupa Marketing | Your Trusted Real Estate Partner')

@section('meta_tags')
    <meta name="description" content="Learn about Gurukrupa Marketing - your trusted real estate partner. We provide expert property consulting, personalized service, and comprehensive real estate solutions.">
    <meta name="keywords" content="about gurukrupa marketing, real estate company, property consultants, our team, real estate experts, trusted property advisor">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/about') }}">
    <meta property="og:title" content="About Us - Gurukrupa Marketing | Your Trusted Real Estate Partner">
    <meta property="og:description" content="Learn about Gurukrupa Marketing - your trusted real estate partner providing expert property consulting services.">
    <meta property="og:image" content="{{ asset('assets/images/Media (2).jpg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/about') }}">
    <meta property="twitter:title" content="About Us - Gurukrupa Marketing | Your Trusted Real Estate Partner">
    <meta property="twitter:description" content="Learn about Gurukrupa Marketing - your trusted real estate partner providing expert property consulting services.">
    <meta property="twitter:image" content="{{ asset('assets/images/Media (2).jpg') }}">
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('{{ asset('assets/images/Media (2).jpg') }}');"></div>
    <div class="page-header-content">
        <div class="container">
            <h1>About Us</h1>
            <p>Redefining luxury real estate for over two decades</p>
        </div>
    </div>
</section>

<!-- About Introduction -->
<section class="about-intro-section">
    <div class="container">
        <div class="about-intro-content">
            <div class="about-intro-text">
                <div class="section-header" style="text-align: left;">
                    <span class="section-subtitle">Our Story</span>
                    <h2 class="section-title">Welcome to Luxury Villas</h2>
                    <div class="title-divider" style="margin-left: 0;"></div>
                </div>
                <p>For over twenty years, Luxury Villas has been the premier destination for discerning clients seeking the finest properties around the globe. Our journey began with a simple yet powerful vision: to connect extraordinary people with extraordinary homes.</p>
                <p>Founded in 2003, we've grown from a boutique agency to an internationally recognized luxury real estate brand. Our success is built on unwavering commitment to excellence, intimate market knowledge, and personalized service that goes beyond mere transactions.</p>
                <p>Each property in our carefully curated portfolio represents the pinnacle of architectural design, prime locations, and exceptional quality. We don't just sell properties; we help our clients discover homes that reflect their achievements, aspirations, and lifestyle.</p>
            </div>
            <div class="about-intro-image">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80" alt="Luxury Office">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="mission-vision-section">
    <div class="container">
        <div class="mission-vision-grid">
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3>Our Mission</h3>
                <p>To provide unparalleled luxury real estate services that exceed expectations, connecting discerning clients with exceptional properties while maintaining the highest standards of integrity, professionalism, and personalized care.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Our Vision</h3>
                <p>To be the world's most trusted luxury real estate brand, recognized for our expertise, innovation, and commitment to creating extraordinary experiences in the pursuit of dream homes.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Our Values</h3>
                <p>Excellence, integrity, innovation, and client-first service define everything we do. We believe in building lasting relationships based on trust, transparency, and exceptional results.</p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">20+</div>
                <div class="stat-label">Years of Excellence</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">2,500+</div>
                <div class="stat-label">Happy Clients</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Global Markets</div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Our Team</span>
            <h2 class="section-title">Meet Our Experts</h2>
            <div class="title-divider"></div>
        </div>
        
        @if($teams->count() > 0)
            <div class="team-grid">
                @foreach($teams as $team)
                    <div class="team-member">
                        <div class="team-image">
                            @if($team->image)
                                <img src="{{ asset($team->image) }}" alt="{{ $team->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&q=80" alt="{{ $team->name }}">
                            @endif
                            <div class="team-overlay">
                                <div class="team-social">
                                    <a href="tel:{{ $team->phone_number }}" title="Call {{ $team->name }}">
                                        <i class="fas fa-phone-alt"></i>
                                    </a>
                                    <a href="https://wa.me/91{{ $team->whatsapp_number }}" target="_blank" title="WhatsApp {{ $team->name }}">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="team-info">
                            <h4>{{ $team->name }}</h4>
                            <p>{{ $team->position }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state" style="text-align: center; padding: 60px 20px;">
                <i class="fas fa-users" style="font-size: 60px; color: #ddd; margin-bottom: 20px;"></i>
                <h3 style="font-size: 22px; color: #333; margin-bottom: 10px;">No Team Members Yet</h3>
                <p style="color: #999;">Our team information will be available soon.</p>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Find Your Dream Villa?</h2>
            <p>Let our team of experts guide you to the perfect luxury property</p>
            <div class="cta-buttons">
                <a href="{{ route('project') }}" class="btn btn-primary">View Properties</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Contact Us</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
/* Mobile Responsive Styles for About Page */
@media (max-width: 768px) {
    /* About Introduction Section */
    .about-intro-section {
        padding: 50px 0;
    }

    .about-intro-content {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }

    .about-intro-text {
        order: 2;
    }

    .about-intro-image {
        order: 1;
        height: 300px !important;
    }

    .about-intro-text .section-title {
        font-size: 28px !important;
        margin: 10px 0 15px !important;
    }

    .about-intro-text p {
        font-size: 15px !important;
        margin-bottom: 15px !important;
    }

    /* Mission & Vision Section */
    .mission-vision-section {
        padding: 50px 0;
    }

    .mission-vision-grid {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
    }

    .mission-card {
        padding: 30px 20px !important;
    }

    .mission-icon {
        width: 70px !important;
        height: 70px !important;
        font-size: 30px !important;
        margin-bottom: 20px !important;
    }

    .mission-card h3 {
        font-size: 20px !important;
        margin-bottom: 12px !important;
    }

    .mission-card p {
        font-size: 14px !important;
    }

    /* Statistics Section */
    .stats-section {
        padding: 50px 0;
    }

    .stats-grid {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 36px !important;
    }

    .stat-label {
        font-size: 14px !important;
    }

    /* Team Section */
    .team-section {
        padding: 50px 0;
    }

    .team-grid {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
    }

    .team-member {
        max-width: 100%;
    }

    .team-image {
        height: 350px !important;
    }

    .team-info {
        padding: 20px !important;
    }

    .team-info h4 {
        font-size: 18px !important;
    }

    .team-info p {
        font-size: 14px !important;
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

    /* Section Header */
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
}

@media (max-width: 480px) {
    .about-intro-section {
        padding: 40px 0;
    }

    .about-intro-image {
        height: 250px !important;
    }

    .about-intro-text .section-title {
        font-size: 24px !important;
    }

    .about-intro-text p {
        font-size: 14px !important;
    }

    .mission-vision-section {
        padding: 40px 0;
    }

    .mission-card {
        padding: 25px 15px !important;
    }

    .mission-icon {
        width: 60px !important;
        height: 60px !important;
        font-size: 24px !important;
    }

    .mission-card h3 {
        font-size: 18px !important;
    }

    .mission-card p {
        font-size: 13px !important;
    }

    .stats-section {
        padding: 40px 0;
    }

    .stat-number {
        font-size: 32px !important;
    }

    .stat-label {
        font-size: 13px !important;
    }

    .team-section {
        padding: 40px 0;
    }

    .team-image {
        height: 300px !important;
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

    .section-title {
        font-size: 24px !important;
    }
}
</style>
@endsection

