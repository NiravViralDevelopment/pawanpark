<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Luxury Villas - Premium Real Estate')</title>
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
                <div class="logo">
                    <i class="fas fa-building"></i>
                    <span>LuxuryVillas</span>
                </div>
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
                        <i class="fas fa-building"></i>
                        <span>LuxuryVillas</span>
                    </div>
                    <p>Your premier destination for luxury real estate. Discover exceptional villas in the world's most desirable locations.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
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

                <div class="footer-column">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="{{ route('services') }}">Property Sales</a></li>
                        <li><a href="{{ route('services') }}">Luxury Rentals</a></li>
                        <li><a href="{{ route('services') }}">Investment Advisory</a></li>
                        <li><a href="{{ route('services') }}">Property Management</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Luxury Avenue, Beverly Hills, CA 90210</li>
                        <li><i class="fas fa-phone"></i> +1 (310) 555-0123</li>
                        <li><i class="fas fa-envelope"></i> info@luxuryvillas.com</li>
                        <li><i class="fas fa-clock"></i> Mon - Sat: 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 LuxuryVillas. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('extra_js')
</body>
</html>

