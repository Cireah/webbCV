<?php
session_start();
$conn = mysqli_connect("localhost:8111", "root", "", "accounts");
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){ ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="accountsquare1"></div>
        <div class="accountsquare2"></div>  
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutme.php">About me</a></li>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ ?>
        <li style="float: right"><a href="logout.php">Log out</a></li>
        <li class="active" style="float: right"><a href="account.php">Account</a></li>
        <?php } else {?>
        <li style="float: right"><a href="login.php">Login</a></li>
        <li style="float: right"><a href="register.php">Create Account</a></li>
        <?php } ?>
    </ul>
    <div class="accountinfo">
        Username: <b><?php echo htmlspecialchars($_SESSION["username"]);?></b><br>
        Creation date: <?php $username = $_SESSION["username"]; /*i give up on trying to input date ill do it if i have time left*/
exit;}

else{
    header("location: index.php");
}
?>