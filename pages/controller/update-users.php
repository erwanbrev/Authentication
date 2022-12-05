<?php
// Include config file
require_once "../model/config.php";

// Define variables and initialize with empty values
$username = $mail = $password = $role = "";
$username_err = $mail_err = $password_err = $role_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

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
        // Prepare an update statement
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
                // Records updated successfully. Redirect to landing page
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
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $username = $row["username"];
                    $mail = $row["mail"];
                    $password = $row["password"];
                    $role = $row["role"];
                    $param_id = $id;
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $mysqli->close();
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
