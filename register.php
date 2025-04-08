<?php
// Include database and functions
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is already logged in
if (is_logged_in()) {
    redirect('index.php');
}

// Initialize variables
$name = $email = $password = $confirm_password = "";
$name_err = $email_err = $password_err = $confirm_password_err = $register_err = "";

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = clean_input($_POST["name"]);
    }
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = clean_input($_POST["email"]);
        
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email address.";
        } else {
            // Check if email already exists
            $sql = "SELECT id FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $email_err = "This email is already registered.";
            }
        }
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = clean_input($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = clean_input($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Passwords do not match.";
        }
    }
    
    // Check input errors before registering
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Attempt to register
        $result = register_user($name, $email, $password);
        
        if ($result['success']) {
            // Attempt login after successful registration
            $login_result = login_user($email, $password);
            
            if ($login_result['success']) {
                redirect('index.php');
            } else {
                // Redirect to login page on success
                redirect('login.php');
            }
        } else {
            $register_err = $result['message'];
        }
    }
}

// Include header
$page_title = "Sign Up";
include 'includes/header.php';
?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-image">
            <div class="overlay"></div>
            <div class="auth-content">
                <h2 class="logo"><i class='bx bxl-building'></i>Eurozak Industrie</h2>
                <div class="text-section">
                    <h2>Join Our Community<br><span>For Premium Interior Solutions</span></h2>
                    <p>Create an account to access exclusive deals, save your favorite designs, and get personalized recommendations.</p>
                    <div class="social-links">
                        <a href="https://facebook.com/eurozakindustry" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="https://instagram.com/eurozakindustrie" target="_blank"><i class='bx bxl-instagram'></i></a>
                        <a href="https://wa.me/212640810396" target="_blank"><i class='bx bxl-whatsapp'></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="auth-form-container">
            <div class="form-box register">
                <h2>Sign Up</h2>
                
                <?php if (!empty($register_err)): ?>
                    <div class="error-message"><?php echo $register_err; ?></div>
                <?php endif; ?>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-box <?php echo (!empty($name_err)) ? 'error' : ''; ?>">
                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>
                        <label>Full Name</label>
                        <?php if (!empty($name_err)): ?>
                            <span class="error-text"><?php echo $name_err; ?></span>
                        <?php endif; ?>
                    </div>
                    
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
                    
                    <div class="input-box <?php echo (!empty($confirm_password_err)) ? 'error' : ''; ?>">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <label>Confirm Password</label>
                        <?php if (!empty($confirm_password_err)): ?>
                            <span class="error-text"><?php echo $confirm_password_err; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="terms">
                        <label><input type="checkbox" name="terms" required> I agree to the <a href="terms.php">Terms & Conditions</a></label>
                    </div>
                    
                    <button type="submit" class="btn">Sign Up</button>
                    
                    <div class="login-register">
                        <p>Already have an account? <a href="login.php" class="login-link">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
