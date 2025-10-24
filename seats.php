<?php
session_start(); 
if (isset($_GET['theatre'], $_GET['time'], $_GET['movie'], $_GET['day'], $_GET['date'], $_GET['full_date'])) {
  $_SESSION['theatre'] = $_GET['theatre'];
  $_SESSION['time'] = $_GET['time'];
  $_SESSION['movie'] = $_GET['movie'];
  $_SESSION['day'] = $_GET['day'];
  $_SESSION['date'] = $_GET['date'];
  $_SESSION['full_date'] = $_GET['full_date'];
}
// Get all parameters from URL with proper validation
$theatre = isset($_GET['theatre']) ? urldecode($_GET['theatre']) : 'Unknown Theatre';
$time = isset($_GET['time']) && $_GET['time'] !== 'undefined' ? urldecode($_GET['time']) : 'Time Not Specified';
$movie = isset($_GET['movie']) ? urldecode($_GET['movie']) : 'GOOD BAD UGLY';
$day = isset($_GET['day']) ? $_GET['day'] : '';
$date = isset($_GET['date']) ? urldecode($_GET['date']) : '';
$fullDate = isset($_GET['full_date']) ? $_GET['full_date'] : '';

// Theater price map
$priceMap = [
    'Theatre' => 350,
    'multiplex' => 250,
    'INOX' => 120,
    'Satyam' => 200,
    'PVR' => 300,
    'cinemas' => 220,
    'Ganapathy Ram' => 100  // Specific price for Ganapathy Ram
];

// Calculate price based on theater name
$seatPrice = 100; // Default price
foreach ($priceMap as $keyword => $price) {
    if (stripos($theatre, $keyword) !== false) {
        $seatPrice = $price;
        break;
    }
}

// Apply premium pricing for evening shows
if (in_array($time, ['04:00 PM', '07:00 PM'])) {
    $seatPrice = ceil($seatPrice * 1.2); // 20% premium
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seat Selection - <?= htmlspecialchars($movie) ?></title>
  <style>
    body, html {
      font-family: 'Segoe UI', sans-serif;
      background-color: #0a1628;
      color: white;
      height: 100%;
      overflow-x: hidden;
    }
    .movie-info {
      font-size: 24px;
      font-weight: bold;
      margin-top: 20px;
    }
    .subtitle {
      color: gray;
      margin-bottom: 20px;
    }
    .seats-wrapper {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .seats-container {
      display: inline-block;
      text-align: center;
    }
    .row {
      display: flex;
      justify-content: center;
      margin-bottom: 5px;
      align-items: center;
    }
    .row-label {
      width: 20px;
      margin-right: 10px;
      text-align: right;
    }
    .seat {
      width: 30px;
      height: 30px;
      margin: 2px;
      border: 1px solid #00b386;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      border-radius: 4px;
      color: white;
    }
    .seat.selected {
      background-color: #00b386;
    }
    .seat.sold {
      background-color: #eee;
      color: #333;
      cursor: not-allowed;
    }
    .legend {
      margin-top: 20px;
    }
    .legend span {
      margin-right: 20px;
    }
    .legend-box {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 1px solid #ccc;
      vertical-align: middle;
      margin-right: 5px;
    }
    .legend-box.selected {
      background-color: #00b386;
    }
    #summary {
      margin-top: 30px;
      font-size: 16px;
    }
    .amount-button {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      background-color: #ffcc00;
      color: #000;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }
    .booking-summary {
      background: #1a1a2e;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }
    .screen {
      width: 80%;
      height: 20px;
      background: linear-gradient(to bottom, #fff, #aaa);
      margin: 0 auto 30px;
      text-align: center;
      color: #000;
      font-weight: bold;
    }
  </style>
</head>
<body>
<center>
  <div class="booking-summary">
    <div class="movie-info"><?= htmlspecialchars($movie) ?></div>
    <div class="subtitle">
      <?= htmlspecialchars($theatre) ?> | 
      <?= htmlspecialchars("$day, $date, $time") ?>
    </div>
    <h2>Selected Theatre: <?= htmlspecialchars($theatre) ?></h2>
    <h3>Showtime: <?= htmlspecialchars($time) ?></h3>
    <h3>Ticket Price: Rs.<?= $seatPrice ?></h3>
  </div>

  <div class="screen">SCREEN</div>
</center>

<div class="seats-wrapper">
  <div class="seats-container" id="seatsContainer">
    <!-- Seat rows will be generated here -->
  </div>
</div>

<center>
  <div class="legend">
    <span><div class="legend-box"></div> Available</span>
    <span><div class="legend-box selected"></div> Selected</span>
    <span><div class="legend-box" style="background-color: #eee;"></div> Sold</span>
  </div>

  <div id="summary">
    <p>Selected Seats: <span id="selectedSeats">None</span></p>
    <div id="goToPayment" class="amount-button">Total Amount: ₹<span id="totalAmount">0</span></div>
  </div>
</center>

<script>
  const seatPrice = <?= $seatPrice ?>;
  const selectedSeats = new Set();
  const soldSeats = ['B5', 'B6', 'C10', 'D15', 'E1']; // Predefined sold seats

  const layout = {
    A: 20, B: 20, C: 20, D: 20, E: 20,
    F: 20, G: 20, H: 20, I: 20
  };

  const seatsContainer = document.getElementById('seatsContainer');
  const selectedSeatsEl = document.getElementById('selectedSeats');
  const totalAmountEl = document.getElementById('totalAmount');

  // Generate seat layout
  for (let row in layout) {
    const rowDiv = document.createElement('div');
    rowDiv.classList.add('row');
    
    const label = document.createElement('span');
    label.classList.add('row-label');
    label.textContent = row;
    rowDiv.appendChild(label);

    for (let i = 1; i <= layout[row]; i++) {
      const seatId = `${row}${i}`;
      const seat = document.createElement('div');
      seat.classList.add('seat');
      seat.textContent = i;
      
      if (soldSeats.includes(seatId)) {
        seat.classList.add('sold');
      } else {
        seat.addEventListener('click', () => {
          seat.classList.toggle('selected');
          if (selectedSeats.has(seatId)) {
            selectedSeats.delete(seatId);
          } else {
            selectedSeats.add(seatId);
          }
          updateSummary();
        });
      }
      rowDiv.appendChild(seat);
    }
    seatsContainer.appendChild(rowDiv);
  }

  function updateSummary() {
    const seatsList = Array.from(selectedSeats).sort();
    selectedSeatsEl.textContent = seatsList.length ? seatsList.join(', ') : 'None';
    totalAmountEl.textContent = seatsList.length * seatPrice;
  }

  document.getElementById('goToPayment').addEventListener('click', () => {
    if (selectedSeats.size > 0) {
      const params = new URLSearchParams();
      params.append('theatre', '<?= urlencode($theatre) ?>');
      params.append('time', '<?= urlencode($time) ?>');
      params.append('movie', '<?= urlencode($movie) ?>');
      params.append('day', '<?= $day ?>');
      params.append('date', '<?= urlencode($date) ?>');
      params.append('full_date', '<?= $fullDate ?>');
      params.append('seats', Array.from(selectedSeats).join(','));
      params.append('total', selectedSeats.size * seatPrice);
      params.append('day', '<?= json_encode($day) ?>' || 'No Day');
        params.append('date', '<?= json_encode($date) ?>' || 'No Date');
        params.append('full_date', '<?= json_encode($fullDate) ?>' || 'No Full Date');
      
      window.location.href = 'payment.php?' + params.toString();
    } else {
      alert('Please select at least one seat');
    }
  });
</script>
</body>
</html>