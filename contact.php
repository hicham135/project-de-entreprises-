<?php
// Include header
include 'includes/header.php';

// Initialize variables
$name = $email = $subject = $message = "";
$name_err = $email_err = $subject_err = $message_err = "";
$form_message = "";
$form_status = "";

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
        }
    }
    
    // Validate subject
    if (empty(trim($_POST["subject"]))) {
        $subject_err = "Please enter a subject.";
    } else {
        $subject = clean_input($_POST["subject"]);
    }
    
    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = clean_input($_POST["message"]);
    }
    
    // Check input errors before saving message
    if (empty($name_err) && empty($email_err) && empty($subject_err) && empty($message_err)) {
        // Save message
        $result = save_contact_message($name, $email, $subject, $message);
        
        if ($result['success']) {
            $form_message = $result['message'];
            $form_status = "success";
            
            // Clear form fields
            $name = $email = $subject = $message = "";
        } else {
            $form_message = $result['message'];
            $form_status = "error";
        }
    }
}
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with our team to discuss your project or ask any questions</p>
    </div>
</section>

<!-- Contact Details Section -->
<section class="contact-details" id="location">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Visit Our Location or Contact Us Today</h2>
                <h3>Head Office</h3>
                <ul>
                    <li>
                        <img src="assets/images/mp1.png" height="30px" width="30px">
                        <p>46 Boulevard Zerktouni, Casablanca, Morocco 20400</p>
                    </li>
                    <li>
                    <img src="assets/images/gm1.png" height="30px" width="30px">
                        <p>eurozakindustry@gmail.com</p>
                    </li>
                    <li>
                    <img src="assets/images/ph2.png" height="30px" width="30px">
                        <p>+212 640 810 396</p>
                    </li>
                    <li>
                    <img src="assets/images/cl2.jpg" height="30px" width="30px">
                        <p>Monday to Saturday: 8:30 AM to 6:00 PM</p>
                    </li>
                </ul>
                
                <div class="social-links">
                    <h4>Follow Us</h4>
                    <a href="https://facebook.com/eurozakindustry" target="_blank"><img src="assets/images/f1.png"></img></a>
                    <a href="https://instagram.com/eurozakindustrie" target="_blank"><img src="assets/images/in1.jpg"></img></a>
                    <a href="https://twitter.com/eurozakindustry" target="_blank"><img src="assets/images/twww1.png"></img></a>
                    <a href="https://wa.me/212640810396" target="_blank"><img src="assets/images/wh1.png"></img></a>
                </div>
            </div>
            
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.8631513048826!2d-7.6215158259064095!3d33.58290224236972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2a267f16167%3A0x30e348bc08aa87d2!2s46%20Bd%20Mohamed%20Zerktouni%2C%20Casablanca%2020250!5e0!3m2!1sen!2sma!4v1723851752959!5m2!1sen!2sma" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form" id="message-form">
    <div class="container">
        <div class="form-container">
            <h2>Leave A Message</h2>
            <h3>Your Feedback Matters</h3>
            
            <?php if (!empty($form_message)): ?>
                <div class="form-message <?php echo $form_status; ?>">
                    <?php echo $form_message; ?>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#message-form" method="post">
                <div class="form-group <?php echo (!empty($name_err)) ? 'error' : ''; ?>">
                    <input type="text" name="name" id="name" placeholder="Your Name" value="<?php echo $name; ?>" required>
                    <?php if (!empty($name_err)): ?>
                        <span class="error-text"><?php echo $name_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group <?php echo (!empty($email_err)) ? 'error' : ''; ?>">
                    <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $email; ?>" required>
                    <?php if (!empty($email_err)): ?>
                        <span class="error-text"><?php echo $email_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group <?php echo (!empty($subject_err)) ? 'error' : ''; ?>">
                    <input type="text" name="subject" id="subject" placeholder="Subject" value="<?php echo $subject; ?>" required>
                    <?php if (!empty($subject_err)): ?>
                        <span class="error-text"><?php echo $subject_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="form-group <?php echo (!empty($message_err)) ? 'error' : ''; ?>">
                    <textarea name="message" id="message" placeholder="Your Message" required><?php echo $message; ?></textarea>
                    <?php if (!empty($message_err)): ?>
                        <span class="error-text"><?php echo $message_err; ?></span>
                    <?php endif; ?>
                </div>
                
                <button type="submit" class="btn primary-btn">Submit</button>
            </form>
        </div>
    </div>
</section>

<!-- Special Offers Banner -->
<section class="offers-preview" id="best-offers">
    <div class="container">
        <div class="offers-grid">
            <div class="offer-item">
                <div class="offer-content">
                    <h4>Best Offer</h4>
                    <p>The kitchen features a sleek, modern design with dark matte cabinets contrasted by warm natural wood elements.</p>
                    <a href="categories.php?category=1" class="btn outline-btn">Learn More</a>
                </div>
                <div class="offer-background kitchen-offer"></div>
            </div>
            
            <div class="offer-item">
                <div class="offer-content">
                    <h4>Best Offer</h4>
                    <p>The salon features a black color scheme with dark wood floors and sleek black furniture. Crystal chandeliers add a touch of elegance, while metal accents provide a modern contrast.</p>
                    <a href="categories.php?category=3" class="btn outline-btn">Learn More</a>
                </div>
                <div class="offer-background salon-offer"></div>
            </div>
        </div>
        
        <div class="main-offer">
            <div class="offer-content">
                <h4>Best Offer</h4>
                <p>The reception area features a black and gray color scheme with light wood accents. A wood reception desk with metal highlights is central, surrounded by black wall panels and gray stone flooring. Green plants add a touch of nature, softening the modern, structured design.</p>
                <a href="categories.php?category=2" class="btn outline-btn">Learn More</a>
            </div>
            <div class="offer-background reception-offer"></div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
