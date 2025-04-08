document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    
    passwordInputs.forEach(function(input) {
        // Create toggle button
        const toggleBtn = document.createElement('span');
        toggleBtn.className = 'password-toggle';
        toggleBtn.innerHTML = '<i class="bx bx-hide"></i>';
        
        // Add toggle button after input
        input.parentNode.appendChild(toggleBtn);
        
        // Toggle password visibility
        toggleBtn.addEventListener('click', function() {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle icon
            this.innerHTML = type === 'password' ? '<i class="bx bx-hide"></i>' : '<i class="bx bx-show"></i>';
        });
    });
    
    // Form validation
    const forms = document.querySelectorAll('.auth-form-container form');
    
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check required fields
            const requiredInputs = form.querySelectorAll('input[required]');
            
            requiredInputs.forEach(function(input) {
                if (!input.value.trim()) {
                    isValid = false;
                    input.parentNode.classList.add('error');
                } else {
                    input.parentNode.classList.remove('error');
                }
            });
            
            // Check email format
            const emailInput = form.querySelector('input[type="email"]');
            
            if (emailInput && emailInput.value.trim()) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!emailPattern.test(emailInput.value.trim())) {
                    isValid = false;
                    emailInput.parentNode.classList.add('error');
                    
                    // Create error message if it doesn't exist
                    if (!emailInput.parentNode.querySelector('.error-text')) {
                        const errorText = document.createElement('span');
                        errorText.className = 'error-text';
                        errorText.textContent = 'Please enter a valid email address.';
                        emailInput.parentNode.appendChild(errorText);
                    }
                }
            }
            
            // Check password match for registration form
            const passwordInput = form.querySelector('input[name="password"]');
            const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');
            
            if (passwordInput && confirmPasswordInput) {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    isValid = false;
                    confirmPasswordInput.parentNode.classList.add('error');
                    
                    // Create error message if it doesn't exist
                    if (!confirmPasswordInput.parentNode.querySelector('.error-text')) {
                        const errorText = document.createElement('span');
                        errorText.className = 'error-text';
                        errorText.textContent = 'Passwords do not match.';
                        confirmPasswordInput.parentNode.appendChild(errorText);
                    }
                }
            }
            
            // Prevent form submission if not valid
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    
    // Clear error on input
    const formInputs = document.querySelectorAll('.input-box input');
    
    formInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.parentNode.classList.remove('error');
            
            // Remove error message
            const errorText = this.parentNode.querySelector('.error-text');
            
            if (errorText) {
                errorText.remove();
            }
        });
    });
});
