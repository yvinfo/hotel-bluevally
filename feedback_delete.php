<?php
include "../conn.php";

$no= $_GET['no'];
$sql1="delete from feedback where no={$no}";
$res1=mysqli_query($conn, $sql1) or die("Query unsuceesful");

header("location:feedback.php");

mysqli_close($conn)
?>