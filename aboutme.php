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
    <div class="aboutsquare1"></div>
    <div class="aboutsquare2"></div> 
<a name="top"></a>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#top" class="active">About me</a></li>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ ?>
            <li style="float: right"><a href="logout.php">Log out</a></li>
            <li style="float: right"><a href="account.php">Account</a></li>
        <?php } else {?>
            <li style="float: right"><a href="login.php">Log in</a></li>
            <li style="float: right"><a href="register.php">Create Account</a></li>
        <?php } ?>
    </ul>
    hi i do stuff <!-- input links to github projects--><br>
    <!-- slideshow or normal scroll?????????? -->
    <a class="projectlink" href="https://github.com/simpan824/albumsDbProject" target="_blank">database thingy</a>
</body>
</html>