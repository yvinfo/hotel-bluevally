<?php
include "conn.php";

include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>hotal bluevally</title>
  
  <link rel="stylesheet" href="css/feedback.css">
  <link rel="stylesheet" href="css/room.css">
</head>
<body>
    <div class="feedimg">
            <img src="image/lobby.jpeg" alt="" class="room_img">
        </div>

        <div class="disc_sit">
            <center>
                <p class="wlc_msg">Our Rooms</p>
            </center>
            <br>
    
  
    <div class="rooms">
                    
                    <?php
                         
                        $sql = "select * from room";
                        $res = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0){
                            while($row = mysqli_fetch_row($res)){
                              
                                echo "<br><br><br>
                                  <div class='room'> 
                                      <h2 class='w1'>room no: $row[0]</h2><br>
                                      <h2 class='w1'>No Of Bed: $row[1]</h2><br>
                                      <h2 class='w1 w2'>Facility : $row[2]</h2><br>
                                      <h2 class='w1'>price	: $row[3]</h2>
                                      <h2 class='imgs'><img src='image/$row[4]' class='imgp'><h2>
                                      <a href='book_now.php ?rno=$row[0] & r_p=$row[3]'><button class='book_btn' type='submit' value='submit'>BOOK NOW </a>
                                  </div>
                              
                                ";
                              
                            }
                        }
                    ?>
    </div>
</body>
</html>