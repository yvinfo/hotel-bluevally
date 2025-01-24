<?php
  $id=$_POST['id'];
  $uname=$_POST['uname'];
  $email=$_POST['email'];
  $pno=$_POST['pno'];
  $psw=$_POST['psw'];

  include "../conn.php"; 

  $sql="update register set uname='{$uname}',email='{$email}',pno='{$pno}',psw='{$psw}' where id='{$id}'";
  $res=mysqli_query($conn, $sql) or die("query unsuccesful");

  header("location:user_report.php");

mysqli_close($conn)

?>