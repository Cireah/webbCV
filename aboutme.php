<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About me</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class="active" href="aboutme.php">About me</a></li>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ ?>
            <li style="float: right"><a href="logout.php">Log out</a></li>
            <li style="float: right"><a href="account.php">Account</a></li>
        <?php } else {?>
            <li style="float: right"><a href="login.php">Login</a></li>
            <li style="float: right"><a href="register.php">Create Account</a></li>
        <?php } ?>
    </ul>
</body>
</html>