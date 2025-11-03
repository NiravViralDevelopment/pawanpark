@extends('layouts.app')

@php
    // Get first active banner for SEO meta tags
    $firstBanner = $banners->first();
    
    // SEO defaults
    $metaTitle = $firstBanner && $firstBanner->meta_title 
        ? $firstBanner->meta_title 
        : 'Gurukrupa Marketing - Premium Real Estate & Property Solutions';
    
    $metaDescription = $firstBanner && $firstBanner->meta_description 
        ? $firstBanner->meta_description 
        : 'Discover premium real estate properties with Gurukrupa Marketing. We offer luxury villas, apartments, and commercial properties with expert guidance and personalized service.';
    
    $metaKeywords = $firstBanner && $firstBanner->meta_keywords 
        ? $firstBanner->meta_keywords 
        : 'real estate, property, luxury villas, apartments, gurukrupa marketing, property for sale, real estate agent, property consultant';
    
    $metaImage = $firstBanner && $firstBanner->image 
        ? asset($firstBanner->image) 
        : asset('assets/images/logo.jpg');
@endphp

@section('title', $metaTitle)

@section('meta_tags')
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $metaImage }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="{{ $metaTitle }}">
    <meta property="twitter:description" content="{{ $metaDescription }}">
    <meta property="twitter:image" content="{{ $metaImage }}">
@endsection

@section('content')
<!-- Hero Banner Slider -->
<section class="hero-slider" id="hero-slider">
    @if($banners && $banners->count() > 0)
        @foreach($banners as $index => $banner)
            <div class="slide {{ $index === 0 ? 'active' : '' }}">
                <div class="slide-bg" style="background-image: url('{{ asset($banner->image) }}');"></div>
            </div>
        @endforeach
        @if($banners->count() > 1)
            <button class="slider-btn prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
            <button class="slider-btn next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
            <div class="slider-dots">
                @foreach($banners as $index => $banner)
                    <span class="dot {{ $index === 0 ? 'active' : '' }}" onclick="currentSlide({{ $index }})"></span>
                @endforeach
            </div>
        @endif
    @else
        <!-- Fallback to default slider if no banners -->
        <div class="slide active">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=1920&q=80');"></div>
        </div>
        <div class="slide">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=1920&q=80');"></div>
        </div>
        <div class="slide">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1920&q=80');"></div>
        </div>
        <div class="slide">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1920&q=80');"></div>
        </div>
        <button class="slider-btn prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
        <button class="slider-btn next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    @endif
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">About Us</span>
            <h2 class="section-title">Welcome to Luxury Villas</h2>
            <div class="title-divider"></div>
        </div>
        <div class="about-content">
            <div class="about-text">
                <p>For over two decades, we have been the premier destination for discerning clients seeking the finest luxury villas around the globe. Our curated collection represents the pinnacle of architectural excellence and refined living.</p>
                <p>Each property in our portfolio is meticulously selected to ensure it meets our exacting standards of quality, location, and design. We believe that a home should be more than just a place to live—it should be a masterpiece that reflects your success and aspirations.</p>
                <div class="about-features">
                    <div class="feature-item">
                        <i class="fas fa-award"></i>
                        <h4>Premium Quality</h4>
                        <p>Only the finest properties</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-globe"></i>
                        <h4>Global Reach</h4>
                        <p>Properties worldwide</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-handshake"></i>
                        <h4>Trusted Service</h4>
                        <p>20+ years experience</p>
                    </div>
                </div>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80" alt="Luxury Villa Interior">
                <div class="about-image-overlay"></div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Villas Section -->
