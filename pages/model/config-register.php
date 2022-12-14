<?php
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$username = $mail = $password = $confirm_password = "";
$username_err = $mail_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate mail
    if (empty(trim($_POST["mail"]))) {
        $mail_err = "Please enter a valid mail";
    } elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $mail_err = "Invalid email format";
    } else {
        //add old else below to test the code
        $mail = trim($_POST["mail"]);
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE mail = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_mail);

            // Set parameters
            $param_mail = trim($_POST["mail"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $mail_err = "This mail is already taken.";
                } else {
                    $mail = trim($_POST["mail"]);
                }
            }
            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters with many specials characters";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password didn't match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($mail_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, mail, password) VALUES (?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_username, $param_mail, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_mail = $mail;
            $param_password = password_hash($password, PASSWORD_BCRYPT); // Creates a password hash
            var_dump($stmt);
            var_dump($param_username);
            var_dump($param_mail);
            var_dump($param_password);
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                var_dump("OK");
                // Redirect to login page
                header("location: ../view/login.php");
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
