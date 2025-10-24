<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Flight Filters</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #0e1218;
      color: white;
      display: flex;
    }

    .filter-container {
      width: 300px;
      background-color: #1a1f27;
      padding: 20px;
      height: 120vh;
      box-shadow: 2px 0 5px rgba(0,0,0,0.2);
    }

    .main-content {
      flex: 1;
      padding: 20px;
    }

    .filter-header {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 20px;
      color: white;
    }

    .filter-group {
      margin-bottom: 25px;
    }

    .filter-group-header {
      font-size: 16px;
      font-weight: bold;
      margin: 20px 0 10px 0;
      color: #aaa;
    }

    .filter-option {
      padding: 12px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #2a3038;
    }

    .filter-option:last-child {
      border-bottom: none;
    }

    .filter-label {
      display: flex;
      align-items: center;
    }

    .filter-price {
      font-weight: bold;
      color: #4CAF50;
    }

    input[type="checkbox"] {
      margin-right: 12px;
      width: 16px;
      height: 16px;
      accent-color: #4CAF50;
    }

    .airline-info {
      display: flex;
      align-items: center;
    }

    .airline-info img {
      width: 24px;
      height: 24px;
      margin: 0 10px;
      object-fit: contain;
    }
  </style>
</head>
<body>

<div class="filter-container">
  <div class="filter-header">Flight Filters</div>

  <div class="filter-group">
    <div class="filter-group-header">Popular Filters</div>
    
    <div class="filter-option">
      <label class="filter-label">
        <input type="checkbox"> Non Stop
      </label>
      
    </div>

    <div class="filter-option">
      <label class="filter-label">
        <input type="checkbox"> Morning Departures
      </label>
      
    </div>

    <div class="filter-option">
      <label class="filter-label">
        <input type="checkbox"> Late Departures
      </label>
      
    </div>

    <div class="filter-option">
      <label class="filter-label">
        <input type="checkbox"> Afternoon Departure
      </label>
      
    </div>

    <div class="filter-option">
      <label class="filter-label">
        <input type="checkbox"> Early Morning Departures
      </label>
      
    </div>
  </div>

  <!-- Airlines Filter -->
  <div class="filter-group">
    <div class="filter-group-header">Airlines</div>

    <div class="filter-option">
      <div class="airline-info">
        <input type="checkbox" id="air-india" />
        <img src="airindia.png" alt="Air India">
        <label for="air-india">Air India</label>
      </div>
      
    </div>

    <div class="filter-option">
      <div class="airline-info">
        <input type="checkbox" id="air-india-express" />
        <img src="express.jpeg" alt="Air India Express">
        <label for="air-india-express">Air India Express</label>
      </div>
      
    </div>

    <div class="filter-option">
      <div class="airline-info">
        <input type="checkbox" id="akasa-air" />
        <img src="Akasa.png" alt="Akasa Air">
        <label for="akasa-air">Akasa Air</label>
      </div>
      
    </div>

    <div class="filter-option">
      <div class="airline-info">
        <input type="checkbox" id="indigo" />
        <img src="indigo.jpeg" alt="IndiGo">
        <label for="indigo">IndiGo</label>
      </div>
      
    </div>

    <div class="filter-option">
      <div class="airline-info">
        <input type="checkbox" id="spicejet" />
        <img src="spicejet.jpeg" alt="SpiceJet">
        <label for="spicejet">SpiceJet</label>
      </div>
     
    </div>
  </div>
</div>

<div class="main-content">

  <!-- Add this code right after your form-container div (around line 200 in your original code) -->
<div class="flight-results-container" style="margin: 2rem auto; max-width: 1000px; background: rgba(255, 255, 255, 0.03); border-radius: 12px; padding: 2rem; backdrop-filter: blur(10px);">
  <!-- Flight Listing -->
  <div class="flight-card" style="background-color: #1e293b; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <div style="display: flex; align-items: center; gap: 12px;">
        <img src="express.jpeg" alt="Air India Express" style="width: 40px; height: 40px; object-fit: contain;">
        <div>
          <div style="font-weight: bold;">Air India Express</div>
          <div style="font-size: 14px; color: #94a3b8;">IX 1178</div>
        </div>
      </div>
      <div style="font-size: 14px; color: #4CAF50;">Non stop</div>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <div style="text-align: center;">
        <div style="font-size: 20px; font-weight: bold;">07:40</div>
        <div style="font-size: 14px;">Ghaziabad</div>
        <div style="font-size: 12px; color: #94a3b8;">(32 KM from New Delhi)</div>
      </div>
      <div style="text-align: center; color: #94a3b8; font-size: 14px;">
        <div>02 h 15 m</div>
        <div style="border-top: 1px dashed #94a3b8; margin: 8px 0; height: 1px;"></div>
      </div>
      <div style="text-align: center;">
        <div style="font-size: 20px; font-weight: bold;">09:55</div>
        <div style="font-size: 14px;">Mumbai</div>
      </div>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #2a3038; padding-top: 12px;">
      <div>
        <div style="font-size: 20px; font-weight: bold;">₹5,931</div>
        <div style="font-size: 12px; color: #94a3b8;">per adult</div>
      </div>
      <div style="display: flex; gap: 12px;">
        <button onclick="window.location.href='11flights.php';"style="background-color: #3b82f6; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">BOOK NOW</button>
      </div>
    </div>
    
    <div style="margin-top: 12px; font-size: 14px; color: #facc15;">
      Lock this price starting from ₹413 →
      <span style="color: white; margin-left: 16px;">Get ₹370 off using MMTPROMO</span>
    </div>
    <div style="font-size: 14px; color: #4CAF50; margin-top: 8px;">30% off on Seats & Baggage</div>
  </div>
  
  <!-- Second Flight Card -->
  <div class="flight-card" style="background-color: #1e293b; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <div style="display: flex; align-items: center; gap: 12px;">
        <img src="indigo.jpeg" alt="IndiGo" style="width: 40px; height: 40px; object-fit: contain;">
        <div>
          <div style="font-weight: bold;">IndiGo</div>
          <div style="font-size: 14px; color: #94a3b8;">6E 2766</div>
        </div>
      </div>
      <div style="font-size: 14px; color: #4CAF50;">Non stop</div>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <div style="text-align: center;">
        <div style="font-size: 20px; font-weight: bold;">03:55</div>
        <div style="font-size: 14px;">New Delhi</div>
      </div>
      <div style="text-align: center; color: #94a3b8; font-size: 14px;">
        <div>02 h 20 m</div>
        <div style="border-top: 1px dashed #94a3b8; margin: 8px 0; height: 1px;"></div>
      </div>
      <div style="text-align: center;">
        <div style="font-size: 20px; font-weight: bold;">06:15</div>
        <div style="font-size: 14px;">Mumbai</div>
      </div>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #2a3038; padding-top: 12px;">
      <div>
        <div style="font-size: 20px; font-weight: bold;">₹6,402</div>
        <div style="font-size: 12px; color: #94a3b8;">per adult</div>
      </div>
      <div style="display: flex; gap: 12px;">
        <button onclick="window.location.href='11flights.php';" style="background-color: #3b82f6; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">BOOK NOW</button>
      </div>
    </div>
    
    <div style="margin-top: 12px; font-size: 14px; color: #4CAF50;">93% on time</div>
    <div style="margin-top: 12px; font-size: 14px; color: #facc15;">
      Lock this price starting from ₹340 →
    </div>
  </div>
</div>
</div>

</body>
</html>