@extends('layouts.app')

@section('title', 'About Us - Luxury Villas')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1920&q=80');"></div>
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
        <div class="team-grid">
            <div class="team-member">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&q=80" alt="Team Member">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h4>Jonathan Williams</h4>
                    <p>Founder & CEO</p>
                </div>
            </div>

            <div class="team-member">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&q=80" alt="Team Member">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h4>Sarah Mitchell</h4>
                    <p>Chief Operations Officer</p>
                </div>
            </div>

            <div class="team-member">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600&q=80" alt="Team Member">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h4>Michael Chen</h4>
                    <p>Senior Luxury Advisor</p>
                </div>
            </div>

            <div class="team-member">
                <div class="team-image">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&q=80" alt="Team Member">
                    <div class="team-overlay">
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-info">
                    <h4>Emily Rodriguez</h4>
                    <p>Director of Marketing</p>
                </div>
            </div>
        </div>
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

