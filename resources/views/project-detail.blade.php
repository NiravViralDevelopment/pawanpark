@extends('layouts.app')

@section('title', $project->title . ' - Luxury Villas')

@section('extra_js')
<script>
// Gallery functionality
let currentImageIndex = 0;
const galleryImages = @json($project->images ?? []);

function changeGalleryImage(direction) {
    if (galleryImages.length === 0) return;
    
    currentImageIndex += direction;
    if (currentImageIndex >= galleryImages.length) currentImageIndex = 0;
    if (currentImageIndex < 0) currentImageIndex = galleryImages.length - 1;
    
    selectGalleryImage(currentImageIndex);
}

function selectGalleryImage(index) {
    currentImageIndex = index;
    const mainImage = document.getElementById('main-gallery-image');
    if (mainImage && galleryImages[index]) {
        mainImage.src = '{{ asset("") }}' + galleryImages[index];
    }
    
    // Update thumbnails
    document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
        thumb.classList.toggle('active', i === index);
    });
}

// Modal Functions
function openBrochureModal() {
    document.getElementById('brochureModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeBrochureModal() {
    document.getElementById('brochureModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    document.getElementById('brochureDownloadForm').reset();
    clearErrors();
}

// Close modal on outside click
document.addEventListener('click', function(event) {
    const modal = document.getElementById('brochureModal');
    if (event.target === modal) {
        closeBrochureModal();
    }
});

// Form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('brochureDownloadForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        clearErrors();
        
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        
        const formData = new FormData(form);
        
        fetch('{{ route("brochure.download") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close modal
                closeBrochureModal();
                
                // Open brochure in new tab
                window.open(data.brochure_url, '_blank');
                
                // Show success message
                alert('Thank you! Your brochure download will begin shortly.');
            } else {
                // Display validation errors
                if (data.errors) {
                    displayErrors(data.errors);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-download"></i> Download Brochure';
        });
    });
});

function clearErrors() {
    document.querySelectorAll('.error-message').forEach(el => {
        el.style.display = 'none';
        el.textContent = '';
    });
    document.querySelectorAll('.form-control').forEach(el => {
        el.classList.remove('is-invalid');
    });
}

function displayErrors(errors) {
    for (const [field, messages] of Object.entries(errors)) {
        const errorElement = document.getElementById(field + '-error');
        const inputElement = document.getElementById(field);
        
        if (errorElement && inputElement) {
            errorElement.textContent = messages[0];
            errorElement.style.display = 'block';
            inputElement.classList.add('is-invalid');
        }
    }
}
</script>
@endsection

@section('content')
<!-- Property Header -->
<section class="property-header">
    <div class="container">
        <div class="property-header-content">
            <div class="property-title-section">
                <h1>{{ $project->title }}</h1>
                @if($project->location)
                    <p class="property-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $project->location }}
                    </p>
                @endif
            </div>
            <div class="property-price-section">
                <div class="property-badges">
                    @if($project->is_featured)
                        <span class="badge badge-featured">Featured</span>
                    @endif
                    @if($project->is_completed)
                        <span class="badge badge-completed">Completed</span>
                    @endif
                    @if($project->is_ongoing)
                        <span class="badge badge-ongoing">Ongoing</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Property Gallery -->
