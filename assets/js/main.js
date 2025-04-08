// Wait for DOM content to load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize dropdown menus
    initDropdowns();
    
    // Initialize back to top button
    initBackToTop();
    
    // Initialize slider (if exists)
    if (document.getElementById('hero-slider')) {
        initSlider();
    }
});

// Mobile Menu
function initMobileMenu() {
    const menuButton = document.getElementById('buttonMenu');
    const menuContainer = document.querySelector('.menu ul');
    
    if (menuButton && menuContainer) {
        menuButton.addEventListener('click', function() {
            menuContainer.classList.toggle('active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.menu') && menuContainer.classList.contains('active')) {
                menuContainer.classList.remove('active');
            }
        });
    }
}

// Dropdown Menus
function initDropdowns() {
    // Page navigation dropdown
    const pageNav = document.querySelector('.page-nav');
    
    if (pageNav) {
        pageNav.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const navDropdown = this.querySelector('.nav-dropdown');
            
            if (navDropdown) {
                navDropdown.classList.toggle('active');
            }
        });
    }
    
    // Account dropdown
    const accountIcon = document.querySelector('.account-icon');
    
    if (accountIcon) {
        accountIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const accountDropdown = this.querySelector('.account-dropdown');
            
            if (accountDropdown) {
                accountDropdown.classList.toggle('active');
            }
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        const activeDropdowns = document.querySelectorAll('.nav-dropdown.active, .account-dropdown.active');
        
        activeDropdowns.forEach(function(dropdown) {
            dropdown.classList.remove('active');
        });
    });
}

// Back to Top Button
function initBackToTop() {
    const backToTopBtn = document.querySelector('.back-to-top');
    
    if (backToTopBtn) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });
        
        // Smooth scroll to top
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

// Hero Slider
function initSlider() {
    const slider = document.getElementById('hero-slider');
    const slides = slider.querySelectorAll('.slide');
    const thumbnails = document.querySelectorAll('.thumbnail-container img');
    
    let currentSlide = 0;
    const slideInterval = 5000; // 5 seconds
    
    // Set initial slide
    setActiveSlide(currentSlide);
    
    // Start automatic slideshow
    let slideTimer = setInterval(nextSlide, slideInterval);
    
    // Next slide function
    function nextSlide() {
        setActiveSlide((currentSlide + 1) % slides.length);
    }
    
    // Set active slide
    function setActiveSlide(index) {
        // Update current slide index
        currentSlide = index;
        
        // Remove active class from all slides and thumbnails
        slides.forEach(slide => slide.classList.remove('active'));
        thumbnails.forEach(thumb => thumb.classList.remove('active'));
        
        // Add active class to current slide and thumbnail
        slides[currentSlide].classList.add('active');
        thumbnails[currentSlide].classList.add('active');
        
        // Reset timer
        clearInterval(slideTimer);
        slideTimer = setInterval(nextSlide, slideInterval);
    }
    
    // Allow manual slide selection via thumbnail
    window.setSlide = function(index) {
        setActiveSlide(index);
    };
    
    // Pause slideshow on hover
    slider.addEventListener('mouseenter', function() {
        clearInterval(slideTimer);
    });
    
    // Resume slideshow on mouse leave
    slider.addEventListener('mouseleave', function() {
        slideTimer = setInterval(nextSlide, slideInterval);
    });
}