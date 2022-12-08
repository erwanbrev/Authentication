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
        $sql = "INSERT INTO users (username, mail, password, role) VALUES (?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Paramètres des variables.
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

            // Ferme la requête.
            $stmt->close();
        }
    }

    // Ferme la connexion.
    $mysqli->close();
}
?>