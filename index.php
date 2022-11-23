<?php
// Include register file
require_once "./pages/register.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer authentication</title>
    <!-- link to connect the design's file to the rest of the code -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Authentication menu</h1>
    <h2>Sign up</h2>
    <!-- creation of a section to contain the form -->
    <section class="form-container">
        <!--creation of the form -->
        <!-- <form action="index.php" method="post"> -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Username</label>
            <input type="text" placeholder="Pseudo35" required <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
            <label>Mail</label>
            <input type="text" placeholder="pseudo35@gmail.com" maxlength="30" required>
            <label>Password ( Minimum of 8 characters)</label>
            <input type="password" name="password" placeholder="1A!5tv%(" minlength="8" pattern=".{8,}" required <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span><?php echo $password_err; ?></span>
            <label>Confirm your password</label>
            <input type="password" name="confirm_password" minlength="8" pattern=".{8,}" required <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span><?php echo $confirm_password_err; ?></span>
            <button type="submit">Send</button>
            <button type="reset">Reset</button>
            <p>Already have an account?
                <a href="./pages/login.php">Login here</a>
            </p>
        </form>
    </section>

</body>

</html>