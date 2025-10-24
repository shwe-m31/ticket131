<?php
  session_start();
  $client_id = '8MQRw1xkLZ7JDWYkJNFtHEarLtlswFhG';
  $client_secret = 'WgqSXwL4jvl8pE2K';

  $originCity = $_GET['origin'] ?? '';
  $destinationCity = $_GET['destination'] ?? '';
  $departureDate = $_GET['departureDate'] ?? '';
  $results = null;
  $showResults = false;

  if (!empty($originCity) && !empty($destinationCity) && !empty($departureDate)) {
    $token = getAccessToken($client_id, $client_secret);
    if ($token) {
        $origin = getIATACode($originCity, $token);
        $destination = getIATACode($destinationCity, $token);
        if ($origin && $destination) {
            $results = getFlights($origin, $destination, $departureDate, $token);
            $showResults = true;
        }
    }
  }

  function getAirlineName($code) {
      $airlines = [
          "AI" => "Air India",
          "6E" => "IndiGo",
          "UK" => "Vistara",
          "SG" => "SpiceJet",
          "G8" => "Go First",
          "IX" => "Air India Express",
          "I5" => "AirAsia India"
      ];
      return $airlines[$code] ?? $code;
  }
  function getAirportName($cityName, $token = null) {
    $airports = [
        'Delhi' => 'Indira Gandhi International Airport (DEL)',
        'Mumbai' => 'Chhatrapati Shivaji Maharaj International Airport (BOM)',
        'Chennai' => 'Chennai International Airport (MAA)',
        'Bangalore' => 'Kempegowda International Airport (BLR)',
        'Hyderabad' => 'Rajiv Gandhi International Airport (HYD)',
        'Kolkata' => 'Netaji Subhash Chandra Bose International Airport (CCU)',
        // Add more airports as needed
        'Pune' => 'Pune International Airport (PNQ)',
        'Goa' => 'Dabolim Airport (GOI)',
        'Jaipur' => 'Jaipur International Airport (JAI)'
    ];
    
    // Case-insensitive match and trim whitespace
    $cityName = trim($cityName);
    foreach ($airports as $key => $value) {
        if (strcasecmp($key, $cityName) === 0) {
            return $value;
        }
    }
    
    // Fallback for unknown cities
    return $cityName;
    }

  function getAirlineLogo($code) {
      $logos = [
          "AI" => "https://upload.wikimedia.org/wikipedia/en/thumb/f/fb/Air_India_Logo.svg/100px-Air_India_Logo.svg.png",
          "6E" => "https://upload.wikimedia.org/wikipedia/commons/thumb/2/20/IndiGo_Logo.svg/100px-IndiGo_Logo.svg.png",
          "IX" => "https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/Air_India_Express_Logo.svg/100px-Air_India_Express_Logo.svg.png",
          "SG" => "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/SpiceJet_logo.svg/100px-SpiceJet_logo.svg.png",
          "UK" => "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f2/Vistara_Logo.svg/100px-Vistara_Logo.svg.png"
      ];
      return $logos[$code] ?? "https://via.placeholder.com/40";
  }

  function getAccessToken($client_id, $client_secret) {
      $url = "https://test.api.amadeus.com/v1/security/oauth2/token";
      $data = [
          "grant_type" => "client_credentials",
          "client_id" => $client_id,
          "client_secret" => $client_secret
      ];

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);
      $json = json_decode($response, true);
      return $json['access_token'] ?? null;
  }

  function getIATACode($city, $token) {
      $url = "https://test.api.amadeus.com/v1/reference-data/locations?subType=CITY&keyword=" . urlencode($city);
      $headers = ["Authorization: Bearer $token"];

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
      curl_close($ch);

      $result = json_decode($response, true);
      return $result['data'][0]['iataCode'] ?? null;
  }

  function getFlights($origin, $destination, $departureDate, $token) {
      $url = "https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=$origin&destinationLocationCode=$destination&departureDate=$departureDate&adults=1&nonStop=false&max=10";
      $headers = ["Authorization: Bearer $token"];

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);
      return json_decode($response, true);
  }
  function getAirportDetailsForCity($cityName, $token) {
    // Check if we have it cached in session
    if (isset($_SESSION['city_airports'][$cityName])) {
        return $_SESSION['city_airports'][$cityName];
    }
    
    // First search for the city to get its IATA code
    $citySearchUrl = "https://test.api.amadeus.com/v1/reference-data/locations?subType=CITY&keyword=" . urlencode($cityName);
    $headers = ["Authorization: Bearer $token"];
    
    $ch = curl_init($citySearchUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $cityResponse = curl_exec($ch);
    curl_close($ch);
    
    $cityData = json_decode($cityResponse, true);
    $cityIata = $cityData['data'][0]['iataCode'] ?? null;
    
    if (!$cityIata) {
        return ['name' => $cityName, 'iata' => '']; // Fallback to city name
    }
    
    // Now search airports for this city
    $airportUrl = "https://test.api.amadeus.com/v1/reference-data/locations?subType=AIRPORT&cityCode=" . urlencode($cityIata);
    $ch = curl_init($airportUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $airportResponse = curl_exec($ch);
    curl_close($ch);
    
    $airportData = json_decode($airportResponse, true);
    
    if (isset($airportData['data'][0]['name'])) {
        $result = [
            'name' => $airportData['data'][0]['name'],
            'iata' => $airportData['data'][0]['iataCode']
        ];
        $_SESSION['city_airports'][$cityName] = $result;
        return $result;
    }
    
    // Fallback to city name if no airport found
    return ['name' => $cityName, 'iata' => ''];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlexiGo - BookMyTickets</title>
  <link rel="icon" href="flexigo2.png" type="image/png">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      position: relative;
      background-color: #0e1218;
      color: white;
      min-height: 100vh;
      overflow-x: hidden;
    }

    nav {
      background-color: #0f172a;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #1e293b;
    }

    .logo {
      font-size: 24px;
      color: #facc15;
      font-weight: bold;
    }

    .nav-links {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
    }

    .nav-links a.active {
      color: #3b82f6;
    }


    .sign-up-btn {
      background-color: white;
      color: black;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .hero {
      text-align: center;
      padding: 40px;
      background: url('aeroplane3.jpg');
      background-blend-mode: darken;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: white;
    }

    .hero h1 {
      font-size: 48px;
    }

    .breadcrumb {
      color: #94a3b8;
      font-size: 14px;
      margin-top: 10px;
    }

    .categories {
      text-align: center;
      margin: 30px 0;
    }

    .categories {
  text-align: center;
  margin: 30px 0;
}

.categories a {
  background-color: #1e293b;
  color: white;
  border: none;
  padding: 10px 20px;
  margin: 5px;
  border-radius: 999px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  transition: background-color 0.3s, color 0.3s;
}

.categories a.active,
.categories a:hover {
  background-color: #facc15;
  color: black;
  font-weight: bold;
}

    /* Flight Booking Section */
    .form-container {
      background: rgba(255, 255, 255, 0.03);
      padding: 2rem;
      border-radius: 12px;
      backdrop-filter: blur(10px);
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
      margin: 2rem auto;
      max-width: 1000px;
    }
    .form-container h1,
    .form-container h2 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
    }
    
    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form input[type="phonenumber"],
    form input[type="date"] {
      width: 100%;
      padding: 0.9rem;
      border: none;
      border-radius: 8px;
      background: #2a2f3a;
      color: #fff;
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }

    .primary-btn {
      padding: 0.9rem 1.5rem;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      font-size: 1rem;
      background: #facc15;
      color: black;
    }
    .booking-section h2 {
      margin-bottom: 1rem;
    }
    .trip-type {
      display: flex;
      gap: 24px;
      margin-bottom: 24px;
    }

    .trip-type label {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
    }

    .trip-type input[type="radio"] {
      accent-color: #facc15;
    }

    .trip-type .selected {
      color: white;
      font-weight: bold;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 16px;
      border: 1px solid #3a3a3a;
      padding: 24px;
      border-radius: 8px;
      background-color: rgba(255,255,255,0.05);
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 4px;
      color: #ddd;
      font-size: 0.85rem;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 8px 12px;
      border: none;
      background-color: #2a2f3a;
      color: #fff;
      border-radius: 6px;
    }
    #multiCityContainer .form-grid {
    margin-top: 1rem;
    }

    .search-button {
      text-align: left;
    }

    .search-button button {
      background-color: #facc15;
      color: black;
      font-weight: 600;
      padding: 10px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    /* Grid Section */
    .anime-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 30px;
      padding: 0 40px 60px;
    }

    .anime-card {
      background-color: #1e293b;
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.2s ease;
    }

    .anime-card:hover {
      transform: scale(1.05);
    }

    .anime-card img {
      width: 100%;
      height: 260px;
      object-fit: cover;
    }

    .anime-info {
      padding: 15px;
    }

    .anime-title {
      font-size: 16px;
      font-weight: bold;
    }

    .anime-date {
      font-size: 12px;
      color: #94a3b8;
      margin-top: 5px;
    }

    .stars {
      color: #facc15;
      margin-top: 8px;
    }
    .traveller-popup {
      display: none;
      position: absolute;
      background-color: #1e293b;
      border-radius: 8px;
      padding: 20px;
      width: 300px;
      z-index: 100;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    
    .traveller-popup h3 {
      margin-bottom: 15px;
      font-size: 16px;
      color: #ddd;
    }
    
    .traveller-category {
      margin-bottom: 20px;
    }
    
    .traveller-category .title {
      font-size: 14px;
      color: #aaa;
      margin-bottom: 5px;
    }
    
    .traveller-category .subtitle {
      font-size: 12px;
      color: #666;
      margin-bottom: 10px;
    }
    
    .counter {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .counter button {
      background-color: #2a2f3a;
      color: white;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
    }
    
    .counter span {
      width: 30px;
      text-align: center;
    }
    
    .class-options {
      margin-top: 20px;
    }
    
    .class-option {
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 8px;
      cursor: pointer;
    }
    
    .class-option:hover {
      background-color: #2a2f3a;
    }
    
    .class-option.selected {
      background-color: #3b82f6;
    }
    
    .apply-btn {
      background-color: #facc15;
      color: black;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      margin-top: 20px;
      cursor: pointer;
      font-weight: bold;
      width: 100%;
    }
    
    /* Make the select element clickable */
    .traveller-select {
      cursor: pointer;
    }
    .profile-container {
      position: relative;
    }
    .profile-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.profile-icon img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
    .dropdown-menu {
      position: absolute;
      top: 50px;
      right: 0;
      background-color: rgb(10, 20, 22);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      width: 220px;
      padding: 10px 0;
      display: none;
      z-index: 100;
    }
    .dropdown-menu.active {
      display: block;
    }

    .dropdown-item {
      padding: 10px 20px;
      cursor: pointer;
      transition: background 0.2s ease;
    }
    .dropdown-item:hover {
      background-color: #94cbf5;
    }

    .divider {
      height: 1px;
      background-color: #e0e0e0;
      margin: 5px 0;
    }
    .content {
      padding: 2rem;
    }

    /* Flight Results Styles */
    .flight-list {
      max-width: 900px;
      margin: 0 auto;
    }

    .flight-card {
      background: #1f2937;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.4);
    }

    .btn {
      background: #3b82f6;
      color: white;
      padding: 10px 16px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      text-align: center;
      display: inline-block;
    }

    .green {
      color: #22c55e;
      font-weight: bold;
    }

    .yellow {
      color: #eab308;
      font-weight: bold;
      margin-top: 4px;
    }

    .price {
      font-size: 22px;
      color: #fbbf24;
      margin-top: 6px;
    }

    .subtext {
      font-size: 13px;
      color: #9ca3af;
    }

    h3 {
      font-size: 18px;
      margin: 0;
    }

    #time-filters {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
      margin: 0 auto 30px auto;
      padding: 15px 20px;
      max-width: 900px;
      border-radius: 12px;
    }

    #time-filters .filter-btn {
      padding: 12px 24px;
      margin: 0 8px 10px 8px;
      background: #374151;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: all 0.3s ease;
      font-size: 14px;
    }

    #time-filters .filter-btn:hover,
    #time-filters .filter-btn.active {
      background: #4b5563;
      transform: translateY(-2px);
    }

    .results-title {
      text-align: center;
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .no-results {
      text-align: center;
      padding: 40px;
      font-size: 18px;
      color: #94a3b8;
    }
  </style>
</head>
<body>

  <nav>
    <div class="logo"><i>FlexiGo</i></div>
    <div class="nav-links">
    <div class="profile-container">
        <div class="profile-icon" id="profileIcon">
          <img src="profile.jpg" alt="Profile Picture">
        </div>        
        <div class="dropdown-menu" id="dropdownMenu">
          <div class="dropdown-item"><i>Shri..!</i></div>
          <div class="dropdown-item">Edit Profile</div>
          <div class="dropdown-item">Booking History</div>
          <div class="divider"></div>
          <div class="dropdown-item">Settings</div>
          <div class="divider"></div>
          <div class="dropdown-item" id="logoutBtn">Log out</div>
        </div>
      </div>
    </div>
  </nav>
    </div>
  </nav>

  <div class="hero">
    <h1><b>INFINITE JOURNEYS</b><br><i>From Big Screen To Big Dreams</i></h1>
    <div class="breadcrumb">Tickets to thrill</div>
  </div>

  <div class="categories">
    <a href="movies.php" >Movies</a>
    <a href="concerts.php">Concerts</a>
    <a href="flights.php" class="active">Flights</a>
  </div>
  <div class="overlay"></div>
  <div class="container">
    <!-- Navbar -->
    <!-- Flight Booking Section -->
    <div class="form-container booking-section">
      <h2>Book a Flight</h2>
      <form action="flights.php" method="get">
      <div class="trip-type">
        <label>
          <input type="radio" name="tripType" value="oneway" checked onchange="toggleExtraRow()" />
          <span class="selected">One Way</span>
        </label>
        <label>
          <input type="radio" name="tripType" value="roundtrip" onchange="toggleExtraRow()" />
          <span>Round Trip</span>
        </label>
        <label>
          <input type="radio" name="tripType" value="multicity" onchange="toggleExtraRow()" />
          <span>Multi City</span>
          
        </label>
      </div><br>
        <!-- First Row -->
        <div class="form-grid">
          <div class="form-group">
            <label>From</label>
            <input type="text" name="origin" placeholder="Enter City or Airport" value="<?= htmlspecialchars($_GET['origin'] ?? '') ?>" required />
          </div>
          <div class="form-group">
            <label>To</label>
            <input type="text" name="destination" placeholder="Enter City or Airport" value="<?= htmlspecialchars($_GET['destination'] ?? '') ?>" required />
          </div>
          <div class="form-group">
            <label>Departure Date</label>
            <input type="date" name="departureDate" value="<?= htmlspecialchars($_GET['departureDate'] ?? '') ?>" required />
          </div>
          <div class="form-group">
            <label>Travellers</label>
            <select class="traveller-select" onclick="showTravellerPopup()">
              <option>Select</option>
            </select>
            <div class="traveller-popup" id="travellerPopup">
              <h3>Travellers</h3>
              
              <div class="traveller-category">
                <div class="title">ADULTS (12y +)</div>
                <div class="subtitle">on the day of travel</div>
                <div class="counter">
                  <button type="button" onclick="changeCount('adults', -1)">-</button>
                  <span id="adultsCount">1</span>
                  <button type="button" onclick="changeCount('adults', 1)">+</button>
                </div>
              </div>
              
              <div class="traveller-category">
                <div class="title">CHILDREN (2y - 12y)</div>
                <div class="subtitle">on the day of travel</div>
                <div class="counter">
                  <button type="button" onclick="changeCount('children', -1)">-</button>
                  <span id="childrenCount">0</span>
                  <button type="button" onclick="changeCount('children', 1)">+</button>
                </div>
              </div>
              
              <div class="traveller-category">
                <div class="title">INFANTS (below 2y)</div>
                <div class="subtitle">on the day of travel</div>
                <div class="counter">
                  <button type="button" onclick="changeCount('infants', -1)">-</button>
                  <span id="infantsCount">0</span>
                  <button type="button" onclick="changeCount('infants', 1)">+</button>
                </div>
              </div>
              
              <div class="class-options">
                <h3>CHOOSE TRAVEL CLASS</h3>
                <div class="class-option selected" onclick="selectClass(this, 'Economy/Premium Economy')">Economy/Premium Economy</div>
                <div class="class-option" onclick="selectClass(this, 'Premium Economy')">Premium Economy</div>
                <div class="class-option" onclick="selectClass(this, 'Business')">Business</div>
                <div class="class-option" onclick="selectClass(this, 'First Class')">First Class</div>
              </div>
              
              <button type="button" class="apply-btn" onclick="applyTravellerSelection()">APPLY</button>
          </div>
        </div>

        <!-- Second Row (Initially Hidden) -->
        <div class="form-grid" id="extraRow" style="display: none;">
          <div class="form-group">
            <label>From</label>
            <input type="text" placeholder="Enter City or Airport" />
          </div>
          <div class="form-group">
            <label>To</label>
            <input type="text" placeholder="Enter City or Airport" />
          </div>
          <div class="form-group">
            <label>Departure Date</label>
            <input type="date" />
          </div>
          <div class="form-group">
            <label>Travellers & Class</label>
            <select>
              <option>1 Traveller - Economy</option>
              <option>2 Travellers - Economy</option>
              <option>1 Traveller - Premium Economy</option>
              <option>1 Traveller - Business</option>
            </select>
          </div>
        </div>

        <div class="search-button" id="addCityButton" style="display: none; margin-bottom: 1rem;">
          <button type="button" onclick="addCityRow()">+ Add City</button>
        </div>
        <div id="multiCityContainer"></div>
        <div class="search-button">
          <button type="submit" class="search-flights-button">Search Flights</button>
        </div>
      </form>
    </div>
  </div>
  
  
<?php if ($showResults): ?>
  <h2 class="results-title">Available Flights from <?= htmlspecialchars($originCity) ?> to <?= htmlspecialchars($destinationCity) ?> on <?= htmlspecialchars($departureDate) ?></h2>
  <div id="time-filters">
    <button class="filter-btn active" data-range="all">All</button>
    <button class="filter-btn" data-range="morning">Morning (6 AM - 12 PM)</button>
    <button class="filter-btn" data-range="afternoon">Afternoon (12 PM - 6 PM)</button>
    <button class="filter-btn" data-range="evening">Evening (6 PM - 9 PM)</button>
    <button class="filter-btn" data-range="night">Night (9 PM - 6 AM)</button>
  </div>
  <div class="flight-list">
  <?php
  if (!$results || empty($results['data'])) {
      echo "<div class='no-results'>No flights found. Please try different search criteria.</div>";
  } else {
      foreach ($results['data'] as $flight) {
          $segment = $flight['itineraries'][0]['segments'][0];
          $departure = $segment['departure']['at'];
          $arrival = $segment['arrival']['at'];
          $carrier = $segment['carrierCode'];
          $flightNumber = $segment['number'];
          $duration = str_replace(['PT', 'H', 'M'], ['','h ','m'], $flight['itineraries'][0]['duration']);
          $airlineName = getAirlineName($carrier);
          $logo = getAirlineLogo($carrier);
          $randomPrice = rand(4000, 8500);
          $discount = rand(200, 500);
          $hour = (int) date("H", strtotime($departure));

          $departureInfo = getAirportDetailsForCity($originCity, $token);
          $arrivalInfo = getAirportDetailsForCity($destinationCity, $token);
          
          echo "<!-- DEBUG: ".htmlspecialchars($originCity)." => ".getAirportName($originCity)." -->";
          echo "<!-- DEBUG: ".htmlspecialchars($destinationCity)." => ".getAirportName($destinationCity)." -->";
          echo "<div class='flight-card' data-departure-hour='$hour'>";
          echo "<div style='display: flex; justify-content: space-between; align-items: center;'>";

          echo "<div style='display: flex; align-items: center; gap: 12px;'>";
          echo "<img src='$logo' alt='$airlineName Logo' width='40'>";
          echo "<div><h3>$airlineName</h3><div class='subtext'>$carrier $flightNumber</div></div>";
          echo "</div>";

          echo "<div class='green' style='font-size: 14px;'>Non stop</div>";
          echo "</div>";

          echo "<div style='display: flex; justify-content: space-between; margin-top: 14px;'>";
          echo "<div><strong style='font-size: 20px;'>" . date("H:i", strtotime($departure)) . "</strong><div class='subtext'>" . htmlspecialchars($originCity) . "</div></div>";
          echo "<div class='subtext' style='align-self: center;'>$duration</div>";
          echo "<div style='text-align: right;'><strong style='font-size: 20px;'>" . date("H:i", strtotime($arrival)) . "</strong><div class='subtext'>" . htmlspecialchars($destinationCity) . "</div></div>";
          echo "</div>";

          echo "<div style='margin-top: 18px; display: flex; justify-content: space-between; align-items: center;'>";
          echo "<div>";
          echo "<div class='price'>₹$randomPrice <span class='subtext'>per adult</span></div>";
          echo "<div class='yellow'>Get ₹$discount off using <strong>FLEXIDEAL</strong></div>";
          echo "</div>";
          echo "<a class='btn' href='passengers.php'>BOOK NOW</a>";
          echo "</div>";
          echo "</div>";
      }
  }
  ?>
  </div>
<?php endif; ?>


  <h2 style="margin-left: 60px; margin-top: 60px; margin-bottom: 25px;font-size: 32px; color: white;">Pure Paradise</h2>
  <!-- Destination Cards -->
  <div class="anime-grid">
    <div class="anime-card">
      <img src="flight3.avif" alt="Maldives">
      <div class="anime-info">
        <div class="anime-title">Maldives</div>
        <div class="anime-date">Global destination</div>
        <div class="stars">⭐⭐⭐⭐⭐</div>
      </div>
    </div>
    <div class="anime-card">
      <img src="flight 2.webp" alt="Bali">
      <div class="anime-info">
        <div class="anime-title">Bali</div>
        <div class="anime-date">Global destination</div>
        <div class="stars">⭐⭐⭐⭐</div>
      </div>
    </div>
    <div class="anime-card">
      <img src="flight 6.jpg" alt="India Gate">
      <div class="anime-info">
        <div class="anime-title">India Gate</div>
        <div class="anime-date">Domestic destination</div>
        <div class="stars">⭐⭐⭐⭐</div>
      </div>
    </div>
    <div class="anime-card">
      <img src="flight 5.jpg" alt="Taj Mahal">
      <div class="anime-info">
        <div class="anime-title">Taj Mahal</div>
        <div class="anime-date">Domestic destination</div>
        <div class="stars">⭐⭐⭐⭐⭐</div>
      </div>
    </div>
    <div class="anime-card">
      <img src="flight 4.webp" alt="Singapore">
      <div class="anime-info">
        <div class="anime-title">Singapore</div>
        <div class="anime-date">Global destination</div>
        <div class="stars">⭐⭐⭐⭐</div>
      </div>
    </div>
  </div>
  <script>
    const currentPage = window.location.pathname.split('/').pop();
    document.querySelectorAll('.categories a').forEach(link => {
      if (link.getAttribute('href') === currentPage) {
        link.classList.add('active');
      }
    });
    function toggleExtraRow() {
        const selectedTrip = document.querySelector('input[name="tripType"]:checked').value;
        const extraRow = document.getElementById("extraRow");
        const addCityButton = document.getElementById("addCityButton");
        const multiCityContainer = document.getElementById("multiCityContainer");

        if (selectedTrip === "roundtrip") {
          extraRow.style.display = "grid";
          addCityButton.style.display = "none";
          multiCityContainer.innerHTML = ""; // Clear multicity rows
        } else if (selectedTrip === "multicity") {
          extraRow.style.display = "none";
          addCityButton.style.display = "block";
        } else {
          extraRow.style.display = "none";
          addCityButton.style.display = "none";
          multiCityContainer.innerHTML = ""; // Clear multicity rows
        }
    }

    function addCityRow() {
        const container = document.getElementById("multiCityContainer");
        const newRow = document.createElement("div");
        newRow.className = "form-grid";
        newRow.innerHTML = `
          <div class="form-group">
            <label>From</label>
            <input type="text" placeholder="Enter City or Airport" />
          </div>
          <div class="form-group">
            <label>To</label>
            <input type="text" placeholder="Enter City or Airport" />
          </div>
          <div class="form-group">
            <label>Departure Date</label>
            <input type="date" />
          </div>
          <div class="form-group">
            <label>Travellers & Class</label>
            <select>
              <option>1 Traveller - Economy</option>
              <option>2 Travellers - Economy</option>
              <option>1 Traveller - Premium Economy</option>
              <option>1 Traveller - Business</option>
            </select>
          </div>
        `;
        container.appendChild(newRow);
    }

    // Initialize the page
    document.addEventListener("DOMContentLoaded", toggleExtraRow);
    function showTravellerPopup() {
        const popup = document.getElementById('travellerPopup');
        popup.style.display = 'block';
        event.stopPropagation(); // Prevent immediate closing
    }

    function hideTravellerPopup() {
        document.getElementById('travellerPopup').style.display = 'none';
    }

    function changeCount(type, change) {
        const countElement = document.getElementById(`${type}Count`);
        let count = parseInt(countElement.textContent);
        count += change;
        
        // Set minimum and maximum values
        if (type === 'adults') {
            count = Math.max(1, Math.min(9, count));
        } else {
            count = Math.max(0, Math.min(6, count));
        }
        
        countElement.textContent = count;
    }

    function selectClass(element, className) {
        // Remove selected class from all options
        document.querySelectorAll('.class-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        element.classList.add('selected');
        selectedClass = className;
    }

    function applyTravellerSelection() {
        const adults = document.getElementById('adultsCount').textContent;
        const children = document.getElementById('childrenCount').textContent;
        const infants = document.getElementById('infantsCount').textContent;
        const classOption = document.querySelector('.class-option.selected').textContent;
        
        // Calculate total travellers
        const total = parseInt(adults) + parseInt(children) + parseInt(infants);
        const travellerText = total === 1 ? '1 Traveller' : `${total} Travellers`;
        
        // Update the select display
        document.querySelector('.traveller-select').innerHTML = `
            <option>${travellerText} - ${classOption}</option>
        `;
        
        hideTravellerPopup();
    }

    // Close popup when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.traveller-popup') && !event.target.closest('.traveller-select')) {
            hideTravellerPopup();
        }
    });
    const profileIcon = document.getElementById('profileIcon');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileIcon.addEventListener('click', () => {
        dropdownMenu.classList.toggle('active');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (event) => {
        if (!event.target.closest('.profile-container')) {
            dropdownMenu.classList.remove('active');
        }
    });
    document.getElementById("logoutBtn").addEventListener("click", function () {
        // Optional: clear auth/session data if needed
        // localStorage.clear();
        // sessionStorage.clear();

        // Redirect to login.html
        window.location.href = "login.php";
    });

    // Time filters functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const range = btn.dataset.range;
            const flights = document.querySelectorAll('.flight-card');

            flights.forEach(card => {
                const hour = parseInt(card.dataset.departureHour);
                let show = true;

                switch (range) {
                    case 'morning':
                        show = hour >= 6 && hour < 12;
                        break;
                    case 'afternoon':
                        show = hour >= 12 && hour < 18;
                        break;
                    case 'evening':
                        show = hour >= 18 && hour < 21;
                        break;
                    case 'night':
                        show = hour >= 21 || hour < 6;
                        break;
                    case 'all':
                    default:
                        show = true;
                }

                card.style.display = show ? 'block' : 'none';
            });
        });
    });
    function toggleExtraRow() {
    // Safely get the selected radio button
    const selectedRadio = document.querySelector('input[name="tripType"]:checked');
    
    // If no radio is selected (shouldn't happen with default checked), return early
    if (!selectedRadio) return;
    
    const selectedTrip = selectedRadio.value;
    const extraRow = document.getElementById("extraRow");
    const addCityButton = document.getElementById("addCityButton");
    const multiCityContainer = document.getElementById("multiCityContainer");

    if (selectedTrip === "roundtrip") {
        extraRow.style.display = "grid";
        addCityButton.style.display = "none";
        multiCityContainer.innerHTML = "";
    } else if (selectedTrip === "multicity") {
        extraRow.style.display = "none";
        addCityButton.style.display = "block";
    } else {
        extraRow.style.display = "none";
        addCityButton.style.display = "none";
        multiCityContainer.innerHTML = "";
    }
}
  </script>
</body>
</html>