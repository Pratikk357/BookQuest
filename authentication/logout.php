<?php
// Start session
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page after logout
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit; // Ensure script stops execution after redirect
}
?>
