<?php
// Include config file
require_once "../controller/delete-users.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="../model/style.css">
</head>

<body>
    <section class="form-container">
        <h2>Delete Record</h2>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
            <p>Are you sure you want to delete this user record?</p>
            <button type="submit" value="Yes">Submit</button>
            <button>
                <a href="../controller/admin-panel.php">No</a>
            </button>
        </form>
    </section>
</body>

</html>