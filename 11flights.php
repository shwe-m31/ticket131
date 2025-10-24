<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fare Options</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background-color: #0e1621;
    }
    h2 {
      text-align: center;
      color: white;
    }
    .container {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }
    .card {
      background: lightgray;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
      padding: 20px;
    }
    .price {
      font-size: 24px;
      font-weight: bold;
    }
    .section-title {
      font-weight: bold;
      margin-top: 20px;
    }
    ul {
      list-style: none;
      padding-left: 0;
    }
    li {
      margin-bottom: 8px;
    }
    .check {
      color: green;
    }
    .cross {
      color: orange;
    }
    .highlight {
      color: red;
      font-weight: bold;
    }
    .buttons {
      display: flex;
      justify-content: space-around;
      margin-top: 20px;
    }
    .btn {
      padding: 10px 20px;
      border-radius: 20px;
      border: 2px solid #007bff;
      background: white;
      color: #007bff;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-primary {
      background: #007bff;
      color: white;
      border: none;
    }
  </style>
</head>
<body>

  <h2><span style="color:#0aaf8d;">3 FAIR OPTIONS</span> available for your trip.</h2>

  <div class="container">
    <!-- XPRESS VALUE -->
    <div class="card">
      <div class="price">₹ 5,931 <span style="font-size:14px;">per adult</span></div>
      <H2><span class="highlight">CLASSIC</span></H2>

      <div class="section-title">Baggage</div>
      <ul>
        <li class="check">✓ 7 Kgs Cabin Baggage</li>
        <li class="check">✓ 15 Kgs Check-in Baggage</li>
      </ul>

      <div class="section-title">Flexibility</div>
      <ul>
        <li class="cross">– Cancellation fee starts at ₹ 4,300 (up to 2 hours before departure)</li>
        <li class="cross">– Date Change fee starts at ₹ 3,000 up to 2 hrs before departure</li>
      </ul>

      <div class="section-title">Seats, Meals & More</div>
      <ul>
        <li class="cross">– Chargeable Seats</li>
        <li class="cross">– Chargeable Meals</li>
      </ul>

      <div class="buttons">
        <button onclick="window.location.href='payment3.php';"class="btn btn-primary">BOOK NOW</button>
      </div>
    </div>

    <!-- FARE BY MAKEMYTRIP -->
    <div class="card">
      <div class="price">₹ 6,180 <span style="font-size:14px;">per adult</span></div>
      <H2><span class="highlight">DELUX</span></H2>

      <div class="section-title">Baggage</div>
      <ul>
        <li class="check">✓ 7 Kgs Cabin Baggage</li>
        <li class="check">✓ 15 Kgs Check-in Baggage</li>
      </ul>

      <div class="section-title">Flexibility</div>
      <ul>
        <li class="cross">– Cancellation fee starts at ₹ 4,300 (up to 2 hours before departure)</li>
        <li class="cross">– Date Change fee starts at ₹ 3,000 up to 2 hrs before departure</li>
      </ul>

      <div class="section-title">Seats, Meals & More</div>
      <ul>
        <li class="cross">– Chargeable Seats</li>
        <li class="cross">– Chargeable Meals</li>
      </ul>

      <p class="highlight">BENEFITS WORTH ₹ 1,500 INCLUDED</p>

      <div class="buttons">
        <button onclick="window.location.href='payment3.php';"class="btn btn-primary">BOOK NOW</button>
      </div>
    </div>

    <!-- XPRESS FLEX -->
    <div class="card">
      <div class="price">₹ 6,667 <span style="font-size:14px;">per adult</span></div>
      <H2><span class="highlight">DELUX</span></H2>

      <div class="section-title">Baggage</div>
      <ul>
        <li class="check">✓ 7 Kgs Cabin Baggage</li>
        <li class="check">✓ 15 Kgs Check-in Baggage</li>
      </ul>

      <div class="section-title">Flexibility</div>
      <ul>
        <li class="cross">– Cancellation fee starts at ₹ 4,300 (up to 2 hours before departure)</li>
        <li class="check">✓ <span style="color:#0aaf8d;">Free</span> Date Change up to 2 hrs before departure</li>
      </ul>

      <div class="section-title">Seats, Meals & More</div>
      <ul>
        <li class="cross">– Chargeable Seats</li>
        <li class="cross">– Chargeable Meals</li>
      </ul>

      <div class="buttons">
        <button onclick="window.location.href='payment3.php';"class="btn btn-primary">BOOK NOW</button>
      </div>
    </div>
  </div>
</body>
</html>
