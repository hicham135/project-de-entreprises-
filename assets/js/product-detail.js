document.addEventListener('DOMContentLoaded', function() {
    // Image gallery functionality
    initImageGallery();
    
    // Tabs functionality
    initTabs();
    
    // Product action buttons
    initActionButtons();
});

// Initialize image gallery
function initImageGallery() {
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail img');
    
    if (!mainImage || thumbnails.length === 0) return;
    
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // Update main image
            mainImage.src = this.src;
            mainImage.alt = this.alt;
            
            // Update active thumbnail
            thumbnails.forEach(thumb => {
                thumb.parentElement.classList.remove('active');
            });
            this.parentElement.classList.add('active');
        });
    });
}

// Initialize tabs
function initTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    if (tabButtons.length === 0 || tabContents.length === 0) return;
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to current button and content
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
}

// Initialize action buttons
function initActionButtons() {
    const requestQuoteBtn = document.querySelector('.request-quote-btn');
    const contactBtn = document.querySelector('.contact-btn');
    
    if (requestQuoteBtn) {
        requestQuoteBtn.addEventListener('click', function() {
            // Get product ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id');
            
            // Redirect to contact page with product ID
            window.location.href = `contact.php?product=${productId}`;
        });
    }
    
    if (contactBtn) {
        contactBtn.addEventListener('click', function() {
            window.location.href = 'contact.php';
        });
    }
}
