<?php
require_once "../controller/update-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update any profile</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <h1>Update an user</h1>
    <section class="form-container">
        <form class="form" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <label>Username</label>
            <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span>
                <?php echo $username_err; ?>
            </span>
            <label>Mail</label>
            <input type="email" name="mail" <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mail; ?>">
            <span>
                <?php echo $mail_err; ?>
            </span>
            <label>Role</label>
            <input type="text" name="role" <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
            <span>
                <?php echo $role_err; ?>
            </span>
            <button class="form-btn" type="submit" value="Submit">Submit</button>
            <button class="form-btn">
                <a href="../controller/admin-panel.php">Cancel</a>
            </button>
        </form>
    </section>
</body>

</html>