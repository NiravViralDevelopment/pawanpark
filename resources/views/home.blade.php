@extends('layouts.app')

@section('title', 'Luxury Villas - Premium Real Estate')

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
                        <a href="{{ route('project.detail', 1) }}" class="btn btn-secondary">View Details</a>
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
                        <a href="{{ route('project.detail', 2) }}" class="btn btn-secondary">View Details</a>
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
                        <a href="{{ route('project.detail', 3) }}" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            </div>

            <div class="villa-card">
                <div class="villa-image">
                    <img src="https://images.unsplash.com/photo-1600607687644-c7171b42498f?w=800&q=80" alt="Urban Villa">
                </div>
                <div class="villa-info">
                    <h3>Urban Oasis Mansion</h3>
                    <p class="villa-location"><i class="fas fa-map-marker-alt"></i> Beverly Hills, California</p>
                    <p class="villa-description">Contemporary estate with smart home technology and resort-style amenities.</p>
                    <div class="villa-features">
                        <span><i class="fas fa-bed"></i> 8 Beds</span>
                        <span><i class="fas fa-bath"></i> 10 Baths</span>
                        <span><i class="fas fa-ruler-combined"></i> 15,000 sqft</span>
                    </div>
                    <div class="villa-footer">
                        <span class="villa-price">$28,500,000</span>
                        <a href="{{ route('project.detail', 4) }}" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            </div>

            <div class="villa-card">
                <div class="villa-image">
                    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800&q=80" alt="Coastal Villa">
                </div>
                <div class="villa-info">
                    <h3>Tropical Island Estate</h3>
                    <p class="villa-location"><i class="fas fa-map-marker-alt"></i> Maui, Hawaii</p>
                    <p class="villa-description">Private beachfront estate surrounded by lush tropical gardens.</p>
                    <div class="villa-features">
                        <span><i class="fas fa-bed"></i> 6 Beds</span>
                        <span><i class="fas fa-bath"></i> 7 Baths</span>
                        <span><i class="fas fa-ruler-combined"></i> 10,500 sqft</span>
                    </div>
                    <div class="villa-footer">
                        <span class="villa-price">$22,000,000</span>
                        <a href="{{ route('project.detail', 5) }}" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            </div>

            <div class="villa-card">
                <div class="villa-image">
                    <img src="https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?w=800&q=80" alt="Modern Villa">
                </div>
                <div class="villa-info">
                    <h3>Desert Modern Masterpiece</h3>
                    <p class="villa-location"><i class="fas fa-map-marker-alt"></i> Palm Springs, California</p>
                    <p class="villa-description">Mid-century modern inspired villa with desert landscape integration.</p>
                    <div class="villa-features">
                        <span><i class="fas fa-bed"></i> 4 Beds</span>
                        <span><i class="fas fa-bath"></i> 5 Baths</span>
                        <span><i class="fas fa-ruler-combined"></i> 6,800 sqft</span>
                    </div>
                    <div class="villa-footer">
                        <span class="villa-price">$9,750,000</span>
                        <a href="{{ route('project.detail', 6) }}" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
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
    </div>
</section>
@endsection

