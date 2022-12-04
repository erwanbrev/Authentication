<?php
// Include config file
require_once "./model/config-passw-reset.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <section class="form-container">
        <h2>Reset Password</h2>
        <p class="reset-pwd-p">Please fill out this form to reset your password.</p>
        <form id="reset-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Ur new password</label>
                <input type="password" name="new_password" <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span><?php echo $new_password_err; ?></span>
            </div>
            <div>
                <label>Can you confirm ur password</label>
                <input type="password" name="confirm_password" <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <button type="submit" value="Submit">Reset</button>
                <a href="home.php">Cancel</a>
            </div>
        </form>
    </section>
</body>

</html>