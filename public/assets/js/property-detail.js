// ==================== Property Gallery ====================
const galleryImages = [
    'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=1200&q=80',
    'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=80',
    'https://images.unsplash.com/photo-1600607687644-c7171b42498f?w=1200&q=80',
    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
    'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=80',
    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=1200&q=80'
];

let currentGalleryIndex = 0;

// Change gallery image
window.changeGalleryImage = function(direction) {
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    currentGalleryIndex += direction;
    
    if (currentGalleryIndex >= galleryImages.length) {
        currentGalleryIndex = 0;
    } else if (currentGalleryIndex < 0) {
        currentGalleryIndex = galleryImages.length - 1;
    }
    
    updateGalleryImage();
};

// Select specific gallery image
window.selectGalleryImage = function(index) {
    currentGalleryIndex = index;
    updateGalleryImage();
};

// Update gallery image and active thumbnail
function updateGalleryImage() {
    const mainImage = document.getElementById('main-gallery-image');
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    if (mainImage && galleryImages[currentGalleryIndex]) {
        mainImage.src = galleryImages[currentGalleryIndex];
    }
    
    thumbnails.forEach((thumbnail, index) => {
        if (index === currentGalleryIndex) {
            thumbnail.classList.add('active');
        } else {
            thumbnail.classList.remove('active');
        }
    });
}

// ==================== Mortgage Calculator ====================
window.calculateMortgage = function() {
    const propertyPrice = 12500000; // $12.5M
    const downPaymentPercent = parseFloat(document.getElementById('down-payment').value) || 20;
    const interestRate = parseFloat(document.getElementById('interest-rate').value) || 6.5;
    const loanTerm = parseInt(document.getElementById('loan-term').value) || 30;
    
    // Calculate down payment
    const downPayment = propertyPrice * (downPaymentPercent / 100);
    const loanAmount = propertyPrice - downPayment;
    
    // Calculate monthly interest rate
    const monthlyRate = (interestRate / 100) / 12;
    
    // Calculate number of payments
    const numberOfPayments = loanTerm * 12;
    
    // Calculate monthly payment using mortgage formula
    const monthlyPayment = loanAmount * 
        (monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) / 
        (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
    
    // Calculate total payment and interest
    const totalPayment = monthlyPayment * numberOfPayments;
    const totalInterest = totalPayment - loanAmount;
    
    // Display results
    const resultDiv = document.getElementById('mortgage-result');
    resultDiv.className = 'mortgage-result show';
    resultDiv.innerHTML = `
        <p><strong>Monthly Payment: $${formatNumber(monthlyPayment.toFixed(0))}</strong></p>
        <p>Down Payment: $${formatNumber(downPayment.toFixed(0))}</p>
        <p>Loan Amount: $${formatNumber(loanAmount.toFixed(0))}</p>
        <p>Total Interest: $${formatNumber(totalInterest.toFixed(0))}</p>
        <p>Total Payment: $${formatNumber(totalPayment.toFixed(0))}</p>
    `;
};

// Format number with commas
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// ==================== Inquiry Form Validation ====================
const inquiryForm = document.getElementById('inquiry-form');

if (inquiryForm) {
    inquiryForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Clear previous errors
        clearInquiryErrors();
        
        // Get form values
        const name = document.getElementById('inquiry-name').value.trim();
        const email = document.getElementById('inquiry-email').value.trim();
        const phone = document.getElementById('inquiry-phone').value.trim();
        const message = document.getElementById('inquiry-message').value.trim();
        
        let isValid = true;
        
        // Validate name
        if (name === '') {
            showInquiryError('inquiry-name', 'Please enter your name');
            isValid = false;
        }
        
        // Validate email
        if (email === '') {
            showInquiryError('inquiry-email', 'Please enter your email');
            isValid = false;
        } else if (!isValidEmail(email)) {
            showInquiryError('inquiry-email', 'Please enter a valid email');
            isValid = false;
        }
        
        // Validate phone
        if (phone === '') {
            showInquiryError('inquiry-phone', 'Please enter your phone number');
            isValid = false;
        }
        
        // Validate message
        if (message === '') {
            showInquiryError('inquiry-message', 'Please enter your message');
            isValid = false;
        }
        
        if (isValid) {
            alert('Thank you for your inquiry! We will contact you shortly.');
            inquiryForm.reset();
        }
    });
}

function showInquiryError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(`${fieldId}-error`);
    const formGroup = field.closest('.form-group');
    
    if (formGroup) {
        formGroup.classList.add('error');
    }
    if (errorElement) {
        errorElement.textContent = message;
    }
}

function clearInquiryErrors() {
    const errorMessages = document.querySelectorAll('.inquiry-form .error-message');
    const formGroups = document.querySelectorAll('.inquiry-form .form-group');
    
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

// ==================== Initialize ====================
document.addEventListener('DOMContentLoaded', function() {
    console.log('Property detail page loaded');
    updateGalleryImage();
});

// ==================== Share Functionality ====================
document.querySelectorAll('.share-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const icon = button.querySelector('i');
        
        if (icon.classList.contains('fa-facebook-f')) {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href, '_blank');
        } else if (icon.classList.contains('fa-twitter')) {
            window.open('https://twitter.com/intent/tweet?url=' + window.location.href, '_blank');
        } else if (icon.classList.contains('fa-linkedin-in')) {
            window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + window.location.href, '_blank');
        } else if (icon.classList.contains('fa-whatsapp')) {
            window.open('https://wa.me/?text=' + window.location.href, '_blank');
        } else if (icon.classList.contains('fa-envelope')) {
            window.location.href = 'mailto:?subject=Check out this property&body=' + window.location.href;
        }
    });
});

// ==================== Favorite/Like Functionality ====================
document.querySelectorAll('.action-btn').forEach(button => {
    button.addEventListener('click', () => {
        const icon = button.querySelector('i');
        
        if (icon.classList.contains('fa-heart')) {
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                button.style.background = '#c9a45e';
                button.style.color = 'white';
                button.style.borderColor = '#c9a45e';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                button.style.background = '';
                button.style.color = '';
                button.style.borderColor = '';
            }
        }
    });
});

