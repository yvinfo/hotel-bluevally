<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include "conn.php";
$err1 = "";

//------------------ Register ------------------  

if (isset($_POST["signup_btn"])) {
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $pno = $_POST["pno"];
    $psw = $_POST["psw"];
    $cpsw = $_POST["cpsw"];

    if ($psw == $cpsw) {
        $sql = "select * from register where email='$email' or pno='$pno'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) == 0) {
            $sql = "insert into register values('','$uname','$email','$pno','$psw')";
            mysqli_query($conn, $sql);
            $_SESSION["user"] = $uname;
            header("location:login.php");
        } else {
            $err1 = "Email or Mobile No. Already Exist";
        }
    } else {
        $err1 = "Password Doesn't Match";
    }
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>Document</title>
</head>
<body>
  <div class="main">
    <div class="img1">
      <img src="image/background.jpg" class="i1" alt="background pic">
    </div>
    <div class="head head1">
        <font class="ha1">&nbsp;HOTEL BLUEVALLY&nbsp;</font>      
      </div>
    <div class="reg">
      <div class="f1">
        <font class="fo">&nbsp; SIGNUP HERE... &nbsp;</font>
        <form action="" method="post">
          <input type="text" class="txt" placeholder=" Username" name="uname" required><br>
          <input type="text" class="txt" placeholder="Email Id" name="email" required><br>
          <input type="text" class="txt" placeholder="Mobile No" name="pno" required><br>
          <input type="password" class="txt" placeholder="Password" name="psw" required><br>
          <input type="password" class="txt" placeholder="Confirm Password" name="cpsw"required><br>
          <span style="color:red;font-weight:bolder;font-family:sans-serif;font-size:12px;">
                    <?php
                    echo "&nbsp;&nbsp;&nbsp;" . $err1;
                    ?>
          </span>
          <br>
          <input type="submit" class=btn-submit value="SIGNUP" name="signup_btn"><br>
        </form> <br>
        <font class="acc">Don't Have Any Account..? <a href="login.php" class="link">&nbsp;LOGIN&nbsp;</a></font>     
      </div>
    </div>
 </div>
</body>
</html>