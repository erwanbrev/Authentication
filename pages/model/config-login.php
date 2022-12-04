<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../home.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$mail = $password = "";
$mail_err = $password_err = $login_err = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if mail is empty
    if (empty(trim($_POST["mail"]))) {
        $mail_err = "Please enter mail.";
    } else {
        $mail = trim($_POST["mail"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($mail_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, mail, password FROM users WHERE mail = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_mail);

            // Set parameters
            $param_mail = $mail;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if mail exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $mail, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["mail"] = $mail;
                            $_SESSION["login_time_stamp"] = time();

                            // Redirect user to welcome page
                            header("location: ../home.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid mail or password.";
                        }
                    }
                } else {
                    // mail doesn't exist, display a generic error message
                    $login_err = "Invalid mail or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>