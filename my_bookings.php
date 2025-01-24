<?php
include "conn.php";

include "header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>hotalbluevally</title>
  <link rel="stylesheet" href="css/feedback.css">
  <link rel="stylesheet" href="css/my_bookings.css">
</head>
<body>
<div class="feedimg">
        <img src="image/lobby.jpeg" alt="" class="my_img">
    </div>

        <div class="disc_sit">
            <center>
                <p class="wlc_msg">My Booking</p>
            </center>
            <br>
        </div>

        <div class="rooms">
                <?php
                    $uname = $_SESSION["user"];
                    $sql="select * from book where name='$uname'";
                    $res = mysqli_query($conn,$sql);

                    if(mysqli_num_rows($res)>0){
                      while($row = mysqli_fetch_row($res)){ 
                        $sql1 = "select * from room where rno='$row[1]'";
                        $res1 = mysqli_query($conn,$sql1);
                        $rows = mysqli_fetch_row($res1);
                   
                   echo "<br><br><br>
                   <div class='my_room'>
                        <div class='imgs'>
                          <img src='image/$rows[4]' class='imgp'>
                        </div>
                        <div class='room'>
                          <h3 class='w1'>Booking Number: $row[0]</h3>
                          <h3 class='w1'>Your Name: $row[2]</h3>
                          <h3 class='w1'>room no: $row[1]</h3>
                          <h3 class='w1 w2'>check in: $row[4]</h3>
                          <h3 class='w1 w2'>check out: $row[5]</h3>
                          <h3 class='w1'>people	: $row[6]</h3>
                          <h3 class='w1'>price	: $row[7]</h3>
                          <h3 class='w1'>Payment Status	: $row[8]</h3>
                        </div>";
                  
                        if ($row[8] == 'paid') {
                          echo "<a href='cancel_booking.php?bno=$row[0]&rno=$row[1]&name=$row[2]&peop=$row[6]&price=$row[7]'>
                          <button class='book_btn'>CANCEL BOOKING</button></a>";
                        }
                        else{
                         echo  "<a href='payment.php?no=$row[0]&rno=$row[1]&name=$row[2]&price=$row[7]'>
                          <button class='book_btn'>PAY NOW</button></a>";
                        }
                        
                     "</div>";        
                  }
                }
                  else {
                    echo "<p style='text-align: center; color: #555;'>No bookings found.</p>";
                  }
            ?>
            </div> 
           <br>
           <br>
           <Br> 
</body>
</html>