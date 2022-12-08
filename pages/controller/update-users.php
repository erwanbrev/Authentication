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

    // Validation username.
    if (empty(trim($_POST["username"]))) {
        $username_err = "Veuillez saisir un username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Can only contain letters, numbers and underscores.";
    } else {
        // Prépare un SELECT.
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Paramètre des variables.
            $stmt->bind_param("s", $param_username);

            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                // Stock le résultat.
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already used.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Ferme la requête.
            $stmt->close();
        }
    }

    // Validation mail.
    if (empty(trim($_POST["mail"]))) {
        $mail_err = "Please enter an email.";
    } else {
        // Prépare un SELECT.
        $sql = "SELECT id FROM users WHERE mail = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Paramètre des variables.
            $stmt->bind_param("s", $param_mail);

            $param_mail = trim($_POST["mail"]);

            if ($stmt->execute()) {
                // Stock le résultat.
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $mail_err = "This mail is already used.";
                } else {
                    $mail = trim($_POST["mail"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Ferme la requête.
            $stmt->close();
        }
    }

    // Validation mot de passe.
    if (empty(trim($_POST["password"]))) {
        $password_err = "PLease enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "The password must contain at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate role
    $input_role = trim($_POST["role"]);
    if (empty($input_role)) {
        $role_err = "Please choose a role.";
    } else {
        $role = $input_role;
    }

    // Vérifie les erreurs des inputs avant de les insérer dans la base de donnée.
    if (empty($username_err) && empty($mail_err) && empty($password_err) && empty($role_err)) {

        // Prépare un INSERT.
        $sql = "UPDATE users SET username=?, mail=?, password=? role=? WHERE id=?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Paramètres des variables.
            $stmt->bind_param("ssssi", $param_username, $param_mail, $param_password, $param_role, $param_id);

            $param_username = $username;
            $param_mail = $mail;
            $param_password = password_hash($password, PASSWORD_BCRYPT);
            $param_role = $role;
            $param_id = $id;

            if ($stmt->execute()) {
                // Redirige vers la page login.
                header("location: ../controller/admin-panel.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Ferme la requête.
            $stmt->close();
        }
    }

    // Ferme la connexion.
    $mysqli->close();
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

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