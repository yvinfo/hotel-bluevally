<?php
include "../conn.php";
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>online food delivery</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

  <!--------- HEADER -------------->
  <div class="nav">
    <img src="../image/logo.png" alt="logo" class="img"><font class="A">ADMIN</font>
    <h2 class="f1">HOTEL BLUEVALLY</h2>
      <form action="../login.php">
        <input type="submit" value="LOGOUT" class="btn">
      </form>
  </div>

  <!----------- SIDEBAR ------------>

    <div class="main_div">
        <div class="sidebar">
                  <a href="#" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/home.png" alt="home" width="50px">
                        <p style="margin-top: 16px;margin-left:10px">
                            Dashboard
                        </p>
                    </div>
                </a>
                <br>
                <br>
                <b style="font-family: sans-serif;font-size:13px;">MANAGE ITEM</b>
                <br>
                <br>
                <a href="user_report.php" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/users.png" alt="home" width="40px">
                        <p style="margin-top: 16px;margin-left:15px">
                             USER REPORT
                        </p>
                    </div>
                </a>
                <br>
                <a href="manage_room.php" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/menu.png" alt="home" width="35px">
                        &nbsp;&nbsp;&nbsp;
                        <p style="margin-top: 16px;margin-left:10px">
                            MANAGE ROOM
                        </p>
                    </div>
                </a>
                <br>
                <br>
                <b style="font-family: sans-serif;font-size:13px;">MANAGE SERVICES</b>
                <br>
                <br>
                <a href="#" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/menu.png" alt="home" width="40px">
                        <p style="margin-top: 16px;margin-left:10px">
                            ADD ITEM
                        </p>
                    </div>
                </a>
                <br>
                <a href="#" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/menu.png" alt="home" width="40px">
                        <p style="margin-top: 16px;margin-left:10px">
                            CHANGE ITEM
                        </p>
                    </div>
                </a>
        </div>

        <!--------- second div ----------->
        <div class="sidebar sidebar1">
          <div class="main-content">
                <h2>Update Record</h2>
                <?php
                $id=$_GET['id'];
                $sql="select * from register where id={$id}";
                $res=mysqli_query($conn,$sql) or die("query unsuccesful");

                  if(mysqli_num_rows($res)>0){
                    while ($roww = mysqli_fetch_assoc($res)) {
      
                ?>
                <form class="form" action="update.php" method="post">

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="hidden" name="id"  value="<?php echo $roww['id']; ?>" >
                        <input type="text" name="uname" value="<?php echo $roww['uname']; ?>" >
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $roww['email']; ?>" >
                   </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="pno" value="<?php echo $roww['pno']; ?>" >
                    </div>
        
                   <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="psw" value="<?php echo $roww['psw']; ?>" >
                    </div>
                 <input class="submit" type="submit" value="Update">
                 <a href="user_report.php" input class="submit reset" type="reset">cancel</a>
                </form>

                <?php
               }
             }
            ?>
            
          </div>
        </div>
    </div>
</body>
</html>
