// ==================== Global Variables ====================
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let slideInterval;

// ==================== Navbar Scroll Effect ====================
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// ==================== Mobile Menu Toggle ====================
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');

if (hamburger) {
    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });

    // Close menu when clicking on a link
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });
}

// ==================== Hero Slider ====================
function showSlide(index) {
    if (!slides || slides.length === 0) return;
    
    // Wrap around
    if (index >= slides.length) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = slides.length - 1;
    } else {
        currentSlide = index;
    }

    // Remove active class from all slides and dots
    slides.forEach(slide => slide.classList.remove('active'));
    if (dots && dots.length) {
        dots.forEach(dot => dot.classList.remove('active'));
    }

    // Add active class to current slide and dot
    if (slides[currentSlide]) {
        slides[currentSlide].classList.add('active');
    }
    if (dots && dots[currentSlide]) {
        dots[currentSlide].classList.add('active');
    }
}

// Global functions for onclick handlers
window.changeSlide = function(direction) {
    showSlide(currentSlide + direction);
    resetSlideInterval();
}

window.currentSlide = function(index) {
    showSlide(index);
    resetSlideInterval();
}

function resetSlideInterval() {
    clearInterval(slideInterval);
    startSlideInterval();
}

function startSlideInterval() {
    if (slides && slides.length > 0) {
        slideInterval = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000); // Change slide every 5 seconds
    }
}

// Initialize slider when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    if (slides && slides.length > 0) {
        console.log('Slider initialized with', slides.length, 'slides');
        showSlide(0);
        startSlideInterval();
    }
});

// ==================== Smooth Scrolling ====================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href !== '#!') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// ==================== Projects Filter ====================
const filterButtons = document.querySelectorAll('.filter-btn');
const villaCards = document.querySelectorAll('.villa-card[data-category]');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        
        // Add active class to clicked button
        button.classList.add('active');
        
        const filterValue = button.getAttribute('data-filter');
        
        // Filter villa cards
        villaCards.forEach(card => {
            if (filterValue === 'all') {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.6s ease forwards';
            } else {
                const category = card.getAttribute('data-category');
                if (category === filterValue) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
});

// ==================== Contact Form Validation ====================
const contactForm = document.getElementById('contact-form');

if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Clear previous errors
        clearErrors();
        
        // Get form values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim().replace(/\s+/g, '');
        const message = document.getElementById('message').value.trim();
        
        let isValid = true;
        
        // Validate name
        if (name === '') {
            showError('name', 'Please enter your full name');
            isValid = false;
        } else if (name.length < 2) {
            showError('name', 'Name must be at least 2 characters long');
            isValid = false;
        }
        
        // Validate email (optional)
        if (email !== '' && !isValidEmail(email)) {
            showError('email', 'Please enter a valid email address');
            isValid = false;
        }
        
        // Validate phone (required - Indian format)
        if (phone === '') {
            showError('phone', 'Please enter your phone number');
            isValid = false;
        } else if (!isValidIndianPhone(phone)) {
            showError('phone', 'Please enter a valid Indian phone number (10 digits starting with 6-9)');
            isValid = false;
        }
        
        // Message is optional - no validation needed
        
        // If form is valid, submit to server
        if (isValid) {
            // Disable submit button
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            // Prepare form data
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email || '');
            formData.append('phone', phone);
            formData.append('message', message || '');
            formData.append('_token', csrfToken);
            
            // Submit form via AJAX
            fetch('/contact', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    contactForm.style.display = 'none';
                    const successMessage = document.getElementById('form-success-message');
                    if (successMessage) {
                        successMessage.style.display = 'block';
                    }
                    
                    // Reset form after 5 seconds
                    setTimeout(() => {
                        contactForm.reset();
                        contactForm.style.display = 'block';
                        if (successMessage) {
                            successMessage.style.display = 'none';
                        }
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalBtnText;
                        clearErrors();
                    }, 5000);
                } else {
                    // Show validation errors from server
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            showError(field, data.errors[field][0]);
                        });
                    }
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('message', 'An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            });
        }
    });
}

