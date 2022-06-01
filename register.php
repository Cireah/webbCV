<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("location: index.php");
    exit;
}
require_once "connect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo("Oops! Something went wrong. Please try again later.");
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "The password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "The password did not match.";
        }
    }

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){
                    $sql = "SELECT id, username, password FROM users WHERE username = ?";
                    
                    if($stmt = mysqli_prepare($link, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        
                        $param_username = $username;
                        
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                            
                            if(mysqli_stmt_num_rows($stmt) == 1){
                                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                                if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($password, $hashed_password)){
                                        session_start();
                                        
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;
                                        
                                        header("location: index.php");
                                    } else{
                                        $login_err = "Invalid username or password.";
                                    }
                                }
                            } else{
                                $login_err = "Invalid username or password.";
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        mysqli_stmt_close($stmt);
                    }
                header("location: index.php");
            } else{
                echo("Something went wrong. Please try again later.");
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="registersquare"></div> 
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutme.php">About me</a></li>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ ?>
            <li style="float: right"><a href="logout.php">Log out</a></li>
            <li style="float: right"><a href="account.php">Account</a></li>
        <?php } else {?>
            <li style="float: right"><a href="login.php">Login</a></li>
            <li class="active" style="float: right"><a href="register.php">Create Account</a></li>
        <?php } ?>
    </ul>
    <div class="register">
        <h2>Sign Up</h2>
        <p>Please fill in this form to create an account.</p>
        <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="post">
            <div class="form-group">
                <input type="text" name="username" class="rgusername" placeholder="Username" class="form-control <?php echo((!empty($username_err)) ? 'is-invalid' : ''); ?>" value="<?php echo($username); ?>"><br>
                <br><span class="invalid-feedback"><?php echo($username_err); ?></span><br>
            </div>    
            <div class="form-group">
                <input type="password" name="password" class="rgpassword" placeholder="Password" class="form-control" <?php echo((!empty($password_err)) ? 'is-invalid' : ''); ?>" value="<?php echo($password); ?>"><br>
                <br><span class="invalid-feedback"><?php echo($password_err); ?></span><br>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="confirmpass" placeholder="Confirm Password" class="form-control" <?php echo((!empty($confirm_password_err)) ? 'is-invalid' : ''); ?>" value="<?php echo($confirm_password); ?>"><br>
                <br><span class="invalid-feedback" class="errormsg"><?php echo($confirm_password_err); ?></span><br>
            </div>
            <div class="form-group">
                <input type="submit" class="registerbtn" value="Create account">
            </div>
            <p class="loginredirect">Already have an account? <a href="login.php">Login here</a>.</p>
        </form>   
    </div>
</body>
</html>