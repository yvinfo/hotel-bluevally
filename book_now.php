<?php
include "conn.php";

include "header.php";


if (isset($_GET['rno'])) {
  $rno = $_GET['rno'];
}
if (isset($_SESSION['user'])) {
  $uname = $_SESSION['user'];
}

$pno="";
$cin="";
$cout="";
$peop="";
$price="";
$err='';
$err1='';
$err2='';
$err3='';

if (isset($_POST["book_room"])) {
    $rno = $_POST["rno"];
    $name = $_POST["name"];
    $pno = $_POST["pno"];
    $cin = $_POST["cin"];
    $cout = $_POST["cout"];
    $peop = $_POST["peop"];
    $price = $_POST["price"];

    // Check for overlapping bookings
    $sql = "SELECT COUNT(*) as count FROM book 
            WHERE rno = '$rno' 
            AND (
                ('$cin' BETWEEN cin AND cout) OR
                ('$cout' BETWEEN cin AND cout) OR
                (cin BETWEEN '$cin' AND '$cout')
            )";
    $res = mysqli_query($conn, $sql);
    $tmp = mysqli_fetch_assoc($res);

    $sdate = strtotime($_POST['cin']);
    $edate = strtotime($_POST['cout']);

    if ($edate > $sdate) {
        if ($tmp['count'] > 0) {
            $err = "This room is already booked for the selected date range.";
        } else {
            // Insert booking if no overlap
            $sql = "INSERT INTO book VALUES('', '$rno', '$name', '$pno', '$cin', '$cout', '$peop', '$price','unpaid')";
            $res = mysqli_query($conn, $sql);
            $no = mysqli_insert_id($conn);
            header("Location: payment.php?no=$no&rno=$rno&name=$name&pno=$pno&cin=$cin&cout=$cout&peop=$peop&price=$price");
            exit();
        }
    } else {
        $err2 = "Check-out date can't be earlier than check-in date.";
    }
}

  

  if (isset($_POST['check_price'])) {
    $cin = $_POST['cin'];
    $cout = $_POST['cout'];
    $peop = $_POST['peop'];
    $pno = $_POST["pno"];
    $r_p = $_GET['r_p'];

    // Limit: Prevent booking if more than 5 people
    if ($peop > 5) {
        $err3 ="Sorry, bookings for more than 5 people are not allowed.";
         // Stop further processing
    }

    $sdate = strtotime($cin);
    $edate = strtotime($cout);

    $obj = $edate - $sdate;
    $days = $obj / 86400;

    // Calculate charges based on the number of people
    if ($peop > 3) {
        $extra_people = $peop - 3; // Calculate extra people above 3
        if ($extra_people == 1) {
            $c = 500; // Charge ₹500 for 1 extra person
        } elseif ($extra_people == 2) {
            $c = 1000; // Charge ₹1000 for 2 extra people
        } else {
            $c = 0; // No additional charge
        }
    } else {
        $c = 0; // No additional charge if 3 or fewer people
    }

    // Calculate total price
    $price = $days * ($r_p + $c);

    
}



         
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/feedback.css">
  <link rel="stylesheet" href="css/book_now.css">
  <title>Document</title>
</head>
<body>
<div class="feedimg">
        <img src="image/lobby.jpeg" alt="" class="book_img1">
    </div>

    <div class="disc_sit">
        <center>
            <p class="wlc_msg wel1">Room Book</p>
        </center>
        <br>
    </div>

    <div class="manage">
         <center> <h2 >Room No : <?php echo $rno; ?></h2></center>

                <form class="room-form"  method="post">

                    <div class="room">
                    <label class="lab">name</label>
                    <input type="hidden" class="in" name="rno" value="<?php echo $rno; ?>" >
                    <input type="text" class="in" name="name" value="<?php echo $uname; ?>" >
                    </div>

                    <div class="room">
                    <label class="lab">phone no</label>
                    <input type="number" class="in" name="pno" value="<?php echo $pno; ?>">
                    </div>

                    <div class="room">
                    <label class="lab">check in</label>
                    <input type="date" class="in" name="cin" value="<?php echo $cin; ?>" >
                    </div>

                    <div class="room">
                    <label class="lab">check out</label>
                    <input type="date" class=" in" name="cout" value="<?php echo $cout; ?>" >
                    </div>

                    <div class="room">
                    <label class="lab">people</label>
                    <input type="number" class=" in" name="peop" value="<?php echo $peop; ?>" >
                    </div>

                    <div class="room">
                    <label class="lab">price</label>
                    <input type="number" class=" in" name="price" value="<?php echo $price; ?>">
                  </div>
                  
                  <button type="click"  class="submit" name="check_price">check price</button>
                    <button type="submit" class="submit" name="book_room">book room</button>
                    <br><br>
                    <span style="color:blue;font-weight:bold;font-family:sans-serif;font-size:20px;margin-left:-40px;">
                      <?php
                    echo "&nbsp;&nbsp;&nbsp;" . $err;
                    echo "&nbsp;&nbsp;&nbsp;" . $err2;
                    echo   $err3;
                    ?>
                    </span>
                </form>

            </div>
</body>
</html>