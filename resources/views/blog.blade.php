@extends('layouts.app')

@section('title', 'Blog - Luxury Villas')

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('https://images.unsplash.com/photo-1600607687644-c7171b42498f?w=1920&q=80');"></div>
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
        <div class="blog-grid">
            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Market Trends</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 28, 2025</span>
                        <span><i class="far fa-user"></i> Sarah Johnson</span>
                    </div>
                    <h3>The Rise of Sustainable Luxury Villas in 2025</h3>
                    <p>Discover how eco-friendly features and sustainable design are becoming essential elements in the luxury real estate market, with buyers prioritizing green certifications and energy efficiency.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Investment</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 25, 2025</span>
                        <span><i class="far fa-user"></i> Michael Chen</span>
                    </div>
                    <h3>Why Beachfront Properties Remain Prime Investments</h3>
                    <p>An in-depth analysis of coastal real estate investment opportunities, examining appreciation rates, rental income potential, and the enduring appeal of waterfront living.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Design</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 22, 2025</span>
                        <span><i class="far fa-user"></i> Emma Rodriguez</span>
                    </div>
                    <h3>Top 10 Must-Have Features in Modern Luxury Homes</h3>
                    <p>From smart home automation to wellness amenities, explore the essential features that today's luxury homebuyers are seeking in their dream properties.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Lifestyle</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 20, 2025</span>
                        <span><i class="far fa-user"></i> David Williams</span>
                    </div>
                    <h3>The Art of Hosting: Luxury Villa Entertainment Spaces</h3>
                    <p>Learn how to design and utilize entertainment spaces in luxury villas, from outdoor kitchens to wine cellars, for unforgettable gatherings and celebrations.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Location Guide</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 18, 2025</span>
                        <span><i class="far fa-user"></i> Sophie Laurent</span>
                    </div>
                    <h3>Hidden Gems: Emerging Luxury Real Estate Markets</h3>
                    <p>Uncover the next wave of luxury real estate hotspots around the globe, where savvy investors are finding exceptional value and untapped potential.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Architecture</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 15, 2025</span>
                        <span><i class="far fa-user"></i> James Anderson</span>
                    </div>
                    <h3>Architectural Masterpieces: Award-Winning Villa Designs</h3>
                    <p>A showcase of the most stunning architectural achievements in luxury villa design, featuring innovative structures that push the boundaries of residential architecture.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600573472591-ee6b68d14c68?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Technology</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 12, 2025</span>
                        <span><i class="far fa-user"></i> Alexandra Kim</span>
                    </div>
                    <h3>Smart Homes: The Future of Luxury Living</h3>
                    <p>Explore how cutting-edge technology is transforming luxury homes, from AI-powered climate control to advanced security systems and seamless automation.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Buying Guide</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 10, 2025</span>
                        <span><i class="far fa-user"></i> Robert Martinez</span>
                    </div>
                    <h3>Complete Guide to Purchasing Your First Luxury Villa</h3>
                    <p>Everything you need to know about buying a luxury property, from financing options and legal considerations to working with real estate professionals.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>

            <article class="blog-card">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1600607687644-c7171b42498f?w=800&q=80" alt="Blog Post">
                    <div class="blog-category">Interior Design</div>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> October 8, 2025</span>
                        <span><i class="far fa-user"></i> Isabella Thompson</span>
                    </div>
                    <h3>Luxury Interior Design Trends Shaping 2025</h3>
                    <p>From biophilic design to artisanal craftsmanship, discover the interior design trends that are defining luxury living spaces this year.</p>
                    <a href="#" class="blog-link">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
        </div>

        <div class="pagination">
            <button class="pagination-btn" disabled><i class="fas fa-chevron-left"></i> Previous</button>
            <div class="pagination-numbers">
                <button class="pagination-number active">1</button>
                <button class="pagination-number">2</button>
                <button class="pagination-number">3</button>
            </div>
            <button class="pagination-btn">Next <i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</section>
@endsection

