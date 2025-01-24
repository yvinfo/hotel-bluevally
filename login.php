<!DOCTYPE html>
<html lang="en">
<?php
session_start();

include "conn.php";
$err = "";


//------------------ Login ------------------  

if (isset($_POST["login_btn"])) {
    if ($_POST["email"] != "" && $_POST["psw"] != "") {
        $uname = $_POST["email"];
        $psw = $_POST["psw"];
        $sql = "select * from register where email='$uname' and psw='$psw'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_assoc($res);
          $uname = $row["uname"];
          $_SESSION["user"] = $uname;
          header("location:home.php");
      } else {
          $err = "User Doesn't Exist";
      }
    } else {
        $err = "Please Fill All Fields &nbsp;";
    }
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <title>hotel bluevally</title>
</head>
<body>
  <div class="main">
    
    <div class="img1">
      <img src="image/background.jpg" class="i1" alt="background pic">
    </div>
    <div class=head>
        <font class="ha1">&nbsp;HOTEL BLUEVALLY&nbsp;</font>      
      </div>
    <div class="reg reg2">
      
      <div class="f1">
        <font class="fo">&nbsp; LOGIN HERE... &nbsp;</font>
        <form action="" method="post">
          <input type="text" class="txt" placeholder="email" name="email" required><br>
          <input type="password" class="txt" placeholder="Password" name="psw" required><br><br>
          <span class="arr">
                    <?php
                    if ($err != "") {
                        echo "&nbsp;&nbsp;&nbsp;" .$err;
                    }
                    ?>
                </span>
                <br>
          <input type="submit" class="btn-submit btn-submit1" value="LOGIN" name="login_btn"><br>
        </form> <br> 
        <font class="acc">Don't Have Any Account..? <a href="register.php" class="link">&nbsp;SIGNUP&nbsp;</a></font><br> <br>
        <font class="acc acc1">Admin Login..  <a href="admin login.php" class=" link1">&nbsp;CLICK HEARE&nbsp;</a></font>   
      </div>
    </div>
  </div>
</body>
</html>