document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.getElementById('newsletter-form');
    const resultElement = document.getElementById('newsletter-result');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            
            const emailInput = document.getElementById('newsletter_email');
            const email = emailInput.value.trim();
            
            
            if (!email) {
                showResult('Please enter your email address.', 'error');
                return;
            }
            
            
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailPattern.test(email)) {
                showResult('Please enter a valid email address.', 'error');
                return;
            }
            
            // Prepare form data
            const formData = new FormData();
            formData.append('email', email);
            formData.append('action', 'subscribe');
            
            // Show loading state
            showResult('Subscribing...', 'info');
            
            // Send AJAX request
            fetch('newsletter-subscribe.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showResult(data.message, 'success');
                    emailInput.value = ''; // Clear input on success
                } else {
                    showResult(data.message, 'error');
                }
            })
            .catch(error => {
                showResult('An error occurred. Please try again.', 'error');
                console.error('Newsletter subscription error:', error);
            });
        });
    }
    
    // Function to show result message
    function showResult(message, type) {
        if (resultElement) {
            resultElement.textContent = message;
            resultElement.className = ''; // Clear previous classes
            resultElement.classList.add(type);
            resultElement.style.display = 'block';
            
            // Hide success message after 5 seconds
            if (type === 'success') {
                setTimeout(() => {
                    resultElement.style.display = 'none';
                }, 5000);
            }
        }
    }
});
