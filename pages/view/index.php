<?php
// Include register file
// require_once "./pages/model/config.php";
require_once "../model/config-register.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer authentication</title>
    <!-- link to connect the design's file to the rest of the code -->
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <h1>Authentication menu</h1>
    <h2>Sign up</h2>
    <!-- creation of a section to contain the form -->
    <section class="form-container">
        <!--creation of the form -->
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- enter your username -->
            <label>Username</label>
            <input type="text" name="username" placeholder="Pseudo35" required <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="username_err"><?php echo $username_err; ?></span>
            <!-- enter your email -->
            <label>Mail</label>
            <input type="text" name="mail" placeholder="pseudo35@gmail.com" maxlength="30" required <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mail; ?>">
            <span><?php echo $mail_err; ?></span>
            <!-- enter your password -->
            <label>Password ( Minimum of 8 characters)</label>
            <input type="password" name="password" placeholder="1A!5tv%(" minlength="8" required <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="username_err"><?php echo $password_err; ?></span>
            <!-- how to confirm your password -->
            <label>Confirm your password</label>
            <input type="password" name="confirm_password" minlength="8" required <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="username_err"><?php echo $confirm_password_err; ?></span>
                <button class="form-btn" type="submit">Send</button>
                <button class="form-btn" type="reset">Reset</button>
                <!-- page's redirection -->
                <p>Already have an account?
                    <a href="../view/login.php">Login here</a>
                </p>
        </form>
    </section>

</body>

</html>