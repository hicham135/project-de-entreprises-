<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Clean user input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Redirect to a specific page
function redirect($location) {
    header("Location: $location");
    exit;
}

// Display error message
function display_error($message) {
    return '<div class="error-message">' . $message . '</div>';
}

// Display success message
function display_success($message) {
    return '<div class="success-message">' . $message . '</div>';
}

// Register a new user
function register_user($name, $email, $password) {
    global $conn;
    
    // Validate input
    if (empty($name) || empty($email) || empty($password)) {
        return ['success' => false, 'message' => 'Please fill in all fields'];
    }
    
    // Check if email already exists
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    if (mysqli_stmt_num_rows($stmt) > 0) {
        return ['success' => false, 'message' => 'Email already exists'];
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
    
    if (mysqli_stmt_execute($stmt)) {
        return ['success' => true, 'message' => 'Registration successful'];
    } else {
        return ['success' => false, 'message' => 'Registration failed'];
    }
}

// Login a user
function login_user($email, $password) {
    global $conn;
    
    // Validate input
    if (empty($email) || empty($password)) {
        return ['success' => false, 'message' => 'Please fill in all fields'];
    }
    
    // Check if user exists
    $sql = "SELECT id, name, email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            return ['success' => true, 'message' => 'Login successful'];
        } else {
            return ['success' => false, 'message' => 'Invalid password'];
        }
    } else {
        return ['success' => false, 'message' => 'User not found'];
    }
}

// Subscribe to newsletter
function subscribe_newsletter($email) {
    global $conn;
    
    // Validate email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Please enter a valid email'];
    }
    
    // Check if email already subscribed
    $sql = "SELECT id FROM newsletter_subscribers WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    if (mysqli_stmt_num_rows($stmt) > 0) {
        return ['success' => true, 'message' => 'You are already subscribed'];
    }
    
    // Insert new subscriber
    $sql = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    
    if (mysqli_stmt_execute($stmt)) {
        return ['success' => true, 'message' => 'Subscription successful'];
    } else {
        return ['success' => false, 'message' => 'Subscription failed'];
    }
}

// Save contact form message
function save_contact_message($name, $email, $subject, $message) {
    global $conn;
    
    // Validate input
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        return ['success' => false, 'message' => 'Please fill in all fields'];
    }
    
    // Insert message
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
    
    if (mysqli_stmt_execute($stmt)) {
        return ['success' => true, 'message' => 'Message sent successfully'];
    } else {
        return ['success' => false, 'message' => 'Failed to send message'];
    }
}

// Get all categories
function get_categories() {
    global $conn;
    
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    
    $categories = [];
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }
    
    return $categories;
}

// Get products by category
function get_products_by_category($category_id) {
    global $conn;
    
    $sql = "SELECT * FROM products WHERE category_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $products = [];
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
    }
    
    return $products;
}

// Get product details
function get_product_details($product_id) {
    global $conn;
    
    $sql = "SELECT p.*, c.name as category_name FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE p.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        
        // Get product images
        $sql = "SELECT * FROM product_images WHERE product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);
        $image_result = mysqli_stmt_get_result($stmt);
        
        $product['images'] = [];
        if (mysqli_num_rows($image_result) > 0) {
            while($row = mysqli_fetch_assoc($image_result)) {
                $product['images'][] = $row;
            }
        }
        
        return $product;
    }
    
    return null;
}
?>
