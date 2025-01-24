<?php
    include "conn.php";
    include "header.php";

    $no = ''; 
    $amount = 0;
    $rno = '';

    // Check if 'no' is provided via GET request
    if (isset($_GET['no'])) {
        $no = $_GET['no'];
    }
    if (isset($_GET['rno'])) {
        $rno = $_GET['rno'];
    }

    if (!empty($no)) {
        // Fetch booking details based on booking number
        $query = "SELECT * FROM book WHERE no='$no'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $booking = mysqli_fetch_assoc($result);
            $amount = $booking['price'];
        } else {
            echo "Invalid booking number or booking not found.";
            exit();
        }
    } else {
        echo "No booking number provided.";
        exit();
    }

    // Handle payment confirmation
    if (isset($_POST['confirm_payment'])) {
        $method = $_POST['method'];

        // Insert payment details into the payment table
        $sql = "INSERT INTO payment (no, amount, method, status) VALUES ('$no', '$amount', '$method', 'completed')";

        if (mysqli_query($conn, $sql)) {
            // Update booking payment status
            $update_sql = "UPDATE book SET pstatus='paid' WHERE no='$no'";
            mysqli_query($conn, $update_sql);

            // Redirect to confirmation page
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Payment failed. Please try again.";
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="css/book.css">
        <style>
            .payment-container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .payment-method {
                margin: 20px 0;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .payment-total {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin: 10px 0;
                margin-top:20px;
                color: #2c3e50;
            }
            .payment-method h3 {
                margin-bottom: 15px;
                color: #2c3e50;
            }
            .payment-method input[type="radio"] {
                margin: 10px 0;
            }
            .payment-method label {
                margin-left: 10px;
                font-size: 16px;
            }
            .payment-method-details {
                display: none;
                margin-top: 20px;
            }
            .payment-method-details input {
                width: 90%;
                padding: 12px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .submit {
                width: 100%;
                padding: 12px;
                font-size: 15px;
                background-color: gray;
                color: white;
                font-family: 'Roboto', sans-serif;
                letter-spacing: 2px;
                font-weight: bold;
                border-radius: 5px;
                border: none;
                font-size: 16px;
                cursor: pointer;
            }
            .submit:hover {
                box-shadow: 0px 0px 5px 1px gray;
            }
            h1 {
                text-align: center;
                text-decoration: underline;
                letter-spacing: 2px;
                color: #2c3e50;
            }
        </style>
        <script>
            // Function to show the selected payment method details
            function togglePaymentMethodDetails() {
                var debitCardDetails = document.getElementById('debit-card-details');
                var creditCardDetails = document.getElementById('credit-card-details');
                var upiDetails = document.getElementById('upi-details');
                var netBankingDetails = document.getElementById('netbanking-details');

                // Hide all details sections initially
                debitCardDetails.style.display = 'none';
                creditCardDetails.style.display = 'none';
                upiDetails.style.display = 'none';
                netBankingDetails.style.display = 'none';

                // Show the selected method details
                var selectedMethod = document.querySelector('input[name="method"]:checked').value;

                if (selectedMethod === 'debit_card') {
                    debitCardDetails.style.display = 'block';
                } else if (selectedMethod === 'credit_card') {
                    creditCardDetails.style.display = 'block';
                } else if (selectedMethod === 'upi') {
                    upiDetails.style.display = 'block';
                } else if (selectedMethod === 'net_banking') {
                    netBankingDetails.style.display = 'block';
                }
            }
        </script>
    </head>
    <body>
        <div class="payment-container">
            <h1>Payment Details</h1>
            <div class="payment-total">
                Room No: <?php echo $rno ?>
            </div>
            <div class="payment-total">
                Total Amount: ₹<?php echo number_format((float)$amount, 2); ?>
            </div>

            <form action="" method="post">
                <div class="payment-method">
                    <h3>Select Payment Method</h3>

                    <!-- credit card
                    <div>
                        <input type="radio" id="credit" name="method" value="credit_card" required onclick="togglePaymentMethodDetails()">
                        <label for="credit">Credit Card</label>

                             Credit Card Details Section 
                        <div id="credit-card-details" class="payment-method-details">
                            <h3>Enter Credit Card Details</h3>
                        <div>
                            <label for="card_number">Card Number</label>
                            <input type="text" id="card_number" name="card_number" placeholder="Enter Credit Card Number" required>
                        </div>
                        <div>
                            <label for="expiry_date">Expiry Date</label>
                            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                        </div>
                        <div>
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
                        </div>
                        </div>
                    </div> -->
                    
                    <!-- debit card -->
                    <div>
                        <input type="radio" id="debit" name="method" value="debit_card" required onclick="togglePaymentMethodDetails()">
                        <label for="debit">Debit Card</label>

                                        <!-- Debit Card Details Section -->
                        <div id="debit-card-details" class="payment-method-details">
                            <h3>Enter Debit Card Details</h3>
                        <div>
                            <label for="card_number_debit">Card Number</label>
                            <input type="text" id="card_number_debit" name="card_number_debit" placeholder="Enter Debit Card Number" required>
                        </div>
                        <div>
                            <label for="expiry_date_debit">Expiry Date</label>
                            <input type="text" id="expiry_date_debit" name="expiry_date_debit" placeholder="MM/YY" required>
                        </div>
                        <div>
                            <label for="cvv_debit">CVV</label>
                            <input type="text" id="cvv_debit" name="cvv_debit" placeholder="Enter CVV" required>
                        </div>
                        </div>
                    </div>

                    <!-- upi details -->
                    <div>
                        <input type="radio" id="upi" name="method" value="upi" required onclick="togglePaymentMethodDetails()">
                        <label for="upi">UPI</label>

                        <!-- UPI Details Section -->
                        <div id="upi-details" class="payment-method-details">
                            <h3>Enter UPI ID</h3>
                        <div>
                            <label for="upi_id">UPI ID</label>
                            <input type="text" id="upi_id" name="upi_id" placeholder="Enter UPI ID" required>
                        </div>
                        </div>
                    </div>

                    <!-- net banking -->
                    <div>
                        <input type="radio" id="netbanking" name="method" value="net_banking" required onclick="togglePaymentMethodDetails()">
                        <label for="netbanking">Net Banking</label>

                        <!-- Net Banking Details Section -->
                <div id="netbanking-details" class="payment-method-details">
                    <h3>Enter Net Banking Details</h3>
                    <div>
                        <label for="bank_name">Bank Name</label>
                        <input type="text" id="bank_name" name="bank_name" placeholder="Enter Bank Name" required>
                    </div>
                    <div>
                        <label for="account_number">Account Number</label>
                        <input type="text" id="account_number" name="account_number" placeholder="Enter Account Number" required>
                    </div>

                    <div>
                        <label for="account_Iafccode">Account Ifaccode</label>
                        <input type="text" id="account_iafc" name="account_number" placeholder="Enter Account Iafccode" required>
                    </div>
                </div>
                    </div>
                </div>

                <button type="submit" class="submit" name="confirm_payment">Confirm Payment</button>
            </form>
        </div>
    </body>
</html>


<!-- ----------------------------------------------------------------------------------------- -->
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
            if (mysqli_query($conn, $update_sql)) {
                // Insert refund details into the payment table
                $refund_sql = "INSERT INTO payment VALUES ('$no', '$refundAmount', 'refund', 'Refund issued to bank', 'completed')";
                if (mysqli_query($conn, $refund_sql)) {
                    $message = "Booking number $no has been successfully cancelled. A refund of ₹" . 
                               number_format($refundAmount, 2) . " has been issued to your bank.";
                } else {
                    $message = "Booking cancelled, but refund process failed. Please contact support.";
                }
            } else {
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #ff4444;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
            background-color: #cc0000;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }

        .notice {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 4px;
        }

        .notice p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cancel Booking</h1>

        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="booking_no">Booking Number:</label>
                <input type="text" id="booking_no" name="booking_no" required>
            </div>

            <button type="submit" name="cancel_booking" class="btn">Cancel Booking</button>
        </form>

        <div class="notice">
            <p><strong>Please Note:</strong></p>
            <p>- You will receive a 50% refund of your booking amount</p>
            <p>- Refund will be processed to your original payment method</p>
            <p>- Processing time may take 5-7 business days</p>
        </div>
    </div>
</body>
</html>


<!-- delete payment------------------------------------------------------------- -->

<?php
include "../conn.php";

$no = intval($_GET['no']); // Ensure $no is treated as an integer

// Fetch payment method before deletion
$sql_fetch = "SELECT method FROM payment WHERE no = $no";
$result = mysqli_query($conn, $sql_fetch) or die("Query unsuccessful");

// Check if the record exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $method = $row['method'];

    // Check if the method is "Debit Card", "UPI", or "Net Banking"
    if ($method == "debit_card" || $method == "upi" || $method == "net_banking") {
        // Proceed to delete
        $sql_delete = "DELETE FROM payment WHERE no = $no"; // Use `no` for deletion to avoid ambiguity
        $res_delete = mysqli_query($conn, $sql_delete) or die("Query unsuccessful");

        // Redirect to success page
        header("Location: complete.php");
        exit; // Ensure the script stops executing after the redirect
    } else {
        // Display error message
        echo "Record cannot be deleted. Payment method is either blank or not allowed.";
    }
} else {
    echo "No record found with the specified number.";
}

// Close the database connection
mysqli_close($conn);
?>
