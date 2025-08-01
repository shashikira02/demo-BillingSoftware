<?php
$servername = getenv('DB_SERVER');
$username   = getenv('DB_USERNAME');
$password   = getenv('DB_PASSWORD');
$database   = getenv('DB_DATABASE');

if (!$servername || !$username || !$database) {
    error_log("Missing one or more database environment variables.");
    die("Database configuration not properly set.");
}

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Connection failed. Please try again later.");
} else {
    echo "Connection successful!";
}

?>