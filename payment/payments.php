<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Abe Nuar Car Rental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .payment-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .payment-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .payment-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .payment-container button {
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .payment-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Payment Details</h2>
        <form action="process_payment.php" method="post">
            <input type="text" name="card_name" placeholder="Name on Card" required>
            <input type="text" name="card_number" placeholder="Card Number" required>
            <input type="text" name="exp_date" placeholder="Expiry Date (MM/YY)" required>
            <input type="text" name="cvv" placeholder="CVV" required>
            <button type="submit">Submit Payment</button>
        </form>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];

    // Connect to the database
    include 'db_connect.php';

    // Insert payment details into the database
    $sql = "INSERT INTO payments (card_name, card_number, exp_date, cvv) VALUES ('$card_name', '$card_number', '$exp_date', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "Payment successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>
