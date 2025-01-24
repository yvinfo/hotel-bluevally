<?php
include "conn.php";
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/header.css">
  <title></title>
</head>
<body>
    <div class="fdiv">
          <div>
              <img src="image/call.png" alt="call_logo" class="call_logo">
              Call : 9313481915 | 8980017225
          </div>
          <div class="fdiv1">
              <img src="image/mail.png" alt="mail_logo" class="mail_logo">
              Email : hotalbluevally@gmail.com
         </div>
      </div>

      <div class="sdiv">
        <div class="heading">
            <a href="home.php" style="color: midnightblue;text-decoration: none;"> HOTEL BLUEVALLY </a>
        </div>
        <div class="navigation">
                <a href="home.php" class="nav">Home</a>
              
                <a href="room.php" class="nav">Room</a>
           
            <a href="facilities.php" class="nav">facilities</a>
            

            <a href="contactus.php" class="nav">Contact Us</a>

            <a href="feedback.php" class="nav">Feedback</a>

            <select  class="header_myprofile" onchange="location.href=this.value">
                    <option class="hd_opt">
                        &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['user'];?>
                    </option>
                    <option value="my_bookings.php" class="hd_opt">my booking</option>
            </select>
                <a href="logout.php" class="nav">Logout</a>
                
        </div>
    </div>


</body>
</html>