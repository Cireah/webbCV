<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect them to login page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webb CV</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<ul>
    <li><a href="index.php" class="active">Home</a></li>
    <li style="float: right"><a href="login.php">Login</a></li>
    <li style="float: right"><a href="register.php">Create Account</a></li>
    <li style="float: right"><a href="logout.php">Log out</a></li>
</ul>
    <br>
    <?php if($_SESSION["loggedin"] == true){ ?>
        hi
    <h1 class="my-5">hello <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
        hi
    <?php } else {?>
        :(
    <?php } ?>
</body>
</html>