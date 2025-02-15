<?php
$server = 'localhost';
$username = 'root';
$password = 'khamiar@1908';
$database_name = 'souk_search_db';

$conn = mysqli_connect($server, $username, $password, $database_name);
if($conn->connect_errno){
    die('connection failed: ' .mysqli_connect_error());
} else{
    //echo 'connected successfuly';
}

?>