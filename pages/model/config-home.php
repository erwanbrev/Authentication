<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
else {
    // 5 min = 5 x 60s = 300
    if (time() - $_SESSION["login_time_stamp"] > 60) {
        session_unset();
        session_destroy();
        $_SESSION["loggedin"] = false;
        // Redirect to login page
        header("location: login.php");
        exit;
    }
}
