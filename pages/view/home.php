<?php
// Include config file
require_once "../model/config-home.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client's home page</title>
    <link rel="stylesheet" href="../model/style.css">

</head>

<body>
    <h1>Client's home page</h1>
    <h2>Hello&nbsp;<b>
            <?php
            echo htmlspecialchars($_SESSION["username"]); ?>
        </b>! Welcome to our site.</h2>
    <section class="main-container">
        <section class="left-main-container">
            <a href="passw-reset.php">Reset your password</a>
            <a href="../model/logout.php">Log Out</a>
        </section>
        <!-- article available-->
        <article class="img-container">
            <p>Now you can see the cutest meme of all time.</p>
            <img src="../../img/funny-meme-about-people-asking-who-is-a-good-boy-instead-of-how-is-a-good-boy.webp" alt="meme of a dog who's sad because people don't ask him how it is">
        </article>
    </section>
</body>

</html>