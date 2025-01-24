<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'hotel';

    $conn = mysqli_connect($server,$username,$password,$db);

    if(!$conn){
        die("Server Doesn't Connect");
    }
?>