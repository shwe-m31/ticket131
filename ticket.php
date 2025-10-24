<?php
session_start();
$seats = (isset($_SESSION['selected_seats']) && is_array($_SESSION['selected_seats'])) 
    ? implode(', ', $_SESSION['selected_seats']) 
    : 'Not Selected';

$movie = $_SESSION['movie'] ?? 'N/A';
$theatre = $_SESSION['theatre'] ?? 'N/A';
$time = $_SESSION['time'] ?? 'N/A';
$date = $_SESSION['full_date'] ?? 'N/A';
$total = $_SESSION['total_amount'] ?? 'N/A';

if (isset($_POST['payment_method'])) {
    $_SESSION['payment_method'] = $_POST['payment_method'];
}
$paymentMethod = $_SESSION['payment_method'] ?? 'Unavailable';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Ticket</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f0f0;
        padding: 30px;
    }
    .ticket-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
    }
    .success-msg {
        color: green;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
    }
    .ticket-row {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }
    .label {
        font-weight: bold;
    }
    .download-section {
        text-align: center;
        margin-top: 30px;
    }
    .btn {
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
    }
    .btn:hover {
        background-color: #218838;
    }
  </style>
</head>
<body style="background-image:url('nbck3.jpg');background-repeat:no-repeat;background-size:cover;">

<div class="ticket-container" id="ticketInfo">
    <div class="success-msg">✅ Payment Successful</div>

    <div class="ticket-row"><span class="label">🎬 Movie:</span><span><?= htmlspecialchars($movie) ?></span></div>
    <div class="ticket-row">
        <span class="label">🏛️ Theatre:</span>
        <span><?= htmlspecialchars(explode('(', $theatre)[0]) ?></span>
    </div>
    <div class="ticket-row"><span class="label">📅 Date:</span><span><?= htmlspecialchars($date) ?></span></div>
    <div class="ticket-row"><span class="label">⏰ Time:</span><span><?= htmlspecialchars($time) ?></span></div>
    <div class="ticket-row"><span class="label">🎟️ Seats:</span><span><b><?= htmlspecialchars($seats) ?></b></span></div>
    <hr>

    <div class="ticket-row"><span class="label">💰 Total Amount:</span><span><b>₹<?= htmlspecialchars($total) ?></b></span></div>
    <div class="ticket-row"><span class="label">💳 Payment Method:</span><span id="method"><?= htmlspecialchars($paymentMethod) ?></span></div>
    <div class="ticket-row"><span class="label">👤 User Info:</span><span id="user">Unavailable</span></div>
    <div class="ticket-row"><span class="label">🔢 Ticket Number:</span><span id="ticketNumber">Unavailable</span></div>
    <div class="ticket-row"><span class="label">📌 Booked On:</span><span id="date">Loading...</span></div>

    <div class="download-section">
        <p><em>Click below to download 👇</em></p>
       <!-- <button class="btn" id="downloadBtn">Download Ticket</button>-->
       <button class="btn" id="downloadBtn" onclick="window.print()">DownloadTicket</button>
        <a href="movies.php"><button class="btn">Go Back</button></a>
    </div>
</div>

<script>
  const now = new Date();
  document.getElementById('date').textContent = now.toLocaleString();

  // Load data from localStorage
  const ticketData = JSON.parse(localStorage.getItem('ticketData'));
  if (ticketData) {
    document.getElementById('user').textContent = ticketData.userData || 'Unavailable';
    document.getElementById('ticketNumber').textContent = ticketData.ticketNumber || 'Unavailable';
  }

  // PDF Download
  document.getElementById('downloadBtn').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const movie = "<?= addslashes($movie) ?>";
    const theatre = "<?= addslashes(explode('(', $theatre)[0]) ?>";
    const date = "<?= addslashes($date) ?>";
    const time = "<?= addslashes($time) ?>";
    const seats = "<?= addslashes($seats) ?>";
    const method = document.getElementById('method').textContent;
    const user = document.getElementById('user').textContent;
    const ticketNum = document.getElementById('ticketNumber').textContent;

    doc.setFontSize(16);
    doc.text("🎟️ Movie Ticket", 20, 20);
    doc.setFontSize(12);
    doc.text(`Movie: ${movie}`, 20, 40);
    doc.text(`Theatre: ${theatre}`, 20, 50);
    doc.text(`Date: ${date}`, 20, 60);
    doc.text(`Time: ${time}`, 20, 70);
    doc.text(`Seats: ${seats}`, 20, 80);
    doc.text(`Payment Method: ${method}`, 20, 90);
    doc.text(`User Info: ${user}`, 20, 100);
    doc.text(`Ticket Number: ${ticketNum}`, 20, 110);
    doc.text(`Booked On: ${now.toLocaleString()}`, 20, 120);
    doc.text("Thank you for booking with us!", 20, 140);

    doc.save(`Movie_Ticket_${ticketNum || 'Unknown'}.pdf`);
  });
</script>

</body>
</html>
