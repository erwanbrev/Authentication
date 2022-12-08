<?php
// Include config file
require_once "../controller/update-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <h2>Update Record</h2>
    <p>Please edit the input values and submit to update the user record.</p>
    <section class="form-container">
        <form class="form" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <label>Username</label>
            <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="username_err"><?php echo $username_err; ?></span>
            <label>Mail</label>
            <input name="mail" <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>"><?php echo $mail; ?>
            <span class="username_err"><?php echo $mail_err; ?></span>
            <label>Password</label>
            <input name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"><?php echo $password; ?>
            <span class="passwd_err"><?php echo $password_err; ?></span>
            <label>Role</label>
            <input type="text" name="role" <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
            <span class="username_err"><?php echo $role_err; ?></span>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button class="form-btn" type="submit" value="Submit">Submit</button>
            <button class="form-btn">
                <a href="../controller/admin-panel.php">Cancel</a>
            </button>
        </form>
    </section>
</body>

</html>