<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('db_server', 'localhost:8111');
define('db_username', 'root');
define('db_password', '');
define('db_name', 'accounts');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(db_server, db_username, db_password, db_name);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>