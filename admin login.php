<!DOCTYPE html>
<html lang="en">
<?php
$err2="";

    if(isset($_POST["login_btn"])){
        $uname  = $_POST["uname"];
        $psw = $_POST["psw"];
        if($uname=="admin" && $psw=="admin"){
            $_SESSION["user"] = $uname;
            header("location:admin/admin homepage.php");
        }
        else{
            $err2="admin login password incorrect";
        }
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
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
        <font class="fo">&nbsp; ADMIN HERE... &nbsp;</font>
        <form action="" method="post">
          <input type="text" class="txt" placeholder="username" name="uname" required><br>
          <input type="password" class="txt" placeholder="Password" name="psw"required><br><br>
          <span class="arr">
                    <?php
                    if ($err2 != "") {
                        echo "&nbsp;&nbsp;&nbsp;" .$err2;
                    }
                    ?>
                </span>
                <br>
            <input type="submit" class="btn-submit btn-submit1" value="LOGIN" name="login_btn"><br>
        </form> <br> 
        <font class="acc acc1">Login Page.. <a href="login.php" class="link1">&nbsp;CLICK HEARE&nbsp;</a></font>   
      </div>
    </div>
  </div>
</body>
</html>