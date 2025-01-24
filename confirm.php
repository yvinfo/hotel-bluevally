<?php
include "conn.php"; // Include database connection
include "header.php";

// Check if the booking number is provided in the query string
if (!isset($_GET['no'])) {
    echo "No booking number provided.";
    exit();
}

$no = $_GET['no'];

// Fetch booking and payment details
$bquery = "SELECT * FROM book WHERE no = '$no'";
$pquery = "SELECT * FROM payment WHERE no = '$no'";

$bresult = mysqli_query($conn, $bquery);
$presult = mysqli_query($conn, $pquery);

if ($bresult && mysqli_num_rows($bresult) > 0) {
    $booking = mysqli_fetch_assoc($bresult);
} else {
    echo "Booking not found.";
    exit();
}

if ($presult && mysqli_num_rows($presult) > 0) {
    $payment = mysqli_fetch_assoc($presult);
} else {
    echo "Payment details not found.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/confirm.css">
</head>
<body>
    <div class="confirmation-container">
    <div class="tick">&#10003</div>
        <h2>Booking Confirmation</h2>

        <div class="success-message">
            Payment Successful! Your booking is confirmed.
        </div>

        <div class="details">
            <div><span>Booking ID:</span> <?php echo $booking['no']; ?></div>
            <div><span>Room No:</span> <?php echo $booking['rno']; ?></div>
            <div><span>Name:</span> <?php echo $booking['name']; ?></div>
            <div><span>Check-in:</span> <?php echo $booking['cin']; ?></div>
            <div><span>Check-out:</span> <?php echo $booking['cout']; ?></div>
            <div><span>Amount Paid:</span> ₹<?php echo number_format((float)$payment['amount'], 2); ?></div>
            <div><span>Payment Method:</span> <?php echo ucfirst(str_replace('_', ' ', $payment['method'])); ?></div>
            <div><span>Payment Status:</span> <?php echo ucfirst($payment['status']); ?></div>
        </div>

        <a href="home.php" class="home-button">Back to Home</a>
    </div>
</body>
</html>
