<?php
// Include config file
require_once "../model/config-login.php";
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
    <h2>Login</h2>

    <?php
    if (!empty($login_err)) {
        echo '<div class="passwd_err">' . $login_err . '</div>';
    }
    ?>
    <!-- creation of a section to contain the form -->
    <section class="form-container">
        <!--creation of the form -->
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Mail</label>
            <input type="text" name="mail" placeholder="pseudo35@gmail.com" maxlength="30" required <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mail; ?>">
            <span>
                <?php echo $mail_err; ?>
            </span>
            <label>Password ( Minimum of 8 characters)</label>
            <input type="password" name="password" placeholder="1A!5tv%(" minlength="8" required <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="username_err">
                <?php echo $password_err; ?>
            </span>
            <button type="submit" value="login">Send</button>
            <button type="reset" value="reset">Reset</button>
            <p>Don't have an account?
                <a href="../view/index.php">Sign up here</a>
            </p>
        </form>
    </section>

</body>

</html>