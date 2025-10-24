<?php
session_start();

if (isset($_GET['seats'])) {
    $_SESSION['selected_seats'] = explode(',', $_GET['seats']); // Store seats as array
    $_SESSION['seat_count'] = count($_SESSION['selected_seats']);

    // Optional: only store seat price if it's also passed or calculated earlier
    if (isset($_GET['seat_price'])) {
        $_SESSION['seat_price'] = $_GET['seat_price'];
    }

    // Store total amount from GET
    if (isset($_GET['total'])) {
        $_SESSION['total_amount'] = $_GET['total'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Options</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #0e1621;
      color: white;
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 250px;
      background-color: #1e293b;
      color: white;
      padding: 20px;
    }

    .sidebar h3 {
      font-size: 18px;
    }

    .sidebar button {
      display: block;
      margin-bottom: 10px;
      padding: 12px;
      width: 100%;
      background: #fff;
      color: #000;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }

    .content {
      flex: 1;
      padding: 30px;
      overflow-y: auto;
    }

    .hidden {
      display: none;
    }

    /* UPI */
    .upi-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-bottom: 30px;
    }

    .upi-option {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    .upi-option input[type="radio"] {
      margin-right: 15px;
    }

    .upi-option img {
      width: 40px;
      height: 40px;
      object-fit: contain;
      margin-right: 10px;
    }

    .upi-form {
      display: none;
      background:lightgray;
      color: black;
      padding: 20px;
      border-radius: 8px;
      width: 400px;
    }

    .upi-form input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
    }

    .upi-form button {
      background-color: #f44336;
      color: lightgray;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-weight: bold;
      cursor: pointer;
    }

    /* Card */
    .card-form {
      background-color: lightgray;
      color: #000;
      padding: 20px;
      border-radius: 8px;
      width: 300px;
    }

    .card-form input {
      width: 100%;
      margin: 10px 0;
      padding: 8px;
    }

    .pay-button {
      background-color: #f73859;
      border: none;
      color: white;
      padding: 10px;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
      border-radius: 4px;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h3>Payment options</h3>
  <button onclick="showSection('upi')">Pay by any UPI App</button>
  <button onclick="showSection('card')">Debit/Credit Card</button>
  <button onclick="showSection('netbanking')">Net Banking</button>
</div>

<div class="content">
  <!-- UPI Section -->
  <div id="upi" class="section">
    <h2><img src="upi.jpeg" height="24" alt="UPI Logo"> Pay by any UPI App</h2>
    <div class="upi-grid">
      <label class="upi-option">
        <input type="radio" name="upi" value="google" onclick="showForm('google')" />
        <img src="gpay.webp" alt="GPay"> Google Pay
      </label>

      <label class="upi-option">
        <input type="radio" name="upi" value="amazon" onclick="showForm('amazon')" />
        <img src="amazonpay.jpeg" alt="Amazon Pay"> Amazon Pay UPI
      </label>

      <label class="upi-option">
        <input type="radio" name="upi" value="paytm" onclick="showForm('paytm')" />
        <img src="paytm.jpeg" alt="Paytm"> Paytm
      </label>

      <label class="upi-option">
        <input type="radio" name="upi" value="phonepe" onclick="showForm('phonepe')" />
        <img src="phonepe.jpeg" alt="PhonePe"> PhonePe
      </label>
    </div>

    <!-- UPI Forms -->
    <center>
    <div id="google-form" class="upi-form">
      <h3>Google Pay</h3>
      <p>Enter your Google Pay mobile number</p>
      <input type="text" placeholder="Enter mobile number please" />
      <label><input type="checkbox" /> QUIKPAY<br><small>Save this UPI option to my account and make faster payments.</small></label><br><br>
      <button onclick="makePayment('Google Pay')">Make Payment</button>
    </div>

    <div id="amazon-form" class="upi-form">
      <h3>Amazon Pay UPI</h3>
      <p>Enter your Amazon Pay UPI number</p>
      <input type="text" placeholder="Enter mobile number please" />
      <button onclick="makePayment('Amazon Pay')">Make Payment</button>
    </div>

    <div id="paytm-form" class="upi-form">
      <h3>Paytm</h3>
      <p>Enter your Paytm mobile number</p>
      <input type="text" placeholder="Enter mobile number please" />
      <button onclick="makePayment('Paytm')">Make Payment</button>
    </div>

    <div id="phonepe-form" class="upi-form">
      <h3>PhonePe</h3>
      <p>Enter your PhonePe number</p>
      <input type="text" placeholder="Enter mobile number please" />
      <button onclick="makePayment('PhonePe')">Make Payment</button>
    </div>
  </center>
  </div>
<center>
  <!-- Card Section -->
  <div id="card" class="section hidden">
    <h2>Enter your Card details</h2>
    <div class="card-form">
      <input type="text" placeholder="Enter Your Card Number" />
      <input type="text" placeholder="Name on the card" />
      <div style="display: flex; gap: 10px;">
        <input type="text" placeholder="MM" style="flex: 1;" />
        <input type="text" placeholder="YY" style="flex: 1;" />
        <input type="text" placeholder="CVV" style="flex: 1;" />
      </div>
      <button onclick="makePayment('Card')">Make Payment</button>
    </div>
  </div>
</center>
<center>
  <!-- Net Banking Section -->
  <div id="netbanking" class="section hidden">
    <h2>Net Banking</h2>
    <form class="card-form">
      <label for="bank">All Banks</label>
      <select id="bank" required>
        <option value="">-- Select Bank --</option>
        <option>State Bank of India</option>
        <option>ICICI Bank</option>
        <option>HDFC Bank</option>
        <option>Axis Bank</option>
        <option>Central Bank of India</option>
        <option>Punjab National Bank</option>
        <option>Kotak Mahindra Bank</option>
        <option>Bank of Baroda</option>
      </select>
  
      <input type="text" placeholder="Account Number" required />
      <input type="text" placeholder="IFSC Code" required />
  
      <label style="display: flex; align-items: center; margin-top: 10px;">
        <input type="checkbox" style="margin-right: 10px;" />
        <div>
          <strong>QUIKPAY</strong><br />
          <small style="color: gray;">Save this netbanking option to my account and make faster payments.</small>
          <button onclick="makePayment('Net Banking')">Make Payment</button>
        </div>
      </label>
  
      <br />
      
      <p style="font-size: 12px; margin-top: 10px;">
        By clicking "Make Payment" you agree to the <a href="#" style="color: #ccc;">terms and conditions</a>.
      </p>
    </form>
  </div>
</center>
<script>
  function makePayment(method = 'Unknown') {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = 'ticket.php';

      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'payment_method';
      input.value = method;

      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    }
  function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(sec => sec.classList.add('hidden'));
    document.getElementById(sectionId).classList.remove('hidden');

    // Also hide all UPI forms when switching section
    const upiForms = document.querySelectorAll('.upi-form');
    upiForms.forEach(f => f.style.display = 'none');
  }

  function showForm(provider) {
    const forms = document.querySelectorAll('.upi-form');
    forms.forEach(form => form.style.display = 'none');

    const selectedForm = document.getElementById(provider + '-form');
    if (selectedForm) {
      selectedForm.style.display = 'block';
    }
  }
</script>

</body>
</html>
