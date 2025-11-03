@extends('layouts.app')

@section('title', 'Contact - Luxury Villas')

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
                            <p>123 Luxury Avenue<br>Beverly Hills, CA 90210</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Call Us</h4>
                            <p>+1 (310) 555-0123<br>+1 (310) 555-0124</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Email Us</h4>
                            <p>info@luxuryvillas.com<br>sales@luxuryvillas.com</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h4>Business Hours</h4>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM</p>
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.4537266347!2d-118.40570492346687!3d34.073619873154825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bc35fbd217ef%3A0xcafb52e1d4c22e03!2sBeverly%20Hills%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1234567890" 
                    width="100%" 
                    height="500" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endsection

