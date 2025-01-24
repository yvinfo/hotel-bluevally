<?php
include "conn.php";
include "header.php";

$message = '';

if (isset($_POST['cancel_booking'])) {
    $no = trim($_POST['booking_no']); // Trim the input to remove extra spaces

    if (!empty($no)) {

        // Fetch booking details
        $query = "SELECT * FROM book WHERE no='$no' AND pstatus='paid'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $booking = mysqli_fetch_assoc($result);
            $amountPaid = $booking['price'];
            $refundAmount = $amountPaid * 0.5; // 50% refund

            // Update booking status to "cancelled"
            $update_sql = "UPDATE book SET pstatus='cancelled' WHERE no='$no'";
            $delete_sql = "DELETE FROM book WHERE no='$no'";
            $refund_sql = "INSERT INTO payment VALUES ('','$no', '$refundAmount', 'refund', 'Refund issued to bank', 'completed')";

            if (mysqli_query($conn, $update_sql)) {
                if (mysqli_query($conn, $delete_sql)){
                    if (mysqli_query($conn, $refund_sql)) {
                        $message = "Booking number $no has been successfully cancelled. A refund of ₹" . 
                        number_format($refundAmount, 2) . " has been issued to your bank.";
                    } 
                    else {
                        $message = "Booking cancelled and room deleted, but refund failed. Please contact support.";
                    }
                }
                else{
                    $message = "Booking cancelled and room deleted, but refund failed. Please contact support.";
                }
            } 
            else {
                $message = "Failed to cancel the booking. Please try again.";
            }
        } else {
            $message = "Invalid booking number, booking not found, or payment not completed.";
        }
    } else {
        $message = "Please enter a booking number.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancel Booking</title>
    <link rel="stylesheet" href="css/cancel.css">
</head>
<body>
    <div class="cancel-container">
    <div class="tick">&#10006</div>
        <h1>Cancel Booking </h1>

    

        <form action="" method="post">
            <div class="form-group">
                <label for="booking_no">Booking Number:</label>
                <input type="text"  name="booking_no" placeholder="Enter your booking number" value="" required>
            </div>

            <button type="submit" name="cancel_booking">Cancel Booking</button>
        </form>

        
            <div class="message">
                <?php echo $message; ?>
            </div>
      

        <div class="notice">
            <p><strong>Please Note:</strong></p>
            <p>- Cancellation will result in a 50% refund of the booking amount</p>
            <p>- Refund will be processed to your original payment method</p>
            <p>- Processing time may take 5-7 business days</p>
        </div>
    </div>
</body>
</html>