<section class="property-gallery">
    <div class="container">
        <div class="gallery-grid">
            <div class="gallery-main">
                @if($project->images && count($project->images) > 0)
                    <img src="{{ asset($project->images[0]) }}" alt="{{ $project->title }}" id="main-gallery-image">
                    @if(count($project->images) > 1)
                        <button class="gallery-nav-btn prev-gallery" onclick="changeGalleryImage(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="gallery-nav-btn next-gallery" onclick="changeGalleryImage(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                @else
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=80" alt="{{ $project->title }}" id="main-gallery-image">
                @endif
            </div>
            
            @if($project->images && count($project->images) > 1)
                <div class="gallery-thumbnails">
                    @foreach($project->images as $index => $image)
                        <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="selectGalleryImage({{ $index }})">
                            <img src="{{ asset($image) }}" alt="Thumbnail {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Property Details -->
<section class="property-details-section">
    <div class="container">
        <div class="property-layout">
            <div class="property-main-content">
                <!-- Overview -->
                <div class="detail-card">
                    <h2>Property Overview</h2>
                    <div class="property-stats">
                        <div class="stat-item">
                            <i class="fas fa-bed"></i>
                            <div class="stat-info">
                                <span class="stat-value">{{ $project->bedrooms ?? '4' }}</span>
                                <span class="stat-label">Bedrooms</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <i class="fas fa-bath"></i>
                            <div class="stat-info">
                                <span class="stat-value">{{ $project->bathrooms ?? '6' }}</span>
                                <span class="stat-label">Bathrooms</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <i class="fas fa-ruler-combined"></i>
                            <div class="stat-info">
                                <span class="stat-value">{{ $project->sqft ? number_format($project->sqft) : '700' }}</span>
                                <span class="stat-label">Sq Ft</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="stat-info">
                                <span class="stat-value">{{ $project->year_built ?? '2025' }}</span>
                                <span class="stat-label">Year Built</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <i class="fas fa-home"></i>
                            <div class="stat-info">
                                <span class="stat-value">{{ $project->property_type ?? 'Villa' }}</span>
                                <span class="stat-label">Type</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="detail-card">
                    <h2>Description</h2>
                    <div class="description-content">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                <!-- Features & Amenities -->
                <div class="detail-card">
                    <h2>Features & Amenities</h2>
                    <div class="features-grid">
                        <ul class="features-list">
                            @if($project->features_amenities && count($project->features_amenities) > 0)
                                @foreach($project->features_amenities as $feature)
                                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                @endforeach
                            @else
                                <li><i class="fas fa-check"></i> Swimming Pool</li>
                                <li><i class="fas fa-check"></i> Private Garden</li>
                                <li><i class="fas fa-check"></i> Modern Kitchen</li>
                                <li><i class="fas fa-check"></i> Air Conditioning</li>
                                <li><i class="fas fa-check"></i> Security System</li>
                                <li><i class="fas fa-check"></i> Parking Space</li>
                                <li><i class="fas fa-check"></i> Balcony/Terrace</li>
                                <li><i class="fas fa-check"></i> Gym/Fitness Center</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Brochure -->
                @if($project->brochure)
                    <div class="detail-card">
                        <h2>Download Brochure</h2>
                        <button type="button" onclick="openBrochureModal()" class="brochure-download-btn">
                            <i class="fas fa-file-pdf"></i>
                            <span>Download Project Brochure (PDF)</span>
                        </button>
                    </div>
                @endif

                <!-- Location Map -->
                @if($project->location_iframe)
                    <div class="detail-card">
                        <h2><i class="fas fa-map-marker-alt"></i> Location Map</h2>
                        <div class="map-container">
                            {!! $project->location_iframe !!}
                        </div>
                    </div>
                @endif

                <!-- Video -->
                @if($project->video)
                    <div class="detail-card">
                        <h2><i class="fas fa-video"></i> Project Video</h2>
                        <div class="video-container">
                            @if(filter_var($project->video, FILTER_VALIDATE_URL))
                                {{-- External video URL (YouTube, Vimeo, etc.) --}}
                                @if(str_contains($project->video, 'youtube.com') || str_contains($project->video, 'youtu.be'))
                                    @php
                                        $videoId = '';
                                        if (str_contains($project->video, 'youtube.com')) {
                                            parse_str(parse_url($project->video, PHP_URL_QUERY), $params);
                                            $videoId = $params['v'] ?? '';
                                        } elseif (str_contains($project->video, 'youtu.be')) {
                                            $videoId = basename(parse_url($project->video, PHP_URL_PATH));
                                        }
                                    @endphp
                                    <div class="video-responsive">
                                        <iframe 
                                            src="https://www.youtube.com/embed/{{ $videoId }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                @else
                                    {{-- Other external video URLs --}}
                                    <div class="video-responsive">
                                        <iframe 
                                            src="{{ $project->video }}" 
                                            frameborder="0" 
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif
                            @else
                                {{-- Uploaded video file --}}
                                <video controls class="project-video" controlsList="nodownload">
                                    <source src="{{ asset($project->video) }}" type="video/mp4">
                                    <source src="{{ asset($project->video) }}" type="video/webm">
                                    <source src="{{ asset($project->video) }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="property-sidebar">
                <!-- Contact Form -->
                <div class="sidebar-card contact-card">
                    <h3>Interested in this property?</h3>
                    <p>Contact us for more information</p>
                    <form class="contact-form">
                        <input type="text" placeholder="Your Name" required>
                        <input type="email" placeholder="Your Email" required>
                        <input type="tel" placeholder="Your Phone">
                        <textarea placeholder="Your Message" rows="4" required></textarea>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <!-- Agent Details -->
                <div class="sidebar-card agent-card">
                    <h3>Property Agent</h3>
                    <div class="agent-info">
                        <div class="agent-avatar">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&q=80" alt="Agent">
                        </div>
                        <div class="agent-details">
                            <h4>John Anderson</h4>
                            <p class="agent-title">Senior Property Consultant</p>
                            <div class="agent-contact">
                                <p><i class="fas fa-phone"></i> +1 (310) 555-0198</p>
                                <p><i class="fas fa-envelope"></i> john@luxuryvillas.com</p>
                            </div>
                            <div class="agent-buttons">
                                <a href="{{ route('contact') }}" class="btn btn-outline">Contact Agent</a>
                                <a href="https://wa.me/13105550198?text=Hi, I'm interested in {{ $project->title }}" target="_blank" class="btn btn-whatsapp">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Info -->
                <div class="sidebar-card info-card">
                    <h3>Property Information</h3>
                    <ul class="info-list">
                        @if($project->location)
                            <li>
                                <span class="info-label">Location</span>
                                <span class="info-value">{{ $project->location }}</span>
                            </li>
                        @endif
                        @if($project->property_type)
                            <li>
                                <span class="info-label">Property Type</span>
                                <span class="info-value">{{ $project->property_type }}</span>
                            </li>
                        @endif
                        <li>
                            <span class="info-label">Status</span>
                            <span class="info-value">
                                @if($project->is_featured) Featured @endif
                                @if($project->is_completed) Completed @endif
                                @if($project->is_ongoing) Ongoing @endif
                            </span>
                        </li>
                        <li>
                            <span class="info-label">Listed</span>
                            <span class="info-value">{{ $project->created_at->format('M d, Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Properties -->
@if($relatedProjects && $relatedProjects->count() > 0)
    <section class="related-properties">
        <div class="container">
            <h2>Similar Properties</h2>
            <div class="villas-grid">
                @foreach($relatedProjects as $related)
                    <div class="villa-card">
                        <div class="villa-image">
                            @if($related->images && count($related->images) > 0)
                                <img src="{{ asset($related->images[0]) }}" alt="{{ $related->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&q=80" alt="{{ $related->title }}">
                            @endif
                        </div>
                        <div class="villa-info">
                            <h3>{{ $related->title }}</h3>
                            @if($related->location)
                                <p class="villa-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $related->location }}
                                </p>
                            @endif
                            <div class="villa-features">
                                @if($related->bedrooms)
                                    <span><i class="fas fa-bed"></i> {{ $related->bedrooms }} Beds</span>
                                @endif
                                @if($related->bathrooms)
                                    <span><i class="fas fa-bath"></i> {{ $related->bathrooms }} Baths</span>
                                @endif
                                @if($related->sqft)
                                    <span><i class="fas fa-ruler-combined"></i> {{ number_format($related->sqft) }} sqft</span>
                                @endif
                            </div>
                            <div class="villa-footer">
                                <a href="{{ route('project.detail', $related->id) }}" class="btn btn-secondary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Brochure Download Modal -->
<div id="brochureModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-file-pdf"></i> Download Brochure</h2>
            <button type="button" class="modal-close" onclick="closeBrochureModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p class="modal-description">Please provide your contact information to download the project brochure.</p>
            <form id="brochureDownloadForm">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                
                <div class="form-group">
                    <label for="name">Name <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" required>
                    <span class="error-message" id="name-error"></span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" class="form-control" required maxlength="10" minlength="10">
                    <span class="error-message" id="phone-error"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email <span class="optional">(Optional)</span></label>
                    <input type="email" id="email" name="email" class="form-control">
                    <span class="error-message" id="email-error"></span>
                </div>

                <div class="form-group">
                    <label for="message">Message <span class="optional">(Optional)</span></label>
                    <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                    <span class="error-message" id="message-error"></span>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeBrochureModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-download"></i> Download Brochure
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Sidebar Card Styling */
.sidebar-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.sidebar-card h3 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #2c3e50;
}

.badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    display: inline-block;
    margin-right: 8px;
}

.badge-featured {
    background: #ffc107;
    color: #333;
}

.badge-completed {
    background: #28a745;
    color: white;
}

.badge-ongoing {
    background: #17a2b8;
    color: white;
}

.brochure-download-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 15px 25px;
    background: #dc3545;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    width: 100%;
    justify-content: center;
    font-size: 16px;
}

.brochure-download-btn:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.brochure-download-btn i {
    font-size: 24px;
}

.related-properties {
    padding: 80px 0;
    background: #f8f9fa;
}

.related-properties h2 {
    text-align: center;
    font-size: 36px;
    margin-bottom: 50px;
    color: #2c3e50;
}

.description-content {
    line-height: 1.8;
    color: #555;
}

.description-content p {
    margin-bottom: 15px;
}

/* Contact Form Styling */
.contact-card h3 {
    font-size: 22px;
    margin-bottom: 10px;
    color: #2c3e50;
}

.contact-card p {
    color: #666;
    margin-bottom: 20px;
    font-size: 14px;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    background: #fff;
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: #c9a05c;
    box-shadow: 0 0 0 3px rgba(201, 160, 92, 0.1);
}

.contact-form textarea {
    resize: vertical;
    min-height: 100px;
}

.contact-form button {
    width: 100%;
    padding: 14px 30px;
    background: #c9a05c;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.contact-form button:hover {
    background: #b08d4a;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201, 160, 92, 0.3);
}

/* Agent Card Styling */
.agent-card {
    text-align: center;
}

.agent-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.agent-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 20px;
    border: 4px solid #c9a05c;
}

