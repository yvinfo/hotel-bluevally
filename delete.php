<?php
include "../conn.php";

$id= $_GET['id'];
$sql="delete from register where id={$id}";
$res=mysqli_query($conn, $sql) or die("Query unsuceesful");

header("location:user_report.php");

mysqli_close($conn)
?>


