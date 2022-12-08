<?php
// Include config file
require_once "../controller/create-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <h2>Create Record</h2>
    <p>Please fill this form and submit to add user record to the database.</p>
    <section class="form-container">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div>
                <label>Mail</label>
                <input name="mail" class="form-control <?php echo (!empty($mail_err)) ? 'is-invalid' : ''; ?>"><?php echo $mail; ?></input>
                <span class="invalid-feedback"><?php echo $mail_err; ?></span>
            </div>
            <div>
                <label>Password</label>
                <input name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"><?php echo $password; ?></input>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div>
                <label>Role</label>
                <input type="text" name="role" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
                <span class="invalid-feedback"><?php echo $role_err; ?></span>
            </div>
            <button class="form-btn" type="submit" value="Submit">Submit</button>
            <button class="form-btn" value="Cancel">
                <a href="../controller/admin-panel.php">Cancel</a>
            </button>
        </form>
    </section>
</body>

</html>