<?php
session_start();

// Redirect if required session data is missing
//if (!isset($_SESSION['concert']) || !isset($_SESSION['user']) || !isset($_SESSION['payment_mode'])) {
  //  header("Location: login.php");
    //exit();
//}

$concert = $_SESSION['concert'] ?? [];
// Keep the existing session-driven ticket flow, while carrying the payment
// field posted by payment2.php (which uses payment_method).
$_SESSION['user'] = $_SESSION['email'] ?? 'Guest';
$_SESSION['ticket_number'] = 'TCKT' . rand(1000, 9999);
$_SESSION['booked_on'] = date('Y-m-d');
$_SESSION['payment_mode'] = $_POST['payment_method'] ?? $_POST['payment_mode'] ?? 'UPI';
$ticket_no = $_SESSION['ticket_number'];
$booked_on = $_SESSION['booked_on'];


// Handle download ticket logic
if (isset($_GET['download']) && $_GET['download'] === 'true') {
    $ticket = "🎫 Concert Ticket\n";
    $ticket .= "----------------------\n";
    $ticket .= "Starring: {$concert['starring']}\n";
    $ticket .= "Date: {$concert['date']}\n";
    $ticket .= "Time: {$concert['time']}\n";
    $ticket .= "Venue: {$concert['venue']}\n";
    $ticket .= "Payment Mode: {$_SESSION['payment_mode']}\n";
    $ticket .= "User: {$_SESSION['user']}\n";
    $ticket .= "Ticket Number: {$ticket_no}\n";
    $ticket .= "Booked On: {$booked_on}\n";

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="concert_ticket.txt"');
    echo $ticket;
    exit();
}

// Calculate total amount
$total_amount = $_SESSION['total_amount'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Concert Ticket</title>
    <style>
        .ticket-container {
            max-width: 600px;
            margin: 40px auto;
            border: 2px solid #000;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin-top: 15%;
        }
        .ticket-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .ticket-details .left, .ticket-details .right {
            width: 45%;
        }
        .button-group {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #0055cc;
            color: white;
            border: none;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0040a0;
        }
    </style>
</head>
<body style="background-image:url('conbck.avif');background-repeat:no-repeat;background-size:cover;">

<div class="ticket-container" id="ticket">
    <h1>🎫 Concert Ticket</h1>
    <div class="ticket-details">
        <div class="left">
            <p><strong>Starring:</strong> <?= $concert['starring']; ?></p>
            <p><strong>Date:</strong> <?= $concert['date']; ?></p>
            <p><strong>Time:</strong> <?= $concert['time']; ?></p>
            <p><strong>Payment Mode:</strong> <?= $_SESSION['payment_mode']; ?></p>
        </div>
        <div class="right">
            <p><strong>Total Amount:</strong> ₹<?= isset($total_amount) ? $total_amount : 'N/A'; ?></p>
            <p><strong>Venue:</strong> <?= $concert['venue']; ?></p>
            <p><strong>Ticket Number:</strong> <?= $ticket_no; ?></p>
            <p><strong>Booked On:</strong> <?= $booked_on; ?></p>
        </div>
    </div>

    <div class="button-group">
        <button class="btn" onclick="window.print()">Download Ticket</button>
        <a href="concerts.php" class="btn">Go Back</a>
    </div>
</div>

</body>
</html>
