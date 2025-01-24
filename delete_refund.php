<?php
include "../conn.php";

$id= $_GET['id'];
$sql="delete from payment where id={$id}";
$res=mysqli_query($conn, $sql) or die("Query unsuceesful");

header("location:refund.php");

mysqli_close($conn)
?>
