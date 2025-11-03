@extends('layouts.app')

@section('title', 'Services - Luxury Villas')

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
            At Luxury Villas, we offer a comprehensive suite of services designed to meet all your luxury real estate needs. From property sales and acquisitions to property management and investment advisory, our team of experts is dedicated to providing exceptional service at every stage of your real estate journey.
        </p>
    </div>
</section>

<!-- Main Services -->
<section class="main-services-section">
    <div class="container">
        <div class="services-grid-large">
            <div class="service-card-large">
                <div class="service-image">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80" alt="Property Sales">
                    <div class="service-overlay">
                        <i class="fas fa-home"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>Property Sales & Acquisitions</h3>
                    <p>Expert guidance through the entire buying or selling process. Our team leverages extensive market knowledge and a global network to ensure you get the best value for your investment.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Market Analysis & Valuation</li>
                        <li><i class="fas fa-check"></i> Negotiation & Deal Structuring</li>
                        <li><i class="fas fa-check"></i> Legal & Financial Coordination</li>
                        <li><i class="fas fa-check"></i> Post-Sale Support</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-secondary">Learn More</a>
                </div>
            </div>

            <div class="service-card-large">
                <div class="service-image">
                    <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800&q=80" alt="Luxury Rentals">
                    <div class="service-overlay">
                        <i class="fas fa-key"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>Luxury Rentals</h3>
                    <p>Access to exclusive rental properties for short-term and long-term stays. Perfect for those seeking temporary luxury accommodations or testing a location before purchasing.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Curated Rental Portfolio</li>
                        <li><i class="fas fa-check"></i> Flexible Terms & Conditions</li>
                        <li><i class="fas fa-check"></i> Concierge Services</li>
                        <li><i class="fas fa-check"></i> Property Maintenance Included</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-secondary">Learn More</a>
                </div>
            </div>

            <div class="service-card-large">
                <div class="service-image">
                    <img src="https://images.unsplash.com/photo-1554224311-beee4ece0870?w=800&q=80" alt="Investment Advisory">
                    <div class="service-overlay">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>Investment Advisory</h3>
                    <p>Strategic investment advice backed by comprehensive market research and analysis. We help you build and optimize your luxury real estate portfolio for maximum returns.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Portfolio Diversification</li>
                        <li><i class="fas fa-check"></i> ROI Analysis & Projections</li>
                        <li><i class="fas fa-check"></i> Risk Assessment</li>
                        <li><i class="fas fa-check"></i> Market Trend Reports</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-secondary">Learn More</a>
                </div>
            </div>

            <div class="service-card-large">
                <div class="service-image">
                    <img src="https://images.unsplash.com/photo-1556912173-46c336c7fd55?w=800&q=80" alt="Property Management">
                    <div class="service-overlay">
                        <i class="fas fa-tools"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3>Property Management</h3>
                    <p>Comprehensive property management services to maintain and enhance the value of your investment. We handle everything so you can enjoy peace of mind.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Maintenance & Repairs</li>
                        <li><i class="fas fa-check"></i> Tenant Screening & Management</li>
                        <li><i class="fas fa-check"></i> Financial Reporting</li>
                        <li><i class="fas fa-check"></i> 24/7 Emergency Support</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
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

