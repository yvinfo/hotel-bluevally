<?php
include "../conn.php";
session_start();

$err = "";

if (isset($_POST["add_room"])) {

    $rno = $_POST["rno"];
    $nbed = $_POST["nbed"];
    $fac = $_POST["fac"];
    $fac1= implode(",",$fac);
    $price = $_POST["price"];
    $rimg = $_POST["rimg"];

    $sql = "insert into room values('$rno','$nbed','$fac1','$price','$rimg')";
    $res = mysqli_query($conn, $sql);
    $err = "Room Added Succesfully";
}
?>
<?php
include "../conn.php";

$err1 = "";

if(isset($_POST["change_room"]))
{
    $rno = $_POST["rno"];
    $nbed = $_POST["nbed"];
    $fac = $_POST["fac"];
    $fac1= implode(",",$fac);
    $price = $_POST["price"];
    $rimg = $_POST["rimg"];

    $sql=$sql="update room set nbed='{$nbed}',fac='{$fac1}',price='{$price}',rimg='{$rimg}' where rno='{$rno}'";
    $res=mysqli_query($conn,$sql);
     $err = "room change succesfuly";

}
?>

<?php
    include "../conn.php";

    $err3 =" ";
    if(isset($_POST["delete_room"])){
        $rno = $_POST["rno"];

        $sql="delete from room where rno={$rno}";
        $res=mysqli_query($conn, $sql) or die("Query unsuceesful");
        $err3 = "room delete succesfully";
    }
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
                  <a href="admin homepage.php" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/home.png" alt="home" width="50px">
                        <p style="margin-top: 16px;margin-left:10px">
                            Dashboard
                        </p>
                    </div>
                </a>
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
                
                <b style="font-family: sans-serif;font-size:13px;">MANAGE SERVICES</b>
                <br>
                <br>
                <a href="all_room.php" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/menu.png" alt="home" width="40px">
                        <p style="margin-top: 16px;margin-left:10px">
                            ALL ROOM
                        </p>
                    </div>
                </a>
                <br>
                <div class="dropdown">
                    <button class="dropbtn">
                        <img src="../image/menu.png" alt="menu" width="45px">
                        <p style="margin-top: 15px;margin-left:5px">
                             PAYMENT STATUS
                        </p>
                    </button>
                    <div class="dropdown-content">
                        <a href="complete.php">complete</a>
                        <a href="refund.php">Refund</a>
                    </div>
                </div>
                <br>
                <a href="booked_room.php" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/menu.png" alt="home" width="40px">
                        <p style="margin-top: 16px;margin-left:10px">
                        BOOKED ROOM
                        </p>
                    </div>
                </a>
                </a>
                <br>
                <a href="feedback.php" style="text-decoration: none;color:black">
                    <div class="side_ad">
                        <img src="../image/menu.png" alt="home" width="40px">
                        <p style="margin-top: 16px;margin-left:10px">
                            FEEDBACKS
                        </p>
                    </div>
                </a>
        </div>

        <!--------- second div ----------->
        <div class="sidebar sidebar1">
            <div class="manage">
                <h2>room details</h2>

                <form class="room-form" action="" method="post">

                    <div class="room">
                    <label class="lab">room No</label>
                    <input type="number" class="in" name="rno" value="" >
                    </div>

                    <div class="room">
                    <label class="lab">No of bed</label>
                    <input type="number" class="in" name="nbed" value="" >
                    </div>
                
                    <div class="room room1">
                    <label class="lab lab1">facility</label><br>
                    <div class="cbox">
                        <input type="checkbox" name="fac[]" value="Ac-Room"  class=checkbox> &nbsp; <font>ac-room</font><br>
                        <input type="checkbox" name="fac[]" value="Room Service"  class=checkbox> &nbsp; <font>room service</font><br>
                        <input type="checkbox" name="fac[]" value="Free Wifi"  class=checkbox> &nbsp; <font>free wifi</font><br>
                        <input type="checkbox" name="fac[]" value="Free Parking"  class=checkbox> &nbsp; <font>free parking</font><br>
                        <input type="checkbox" name="fac[]" value="Free Gym"  class=checkbox> &nbsp; <font>free gym</font><br>
                        <input type="checkbox" name="fac[]" value="Laudary"  class=checkbox> &nbsp; <font>laudary</font><br>
                    </div>
                    </div>

                    <div class="room">
                    <label class="lab">price</label>
                    <input type="number" class="in" name="price" value="" >
                    </div>

                    <div class="room">
                    <label class="lab">room img</label>
                    <input type="file" class=" in1" name="rimg" value="" >
                    </div>

                    <button type="submit" class="submit" name="add_room">add room</button>
                    <button type="submit" class="submit" name="change_room">update room</button>
                    <button type="submit" class="submit" name="delete_room">delete room</button>
                    <br><br>
                    <span style="color:blue;font-weight:bold;font-family:sans-serif;font-size:15px;">
                    <?php
                    echo "&nbsp;&nbsp;&nbsp;" . $err;
                    echo "&nbsp;&nbsp;&nbsp;" . $err1;
                    echo "&nbsp;&nbsp;&nbsp;" . $err3;
                    ?>
                 </span>
                </form>

            </div>
        </div>
    
    </div>


</body>
</html>