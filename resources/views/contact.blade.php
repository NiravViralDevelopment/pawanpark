@extends('layouts.app')

@section('title', 'Contact Us - Gurukrupa Marketing | Get in Touch')

@section('meta_tags')
    <meta name="description" content="Contact Gurukrupa Marketing for all your real estate needs. Get in touch with our expert team for property inquiries, consultations, and personalized service. Call us at +91 9510312047.">
    <meta name="keywords" content="contact gurukrupa marketing, real estate contact, property inquiry, get in touch, real estate consultant contact, property services contact">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/contact') }}">
    <meta property="og:title" content="Contact Us - Gurukrupa Marketing | Get in Touch">
    <meta property="og:description" content="Contact Gurukrupa Marketing for all your real estate needs. Expert consultation and personalized service.">
    <meta property="og:image" content="{{ asset('assets/images/Media (8).jpg') }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/contact') }}">
    <meta property="twitter:title" content="Contact Us - Gurukrupa Marketing | Get in Touch">
    <meta property="twitter:description" content="Contact Gurukrupa Marketing for all your real estate needs. Expert consultation and personalized service.">
    <meta property="twitter:image" content="{{ asset('assets/images/Media (8).jpg') }}">
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="page-header-bg" style="background-image: url('{{ asset('assets/images/Media (8).jpg') }}');"></div>
    <div class="page-header-content">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Get in touch with our team of luxury real estate experts</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-info-wrapper">
                <div class="section-header">
                    <span class="section-subtitle">Get in Touch</span>
                    <h2 class="section-title">Let's Discuss Your Dream Villa</h2>
                    <div class="title-divider"></div>
                </div>
                <p class="contact-intro">Our team of experienced real estate professionals is here to help you find the perfect luxury villa. Whether you're buying, selling, or seeking investment opportunities, we're committed to exceeding your expectations.</p>
                
                <div class="contact-info-cards">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Visit Our Office</h4>
                            <p>Govindpura Road, Bhaliya Vaga,<br>Jarod, Gujarat 391510</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Call Us</h4>
                            <p>+91 9510312047<br>+91 9913139788</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Email Us</h4>
                            <p>tannurajrathava@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Business Hours</h4>
                            <p>Monday - Sunday: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <form id="contact-form" class="contact-form" novalidate>
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name">
                        <span class="error-message" id="name-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address">
                        <span class="error-message" id="email-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number (e.g., +91 9876543210)" maxlength="15">
                        <span class="error-message" id="phone-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tell us about your requirements..."></textarea>
                        <span class="error-message" id="message-error"></span>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
                <div id="form-success-message" class="success-message" style="display: none;">
                    <i class="fas fa-check-circle"></i>
                    <p>Thank you for contacting us! We'll get back to you within 24 hours.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3687.8364813055805!2d73.34060529999999!3d22.435179599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fd3005a008337%3A0x7c175d6413ee2716!2sPawan%20Park%20Tenament!5e0!3m2!1sen!2sin!4v1762146198413!5m2!1sen!2sin%22 width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
@endsection

