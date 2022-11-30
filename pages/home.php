<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client's home page</title>
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <h1>Client's home page</h1>
    <h2>Hello&nbsp;<b>
            <?php
            echo htmlspecialchars($_SESSION["username"]); ?>
        </b>! Welcome to our site.</h2>
    <!-- article available-->
    <article class="img-container">
        <p>Now you can see the cutest meme of all time.</p>
        <img src="../img/funny-meme-about-people-asking-who-is-a-good-boy-instead-of-how-is-a-good-boy.webp" alt="meme of a dog who's sad because people don't ask him how it is">
    </article>
    <p>
        <a href="passw-reset.php">Reset your password</a>
        <a href="logout.php">Sign Out</a>
    </p>
</body>

</html>