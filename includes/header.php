<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Include database and functions
include_once 'config/database.php';
include_once 'includes/functions.php';

// Get current page
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eurozak Industrie - Premium furniture and interiors for kitchens, offices, and salons">
    <meta name="keywords" content="kitchen design, reception desk, salon furniture, interior design, construction, Morocco">
    <meta name="author" content="Eurozak Industrie">
    
    <!-- Favicon -->
    <link rel="stylesheet" href="assets/css/style.css">
    <?php if ($current_page == 'contact.php'): ?>
    <link rel="stylesheet" href="assets/css/contact.css">
    <?php endif; ?>
    <?php if ($current_page == 'categories.php' || $current_page == 'product-detail.php'): ?>
    <link rel="stylesheet" href="assets/css/categories.css">
    <?php endif; ?>
    <?php if ($current_page == 'login.php' || $current_page == 'register.php'): ?>
    <link rel="stylesheet" href="assets/css/authentication.css">
    <?php endif; ?>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" crossorigin="anonymous">
    <title>
        <?php
        if ($current_page == 'index.php') echo 'Eurozak Industrie - Premium Interior Solutions';
        else if ($current_page == 'service.php') echo 'Our Services - Eurozak Industrie';
        else if ($current_page == 'categories.php') echo 'Our Categories - Eurozak Industrie';
        else if ($current_page == 'product-detail.php') echo 'Product Details - Eurozak Industrie';
        else if ($current_page == 'contact.php') echo 'Contact Us - Eurozak Industrie';
        else if ($current_page == 'login.php') echo 'Sign In - Eurozak Industrie';
        else if ($current_page == 'register.php') echo 'Sign Up - Eurozak Industrie';
        else echo 'Eurozak Industrie';
        ?>
    </title>
</head>
<body>
    <header>
        <div class="menu">
            <button id="buttonMenu"><img src="assets/images/icons/menu.png" class="menu_icons" alt="Menu"></button>
            <ul>
                <li><a href="index.php" <?php echo ($current_page == 'index.php') ? 'class="active"' : ''; ?>>Home</a></li>
                <li><a href="service.php" <?php echo ($current_page == 'service.php') ? 'class="active"' : ''; ?>>Services</a></li>
                <li><a href="categories.php" <?php echo ($current_page == 'categories.php') ? 'class="active"' : ''; ?>>Categories</a></li>
                <li><a href="contact.php" <?php echo ($current_page == 'contact.php') ? 'class="active"' : ''; ?>>Contact</a></li>
            </ul>
        </div>
        
        <a href="index.php" class="logo-container">
            <img src="assets/images/logo3.png"  alt="Eurozak Industrie" class="logo"  >
        </a>
        
        <div class="header-end">
            <!-- Navigation dropdown -->
            <i class='bx bxs-chevron-down-circle page-nav'>
                <div class="nav-dropdown">
                    <?php if ($current_page == 'index.php'): ?>
                    <a href="#who-we-are"><span>Who We Are</span></a>
                    <a href="#our-services"><span>Our Services</span></a>
                    <a href="#best-offers"><span>Best Offers</span></a>
                    <a href="#contact"><span>Contact</span></a>
                    <?php elseif ($current_page == 'service.php'): ?>
                    <a href="#our-services"><span>Our Services</span></a>
                    <a href="#best-offers"><span>Best Offers</span></a>
                    <a href="#contact"><span>Contact</span></a>
                    <a href="#newsletter"><span>Newsletter</span></a>
                    <?php elseif ($current_page == 'categories.php'): ?>
                    <a href="#kitchen"><span>Kitchen Designs</span></a>
                    <a href="#reception"><span>Reception Designs</span></a>
                    <a href="#salon"><span>Salon Designs</span></a>
                    <a href="#offers"><span>Special Offers</span></a>
                    <?php elseif ($current_page == 'contact.php'): ?>
                    <a href="#location"><span>Our Location</span></a>
                    <a href="#message-form"><span>Leave a Message</span></a>
                    <a href="#best-offers"><span>Best Offers</span></a>
                    <a href="#newsletter"><span>Newsletter</span></a>
                    <?php endif; ?>
                </div>
            </i>
            
            <!-- User account dropdown -->
            <img src="assets/images/log1.jpg"  height="2px" width="30px">
                <div class="account-dropdown">
                    <?php if (is_logged_in()): ?>
                    <div class="user-info">
                        <p>Welcome, <?php echo $_SESSION['user_name']; ?></p>
                    </div>
                    <hr>
                    <a href="logout.php" class="logout-btn"><span>Sign Out</span></a>
                    <?php else: ?>
                    <a href="login.php" class="login-btn"><span>Sign In</span></a>
                    <hr>
                    <p>Don't have an account yet?</p>
                    <a href="register.php" class="register-btn"><span>Join Eurozak</span></a>
                    <?php endif; ?>
                </div>
            </i>
        </div>
    </header>
    
    <main>
