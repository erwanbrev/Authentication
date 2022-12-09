<?php
// Include config file
require_once "../controller/create-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create profile</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <h2>Create Record</h2>
    <p class="reset-pwd-p">Please fill this form and submit to add user record to the database.</p>
    <section class="form-container">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Username</label>
            <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>value="<?php echo $username; ?>">
            <span>
                <?php echo $username_err; ?>
            </span>
            <label>Mail</label>
            <input type="email" name="mail" <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>value="<?php echo $mail; ?>">
            <span>
                <?php echo $mail_err; ?>
            </span>
            <label>Password</label>
            <input name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>value="<?php echo $password; ?>">
            <span>
                <?php echo $password_err; ?>
            </span>
            <label>Role</label>
            <select name="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <button class="form-btn" type="submit" value="Submit">Submit</button>
            <button class="form-btn" value="Cancel">
                <a href="../controller/admin-panel.php">Cancel</a>
            </button>
        </form>
    </section>
</body>

</html>