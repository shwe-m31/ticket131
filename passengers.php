<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Passenger Details - FlexiGo</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #0e1014;
      color: white;
    }
    .container {
      max-width: 700px;
      margin: 50px auto;
      background: #1c1e26;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
    }
    .container h2 {
      margin-bottom: 20px;
    }
    .passenger-group {
      background-color: #2a2d3a;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 15px;
      background-color: #3b3f4e;
      color: white;
      border: none;
      border-radius: 8px;
    }
    button {
      padding: 10px 20px;
      background-color: #fcd307;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      margin-right: 10px;
    }
    button:hover {
      background-color: #ffdd33;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Enter Passenger Details</h2>
    <form id="passengerForm">
      <div id="passengerList">
        <div class="passenger-group">
          <label>Full Name</label>
          <input type="text" name="name[]" required>

          <label>Age</label>
          <input type="number" name="age[]" required>

          <label>Gender</label>
          <select name="gender[]">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>

          <label>ID Proof (Aadhar, Passport, etc.)</label>
          <input type="text" name="id[]" placeholder="Optional for children">
        </div>
      </div>

      <!-- Add Passenger Button -->
      <button type="button" onclick="addPassenger()">Add Passenger</button>

      <!-- Continue Button -->
      <button type="submit">Continue</button>
    </form>
  </div>

  <script>
    function addPassenger() {
      const passengerList = document.getElementById('passengerList');
      const newPassenger = document.createElement('div');
      newPassenger.className = 'passenger-group';
      newPassenger.innerHTML = `
        <label>Full Name</label>
        <input type="text" name="name[]" required>

        <label>Age</label>
        <input type="number" name="age[]" required>

        <label>Gender</label>
        <select name="gender[]">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
        </select>

        <label>ID Proof (Aadhar, Passport, etc.)</label>
        <input type="text" name="id[]" placeholder="Optional for children">
      `;
      passengerList.appendChild(newPassenger);
    }

    // Redirect on continue
    document.getElementById('passengerForm').addEventListener('submit', function(e) {
      e.preventDefault(); // Optional if you're processing data
      window.location.href = 'payment3.php';
    });
  </script>

</body>
</html>