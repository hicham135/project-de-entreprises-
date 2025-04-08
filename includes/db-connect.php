<?php
// Include database configuration
require_once 'config/database.php';

// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($conn === false){
    die("ERROR: Could not connect to database. " . mysqli_connect_error());
}

// Set character set to utf8
mysqli_set_charset($conn, "utf8");
?>
