<?php
include "conn.php";

include "header.php";

$err = "";

if (isset($_POST["feed_btn"])) {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $rev = $_POST["rev"];

    $sql = "insert into feedback values('','$name','$phone','$date','$rev')";
    $res = mysqli_query($conn, $sql);
    $err = "feedback Succesfully";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>hotal Bluevally</title>
  <link rel="stylesheet" href="css/feedback.css">
</head>
<body>

    <div class="feedimg">
        <img src="image/lobby.jpeg" alt="" class="feed_img">
    </div>

    <div class="disc_sit">
        <center>
            <p class="wlc_msg">Give us Feedback</p>
        </center>
        <br>
    </div>

    <div class="feed_form">

      <form class="form" action="" method="post">

        <div class="form-group">
            <label for="">Your Name</label>
            <input type="text" name="name" value="" >
        </div>
        
        <div class="form-group">
          <label>Phone</label>
          <input type="no" name="phone" value="" >
        </div>
        
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" value="" >
        </div>

        <div class="form-group">
            <label>Your Review</label>
            <input type="text"  name="rev" value="" >
        </div>
        <input class="submit" type="submit" value="Submit" name="feed_btn"><br><br>
        <span style="color:blue;font-weight:bold;font-family:sans-serif;font-size:15px;margin-left:35%;">
            <?php
              echo "&nbsp;&nbsp;&nbsp;" . $err;
            ?>
         </span>
      </form>

    </div>

</body>
</html>