<?php
// Include config file
require_once "../model/config.php";

// Define variables and initialize with empty values
$username = $mail = $password = $role = "";
$username_err = $mail_err = $password_err = $role_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    $input_username = trim($_POST["username"]);
    if (empty($input_username)) {
        $username_err = "Please enter a username.";
    } elseif (!filter_var($input_username, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $username_err = "Please enter a valid username.";
    } else {
        $username = $input_username;
    }

    // Validate mail 
    $input_mail = trim($_POST["mail"]);
    if (empty($input_mail)) {
        $mail_err = "Please enter an mail.";
    } else {
        $mail = $input_mail;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Please enter an password.";
    } else {
        $password = $input_password;
    }

    // Validate role
    $input_role = trim($_POST["role"]);
    if (empty($input_role)) {
        $role_err = "Please enter the role.";
    } else {
        $role = $input_role;
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($mail_err) && empty($password_err) && empty($role_err)) {
        // Prepare an insert statement
        $sql = "UPDATE users SET username=?, mail=?, password=?, role=? WHERE id=?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssi", $param_username, $param_mail, $param_pwd, $param_role, $param_id);

            // Set parameters
            $param_username = $username;
            $param_mail = $mail;
            $param_pwd = $password;
            $param_role = $role;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: ../controller/admin-panel.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>
