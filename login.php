<?php
// Include database and functions
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is already logged in
if (is_logged_in()) {
    redirect('index.php');
}

// Initialize variables
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = clean_input($_POST["email"]);
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = clean_input($_POST["password"]);
    }
    
    // Check input errors before attempting login
    if (empty($email_err) && empty($password_err)) {
        // Attempt to login
        $result = login_user($email, $password);
        
        if ($result['success']) {
            redirect('index.php');
        } else {
            $login_err = $result['message'];
        }
    }
}

// Include header
$page_title = "Sign In";
include 'includes/header.php';
?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-image">
            <div class="overlay"></div>
            <div class="auth-content">
                <h2 class="logo"><i class='bx bxl-building'></i>Eurozak Industrie</h2>
                <div class="text-section">
                    <h2>Welcome Back<br><span>To Our Professional Platform</span></h2>
                    <p>Sign in to access exclusive content, save your preferences, and manage your projects with ease.</p>
                    <div class="social-links">
                        <a href="https://facebook.com/eurozakindustry" target="_blank"><img src="assets/images/f1.png"></img></a>
                        <a href="https://instagram.com/eurozakindustrie" target="_blank"><img src="assets/images/in1.jpg"></img></a>
                        <a href="https://wa.me/212640810396" target="_blank"><img src="assets/images/wh1.png"></img></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="auth-form-container">
            <div class="form-box login">
                <h2>Sign In</h2>
                
                <?php if (!empty($login_err)): ?>
                    <div class="error-message"><?php echo $login_err; ?></div>
                <?php endif; ?>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-box <?php echo (!empty($email_err)) ? 'error' : ''; ?>">
                        <span class="icon"><i class='bx bxl-gmail'></i></span>
                        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                        <label>Email</label>
                        <?php if (!empty($email_err)): ?>
                            <span class="error-text"><?php echo $email_err; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="input-box <?php echo (!empty($password_err)) ? 'error' : ''; ?>">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" name="password" id="password" required>
                        <label>Password</label>
                        <?php if (!empty($password_err)): ?>
                            <span class="error-text"><?php echo $password_err; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="remember-forgot">
                        <label><input type="checkbox" name="remember"> Remember Me</label>
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn">Sign In</button>
                    
                    <div class="login-register">
                        <p>Don't have an account? <a href="register.php" class="register-link">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
