<?php
// Include config file
require_once "../model/config.php";

// Define variables and initialize with empty values
$username = $mail = $password = $role = "";
$username_err = $mail_err = $password_err = $role_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validation username.
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Can only contain letters, numbers and underscores.";
    } else {
        // new select to find id in user's table
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // variable parameters
            $stmt->bind_param("s", $param_username);

            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                // store the result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already used.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the request
            $stmt->close();
        }
    }

    // Mail's validation.
    if (empty(trim($_POST["mail"]))) {
        $mail_err = "Please enter an email.";
    } else {
        $sql = "SELECT id FROM users WHERE mail = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_mail);
            $param_mail = trim($_POST["mail"]);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $mail_err = "This mail is already used.";
                } else {
                    $mail = trim($_POST["mail"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Password's validation
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "The password must contain at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Role's validation
    if (empty(trim($_POST["role"]))) {
        $role_err = "Please enter a role.";
    } else {
        $role = trim($_POST["role"]);
    }

    // Checks inputs for errors before inserting them into the database.
    if (empty($username_err) && empty($mail_err) && empty($password_err) && empty($role_err)) {

        $sql = "INSERT INTO users (username, mail, password, role) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ssss", $param_username, $param_mail, $param_password, $param_role);

            $param_username = $username;
            $param_mail = $mail;
            $param_password = password_hash($password, PASSWORD_BCRYPT);
            $param_role = $role;

            if ($stmt->execute()) {
                // Redirect to admin panel
                header("location: ../controller/admin-panel.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}
