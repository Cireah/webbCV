<?php
define('db_server', 'localhost:8111');
define('db_username', 'root');
define('db_password', '');
define('db_name', 'accounts');
 
$link = mysqli_connect(db_server, db_username, db_password, db_name);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>