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
  <link rel="stylesheet" href="../css/admin1.css">
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
                        <img src="../image/menu.png" alt="home" width="40px">
                        &nbsp;&nbsp;&nbsp;
                        <p style="margin-top: 16px;">
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
            <h3>Dashboard</h3>
            <div class="db">
                 <a href="user_report.php" style="text-decoration: none;color:black">
                        <div class="box1">
                            <p class="w1">Total Users</p>
                            <p class="count">
                            <?php
                            $sql = "select * from register";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </p>
                        </div>
                    </a>
                    
                    <a href="all_room.php" style="text-decoration: none;color:black">
                        <div class="box1">
                            <p class="w1">Total Rooms</p>
                            <p class="count">
                            <?php
                            $sql = "select * from room";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </p>
                        </div>
                    </a>

                    <a href="feedback.php" style="text-decoration: none;color:black">
                        <div class="box1">
                            <p class="w1">Total Feedbacks</p>
                            <p class="count">
                            <?php
                            $sql = "select * from feedback";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </p>
                        </div>
                    </a>

                    <a href="booked_room.php" style="text-decoration: none;color:black">
                        <div class="box1">
                            <p class="w1">Total BookeRooms</p>
                            <p class="count">
                            <?php
                            $sql = "select * from book";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            echo $count;
                            ?>
                        </p>
                        </div>
                    </a>

                    <a href="complete.php" style="text-decoration: none;color:black">
                        <div class="box1">
                            <p class="w1">Total Amount</p>
                            <p class="count">
                            <?php
                            $totalAmount = 0;
                            $sql = "select * from payment";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {
                                $totalAmount += $row['amount']; 
                            }
                            echo $totalAmount;
                            ?>
                        </p>
                        </div>
                    </a>

                    <a href="refund.php" style="text-decoration: none;color:black">
                        <div class="box1">
                            <p class="w1">Total Refund Amount</p>
                            <p class="count">
                            <?php
                            $totalRefundAmount = 0;
                            $sql = "select amount from payment where method='refund'";
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) {
                                $totalRefundAmount += $row['amount']; 
                            }
                            echo $totalRefundAmount;
                            ?>
                        </p>
                        </div>
                    </a>

                   
                    </div>
            </div>
    
    </div>


</body>
</html>