function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(`${fieldId}-error`);
    const formGroup = field.closest('.form-group');
    
    formGroup.classList.add('error');
    errorElement.textContent = message;
}

function clearErrors() {
    const errorMessages = document.querySelectorAll('.error-message');
    const formGroups = document.querySelectorAll('.form-group');
    
    errorMessages.forEach(error => {
        error.textContent = '';
    });
    
    formGroups.forEach(group => {
        group.classList.remove('error');
    });
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidIndianPhone(phone) {
    // Remove all spaces and non-digit characters except +
    const cleanPhone = phone.trim().replace(/\s+/g, '');
    
    // Indian phone number validation:
    // - Can start with +91, 91, or 0
    // - Must have 10 digits
    // - First digit (after country code) must be 6, 7, 8, or 9
    
    // Remove +91, 91, or 0 prefix if present
    let digits = cleanPhone.replace(/^\+91|^91|^0/, '');
    
    // Check if we have exactly 10 digits
    if (!/^\d{10}$/.test(digits)) {
        return false;
    }
    
    // Check if first digit is 6, 7, 8, or 9
    const firstDigit = parseInt(digits[0]);
    return firstDigit >= 6 && firstDigit <= 9;
}

// Real-time validation
if (contactForm) {
    const formInputs = contactForm.querySelectorAll('input, textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('blur', () => {
            const fieldId = input.id;
            const value = input.value.trim();
            const formGroup = input.closest('.form-group');
            const errorElement = document.getElementById(`${fieldId}-error`);
            
            // Clear error for this field
            formGroup.classList.remove('error');
            errorElement.textContent = '';
            
            // Validate on blur
            if (fieldId === 'name' && value !== '' && value.length < 2) {
                showError(fieldId, 'Name must be at least 2 characters long');
            } else if (fieldId === 'email' && value !== '' && !isValidEmail(value)) {
                showError(fieldId, 'Please enter a valid email address');
            } else if (fieldId === 'phone' && value !== '' && !isValidIndianPhone(value)) {
                showError(fieldId, 'Please enter a valid Indian phone number (10 digits starting with 6-9)');
            }
        });
    });
}

// ==================== Scroll to Top Button ====================
// Create a scroll to top button dynamically
const scrollButton = document.createElement('button');
scrollButton.innerHTML = '<i class="fas fa-arrow-up"></i>';
scrollButton.className = 'scroll-to-top';
scrollButton.style.cssText = `
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--gold);
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 999;
    box-shadow: 0 5px 15px rgba(201, 164, 94, 0.3);
`;

document.body.appendChild(scrollButton);

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollButton.style.opacity = '1';
        scrollButton.style.visibility = 'visible';
    } else {
        scrollButton.style.opacity = '0';
        scrollButton.style.visibility = 'hidden';
    }
});

scrollButton.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

scrollButton.addEventListener('mouseenter', () => {
    scrollButton.style.transform = 'translateY(-5px)';
    scrollButton.style.boxShadow = '0 8px 20px rgba(201, 164, 94, 0.4)';
});

scrollButton.addEventListener('mouseleave', () => {
    scrollButton.style.transform = 'translateY(0)';
    scrollButton.style.boxShadow = '0 5px 15px rgba(201, 164, 94, 0.3)';
});

// ==================== Loading Animation ====================
window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 100);
});

// ==================== Image Lazy Loading (if needed) ====================
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                observer.unobserve(img);
            }
        });
    });

    // Observe all images with data-src attribute
    const lazyImages = document.querySelectorAll('img[data-src]');
    lazyImages.forEach(img => imageObserver.observe(img));
}

// ==================== Prevent Right Click on Images (Optional) ====================
// Uncomment if you want to protect images
/*
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('contextmenu', (e) => {
        e.preventDefault();
    });
});
*/

// ==================== Console Welcome Message ====================
console.log('%c Welcome to Luxury Villas ', 'background: #c9a45e; color: white; font-size: 20px; padding: 10px;');
console.log('%c Premium Real Estate Solutions ', 'color: #2c2c2c; font-size: 14px;');

