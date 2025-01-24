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

if (isset($_GET['name'])) {
    $name = $_GET['name'];
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
    $adddetails = '';

    // Handle Debit Card Details
    if ($method === 'debit_card') {
        $cardNumber = $_POST['card_number_debit'];
        $expiryDate = $_POST['expiry_date_debit'];
        $cvv = $_POST['cvv_debit'];

        $adddetails = "Card Number: $cardNumber, Expiry Date: $expiryDate, CVV: $cvv";
    }
    // Handle UPI Details
    elseif ($method === 'upi') {
        $upiId = $_POST['upi_id'];
        $adddetails = "UPI ID: $upiId";
    }
    // Handle Net Banking Details
    elseif ($method === 'net_banking') {
        $bankName = $_POST['bank_name'];
        $accountNumber = $_POST['account_number'];
        $ifscCode = $_POST['account_iafc'];

        $adddetails = "Bank Name: $bankName, Account Number: $accountNumber, IFSC Code: $ifscCode";
    }

    // Insert payment details into the payment table
    $sql = "INSERT INTO payment VALUES ('','$no', '$amount', '$method', '$adddetails', 'completed')";

    if (mysqli_query($conn, $sql)) {
        // Update booking payment status
        $update_sql = "UPDATE book SET pstatus='paid' WHERE no='$no'";
        mysqli_query($conn, $update_sql);

        // Redirect to confirmation page
        header("Location: confirm.php?no=$no");
        exit();
    } else {
        echo "Payment failed. Please try again.";
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="css/payment.css">
    <script>
        // Function to show the selected payment method details
        function PaymentMethodDetails() {
            var debitCardDetails = document.getElementById('debit-card-details');
            var upiDetails = document.getElementById('upi-details');
            var netBankingDetails = document.getElementById('netbanking-details');

            // Hide all details sections initially
            debitCardDetails.style.display = 'none';
            upiDetails.style.display = 'none';
            netBankingDetails.style.display = 'none';

            // Show the selected method details
            var selectedMethod = document.querySelector('input[name="method"]:checked').value;

            if (selectedMethod === 'debit_card') {
                debitCardDetails.style.display = 'block';
            } else if (selectedMethod === 'upi') {
                upiDetails.style.display = 'block';
            } else if (selectedMethod === 'net_banking') {
                netBankingDetails.style.display = 'block';
            }
        }

        // Initialize by hiding all details sections
        document.addEventListener('DOMContentLoaded', function() {
            PaymentMethodDetails();
        });
    </script>
</head>
<body>
    <div class="payment-container">
        <h1 style="letter-spacing: 3px;">Payment Details</h1>
        <div class="payment-total">
            Room No: <?php echo $rno ?>
        </div>
        <div class="payment-total">
            Name: <?php echo $name ?>
        </div>
        <div class="payment-total">
            Total Amount: ₹<?php echo number_format((float)$amount, 2); ?>
        </div>

        <form action="" method="post">
            <div class="payment-method">
                <h3 style="text-decoration: underline;letter-spacing: 0.5px;">Select Payment Method</h3>

                <!-- Debit Card -->
                <div>
                    <input type="radio" id="debit" name="method" value="debit_card" required onclick="PaymentMethodDetails()">
                    <label for="debit">Debit Card</label>

                    <div id="debit-card-details" class="payment-method-details" style="display:none;">
                        <h3>Enter Debit Card Details</h3>
                        <div>
                            <label for="card_number_debit">Card Number</label>
                            <input type="text" id="card_number_debit" name="card_number_debit" placeholder="Enter Debit Card Number" pattern="[0-9]{16}" title="Please enter a valid 16-digit card number">
                        </div>
                        <div>
                            <label for="expiry_date_debit">Expiry Date</label>
                            <input type="text" id="expiry_date_debit" name="expiry_date_debit" placeholder="MM/YY">
                        </div>
                        <div>
                            <label for="cvv_debit">CVV</label>
                            <input type="text" id="cvv_debit" name="cvv_debit" placeholder="Enter CVV">
                        </div>
                    </div>
                </div>

                <!-- UPI -->
                <div>
                    <input type="radio" id="upi" name="method" value="upi" required onclick="PaymentMethodDetails()">
                    <label for="upi">UPI</label>

                    <div id="upi-details" class="payment-method-details" style="display:none;">
                        <h3>Enter UPI ID</h3>
                        <div>
                            <label for="upi_id">UPI ID</label>
                            <input type="text" id="upi_id" name="upi_id" placeholder="Enter UPI ID e.g., yourname@bank" >
                        </div>
                    </div>
                </div>

                <!-- Net Banking -->
                <div>
                    <input type="radio" id="netbanking" name="method" value="net_banking" required onclick="PaymentMethodDetails()">
                    <label for="netbanking">Net Banking</label>

                    <div id="netbanking-details" class="payment-method-details" style="display:none;">
                        <h3>Enter Net Banking Details</h3>
                        <div>
                            <label for="bank_name">Bank Name</label>
                            <input type="text" id="bank_name" name="bank_name" placeholder="Enter Bank Name e.g., State Bank of India">
                        </div>
                        <div>
                            <label for="account_number">Account Number</label>
                            <input type="text" id="account_number" name="account_number" placeholder="Enter Account Number e.g., 123456789012" pattern="\d{9,18}" title="Please enter a valid account number (9 to 18 digits)">
                        </div>
                        <div>
                            <label for="account_iafc">Account IFSC Code</label>
                            <input type="text" id="account_iafc" name="account_iafc" placeholder="Enter Account IFSC Code e.g., SBIN0001234" style="text-transform: uppercase;" >
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="submit" name="confirm_payment">Confirm Payment</button>
        </form>
    </div>
</body>
</html>
