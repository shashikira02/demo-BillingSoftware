<?php
// Update the database connection details here
$servername = "localhost";
$username = "root";
$password = "";
$database = "billsoftware";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Log the error or display a generic error message
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
}

// Start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>