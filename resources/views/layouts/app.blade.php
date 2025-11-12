<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#c49b63">
    <title>@yield('title', 'Gurukrupa Marketing - Premium Real Estate')</title>
    
    <!-- SEO Meta Tags -->
    @yield('meta_tags')
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('extra_css')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="LuxuryVillas">
                    <span>Gurukrupa Marketing</span>
                </a>
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a></li>
                    <li><a href="{{ route('project') }}" class="{{ request()->routeIs('project') ? 'active' : '' }}">Projects</a></li>
                    <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="Gurukrupa Marketing">
                        <span>Gurukrupa Marketing</span>
                    </div>
                    <p>Your premier destination for luxury real estate. Discover exceptional villas in the world's most desirable locations.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <!-- <a href="#"><i class="fab fa-linkedin-in"></i></a> -->
                    </div>
                </div>

                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('project') }}">Projects</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <!-- <div class="footer-column">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="{{ route('services') }}">Property Sales</a></li>
                        <li><a href="{{ route('services') }}">Luxury Rentals</a></li>
                        <li><a href="{{ route('services') }}">Investment Advisory</a></li>
                        <li><a href="{{ route('services') }}">Property Management</a></li>
                    </ul>
                </div> -->

                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> Govindpura Road, Bhaliya Vaga, Jarod, Gujarat 391510</li>
                        <li><i class="fas fa-phone"></i> +91 9510312047</li>
                        <li><i class="fas fa-envelope"></i> tannurajrathava@gmail.com</li>
                        <li><i class="fas fa-clock"></i> Mon - Sun: 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Gurukrupa Marketing. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/919510312047" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 90px;
            right: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background-color: #20ba5a;
            transform: scale(1.1);
            box-shadow: 2px 2px 20px rgba(0, 0, 0, 0.4);
        }

        .whatsapp-float i {
            margin: 0;
            line-height: 60px;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 75px;
                right: 15px;
                font-size: 25px;
            }
            
            .whatsapp-float i {
                line-height: 50px;
            }
        }
    </style>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('extra_js')
</body>
</html>

