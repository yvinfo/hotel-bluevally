<?php
include "../conn.php";

$no= $_GET['no'];
$sql1="delete from book where no={$no}";
$res1=mysqli_query($conn, $sql1) or die("Query unsuceesful");

header("location:booked_room.php");

mysqli_close($conn)
?>