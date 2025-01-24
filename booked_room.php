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
        <div class="box">
                <br>
                <b style="font-family:sans-serif;">TOTAL ROOMS</b>
                <br><br><br>
                <table class="table">
                    <tr>
                        <th class="border">Bookno</th>
                        <th class="border">Rno</th>    
                        <th class="border">Name</th>
                        <th class="border">pno</th>
                        <th class="border">cin</th>
                        <th class="border">cout</th>
                        <th class="border">people</th>
                        <th class="border">price</th>
                        <th class="border">p status</th>
                        <th class="border">Action</th>
                    </tr>
                    <?php
                    $sql = "select * from book where pstatus='paid'";
                    $res = mysqli_query($conn, $sql);
                    while ($roww = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td class="border1 bo2"><?php echo $roww["no"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["rno"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["name"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["pno"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["cin"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["cout"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["peop"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["price"]; ?></td>
                            <td class="border1 bo2"><?php echo $roww["pstatus"]; ?></td>
                            <td class="border1 bo2">   
                                <a href="check_out.php?no=<?php echo $roww['no']; ?>" class="btne">check out</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        </div>


    </div> 
  </body>
</html>