<section class="featured-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Featured Properties</span>
            <h2 class="section-title">Exclusive Villa Collection</h2>
            <div class="title-divider"></div>
        </div>
        @if($featuredProjects && $featuredProjects->count() > 0)
            <div class="villas-grid">
                @foreach($featuredProjects as $index => $project)
                    <div class="villa-card">
                        <div class="villa-image">
                            @if($project->images && is_array($project->images) && count($project->images) > 0)
                                <img src="{{ asset($project->images[0]) }}" alt="{{ $project->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800&q=80" alt="{{ $project->title }}">
                            @endif
                        </div>
                        <div class="villa-info">
                            <h3>{{ $project->title }}</h3>
                            <p class="villa-location"><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</p>
                            <p class="villa-description">{{ Str::limit($project->description, 100) }}</p>
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
                                @else
                                    <span class="villa-price">Contact for Price</span>
                                @endif
                                <a href="{{ route('project.detail', $project->id) }}" class="btn btn-secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="villas-grid">
                <div class="villa-card">
                    <div class="villa-image">
                        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800&q=80" alt="Modern Villa">
                        <div class="villa-badge">Featured</div>
                    </div>
                    <div class="villa-info">
                        <h3>Contemporary Beachfront Villa</h3>
                        <p class="villa-location"><i class="fas fa-map-marker-alt"></i> Malibu, California</p>
                        <p class="villa-description">Stunning modern architecture with panoramic ocean views and private beach access.</p>
                        <div class="villa-features">
                            <span><i class="fas fa-bed"></i> 5 Beds</span>
                            <span><i class="fas fa-bath"></i> 6 Baths</span>
                            <span><i class="fas fa-ruler-combined"></i> 8,500 sqft</span>
                        </div>
                        <div class="villa-footer">
                            <span class="villa-price">$12,500,000</span>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="villa-card">
                    <div class="villa-image">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=80" alt="Luxury Villa">
                        <div class="villa-badge">New</div>
                    </div>
                    <div class="villa-info">
                        <h3>Mediterranean Paradise</h3>
                        <p class="villa-location"><i class="fas fa-map-marker-alt"></i> French Riviera, France</p>
                        <p class="villa-description">Elegant villa with infinity pool overlooking the Mediterranean Sea.</p>
                        <div class="villa-features">
                            <span><i class="fas fa-bed"></i> 6 Beds</span>
                            <span><i class="fas fa-bath"></i> 7 Baths</span>
                            <span><i class="fas fa-ruler-combined"></i> 9,200 sqft</span>
                        </div>
                        <div class="villa-footer">
                            <span class="villa-price">€15,800,000</span>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="villa-card">
                    <div class="villa-image">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&q=80" alt="Mountain Villa">
                        <div class="villa-badge">Exclusive</div>
                    </div>
                    <div class="villa-info">
                        <h3>Alpine Luxury Retreat</h3>
                        <p class="villa-location"><i class="fas fa-map-marker-alt"></i> Aspen, Colorado</p>
                        <p class="villa-description">Mountain masterpiece with ski-in/ski-out access and breathtaking views.</p>
                        <div class="villa-features">
                            <span><i class="fas fa-bed"></i> 7 Beds</span>
                            <span><i class="fas fa-bath"></i> 8 Baths</span>
                            <span><i class="fas fa-ruler-combined"></i> 12,000 sqft</span>
                        </div>
                        <div class="villa-footer">
                            <span class="villa-price">$18,900,000</span>
                            <a href="#" class="btn btn-secondary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Testimonials</span>
            <h2 class="section-title">What Our Clients Say</h2>
            <div class="title-divider"></div>
        </div>
        
        @if($testimonials && $testimonials->count() > 0)
            <div class="testimonials-grid">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card">
                        <div class="testimonial-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="testimonial-text">"{{ $testimonial->description }}"</p>
                        <div class="testimonial-author">
                            @if($testimonial->image)
                                <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&q=80" alt="{{ $testimonial->name }}">
                            @endif
                            <div class="author-info">
                                <h4>{{ $testimonial->name }}</h4>
                                <p>{{ $testimonial->position }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Fallback to default testimonials if none exist -->
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The team at Luxury Villas helped us find our dream home in Malibu. Their attention to detail and understanding of our needs was exceptional. We couldn't be happier with our new beachfront villa."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&q=80" alt="Client">
                        <div class="author-info">
                            <h4>Michael Anderson</h4>
                            <p>CEO, Tech Innovations</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Outstanding service from start to finish. They made the entire process seamless and found us the perfect villa in the French Riviera. Their expertise in luxury real estate is unmatched."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&q=80" alt="Client">
                        <div class="author-info">
                            <h4>Sophie Laurent</h4>
                            <p>Fashion Designer</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Professional, knowledgeable, and incredibly patient. They took the time to understand exactly what we were looking for and delivered beyond our expectations. Highly recommend!"</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&q=80" alt="Client">
                        <div class="author-info">
                            <h4>David Chen</h4>
                            <p>Investment Banker</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Our Team Section -->
<section class="team-section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Our Team</span>
            <h2 class="section-title">Meet Our Experts</h2>
            <div class="title-divider"></div>
        </div>
        @if($teams && $teams->count() > 0)
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
                                    <a href="https://wa.me/91{{ $team->phone_number }}" target="_blank" title="WhatsApp {{ $team->name }}">
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
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Meet Our Team Soon</h3>
                <p>We're building an exceptional team to serve you better.</p>
            </div>
        @endif
    </div>
</section>
@endsection

@section('extra_css')
<style>
.featured-section .villa-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    padding-top: 20px;
    flex-wrap: wrap;
    gap: 12px;
}

.featured-section .villa-type {
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

@media (max-width: 768px) {
    .featured-section .villa-footer {
        flex-direction: column;
        align-items: stretch;
    }
    
    .featured-section .villa-type {
        text-align: center;
        justify-content: center;
    }
    
    .featured-section .villa-footer .btn {
        width: 100%;
        justify-content: center;
    }
}

/* Team Section Styles */
.team-section {
    padding: 80px 0;
    background: #ffffff;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.team-member {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.team-member:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.team-image {
    position: relative;
    height: 320px;
    overflow: hidden;
}

.team-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.team-member:hover .team-image img {
    transform: scale(1.1);
}

.team-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 35, 53, 0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-member:hover .team-overlay {
    opacity: 1;
}

.team-social {
    display: flex;
    gap: 15px;
}

.team-social a {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.15);
    border: 2px solid #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}

.team-social a:hover {
    background: #c49b63;
    border-color: #c49b63;
    transform: scale(1.1);
}

.team-info {
    padding: 25px 20px;
    text-align: center;
}

.team-info h4 {
    margin: 0 0 8px 0;
    font-size: 20px;
    color: #1a2335;
    font-weight: 600;
}

.team-info p {
    margin: 0;
    color: #c49b63;
    font-size: 14px;
    font-weight: 500;
}

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

@media (max-width: 768px) {
    .team-section {
        padding: 60px 0;
    }
    
    .team-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .team-image {
        height: 280px;
    }
    
    .team-info h4 {
        font-size: 18px;
    }
}
</style>
@endsection

