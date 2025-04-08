<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'hicham');
define('DB_PASSWORD', 'password123'); // Set your password if you have one
define('DB_NAME', 'ez_industry');

// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
}
?>