.agent-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.agent-details {
    width: 100%;
}

.agent-details h4 {
    font-size: 20px;
    margin-bottom: 5px;
    color: #2c3e50;
}

.agent-title {
    color: #c9a05c;
    font-size: 14px;
    margin-bottom: 15px;
}

.agent-contact {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: left;
}

.agent-contact p {
    margin: 8px 0;
    color: #555;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.agent-contact i {
    color: #c9a05c;
    width: 16px;
}

.agent-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%;
}

.btn-outline {
    display: inline-block;
    padding: 12px 30px;
    border: 2px solid #c9a05c;
    color: #c9a05c;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-align: center;
}

.btn-outline:hover {
    background: #c9a05c;
    color: white;
}

.btn-whatsapp {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 30px;
    background: #25D366;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 2px solid #25D366;
}

.btn-whatsapp:hover {
    background: #128C7E;
    border-color: #128C7E;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

.btn-whatsapp i {
    font-size: 18px;
}

/* Property Info Card Styling */
.info-card .info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-card .info-list li {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.info-card .info-list li:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 500;
    color: #666;
    font-size: 14px;
}

.info-value {
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
    text-align: right;
}

/* Video Section Styling */
.video-container {
    position: relative;
    width: 100%;
    margin-top: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
}

.video-responsive {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
}

.video-responsive iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.project-video {
    width: 100%;
    max-width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    background: #000;
    min-height: 400px;
}

.project-video:focus {
    outline: none;
}

/* Map Section Styling */
.map-container {
    position: relative;
    width: 100%;
    height: 450px;
    margin-top: 20px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
    border-radius: 8px;
}

.detail-card h2 i {
    color: #c9a05c;
    margin-right: 10px;
    font-size: 24px;
}

@media (max-width: 768px) {
    .map-container {
        height: 350px;
    }
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-content {
    background: white;
    border-radius: 12px;
    max-width: 500px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    padding: 25px 30px;
    border-bottom: 1px solid #e5e5e5;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 24px;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-header i {
    color: #dc3545;
}

.modal-close {
    background: none;
    border: none;
    font-size: 32px;
    color: #999;
    cursor: pointer;
    line-height: 1;
    transition: color 0.3s;
}

.modal-close:hover {
    color: #333;
}

.modal-body {
    padding: 30px;
}

.modal-description {
    color: #666;
    margin-bottom: 25px;
    line-height: 1.6;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.required {
    color: #dc3545;
}

.optional {
    color: #999;
    font-weight: normal;
    font-size: 13px;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s;
}

.form-control:focus {
    outline: none;
    border-color: #2c3e50;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.error-message {
    display: none;
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 30px;
}

.btn {
    padding: 12px 30px;
    border-radius: 6px;
    border: none;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary {
    background: #2c3e50;
    color: white;
}

.btn-primary:hover {
    background: #1a252f;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

@media (max-width: 576px) {
    .modal-content {
        margin: 10px;
    }
    
    .modal-header, .modal-body {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
