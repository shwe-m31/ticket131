<?php
session_start();
function getCoordinates($cityName) {
    $url = "https://nominatim.openstreetmap.org/search?city=" . urlencode($cityName) . "&format=json";
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'FlexiGoApp/1.0 (shwetham3101@gmail.com)');
    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
        return null;
    }
    curl_close($ch);
    $data = json_decode($response, true);
    if (!empty($data)) {
        return [
            'lat' => $data[0]['lat'],
            'lon' => $data[0]['lon']
        ];
    } else {
        return null;
    }
}

function getCinemasNearCity($lat, $lon) {
    $radius = 10000;
    $query = <<<EOD
[out:json];
node
  [amenity=cinema]
  (around:$radius,$lat,$lon);
out;
EOD;

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => $query,
        ]
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents("https://overpass-api.de/api/interpreter", false, $context);
    $data = json_decode($result, true);
    $cinemas = [];

    if (!empty($data['elements'])) {
        foreach ($data['elements'] as $element) {
            $name = $element['tags']['name'] ?? 'Unnamed Cinema';
            $cinemas[] = [
                'name' => $name
            ];
        }
    }

    return $cinemas;
}

$cinemas = [];
$city = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['city'])) {
    $city = $_POST['city'];
    $coords = getCoordinates($city);
    if ($coords) {
        $cinemas = getCinemasNearCity($coords['lat'], $coords['lon']);
    } else {
        echo "<p style='color: red; text-align: center;'>City not found!</p>";
    }
}
$days = [
  ["day" => "Sat", "date" => "26 APR", "full_date" => "2025-04-26"],
  ["day" => "Sun", "date" => "27 APR", "full_date" => "2025-04-27"],
  ["day" => "Mon", "date" => "28 APR", "full_date" => "2025-04-28"],
  ["day" => "Tue", "date" => "29 APR", "full_date" => "2025-04-29"],
  ["day" => "Wed", "date" => "30 APR", "full_date" => "2025-04-30"],
  ["day" => "Thu", "date" => "1 MAY", "full_date" => "2025-05-01"],
  ["day" => "Fri", "date" => "2 MAY", "full_date" => "2025-05-02"],
  ["day" => "Sat", "date" => "3 MAY", "full_date" => "2025-05-03"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FlexiGo-BookMyShow</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General Reset and Body */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      font-family: 'Segoe UI', sans-serif;
      background-color: #0a1628;
      color:white;
      height: 100%;
      overflow-x: hidden;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: #111;
    }

    .logo {
      font-weight: bold;
      font-size: 24px;
      color: #ffc107;
    }


    .search input {
      padding: 5px 10px;
      border-radius: 4px;
      border: none;
    }

    /* Hero Section */
    .hero {
      height: 100vh;
      background: url('ingentlewoman.jpg') center center/cover no-repeat;
      background-color: rgba(0,0,0,0.5);
      background-blend-mode: darken;
      display: flex;
      align-items: center;
      padding: 50px;
    }

    .hero-content {
      max-width: 600px;
    }

    .hero h1 {
      color: rgb(164, 4, 4);
      font-size: 48px;
      margin: 10px 0;
    }

    .breadcrumb {
      color: #ffc107;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .ratings {
      font-size: 14px;
      margin-bottom: 10px;
    }

    
    /* Filters */
    .filters {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin: 20px;
    }

    select, input[type="date"], input[type="text"] {
      padding: 8px;
      background: #222;
      border: 1px solid #444;
      color: white;
      border-radius: 4px;
    }

    /* Date Bar */
    .date-bar {
      display: flex;
      overflow-x: auto;
      background: #0d1b2a;
      color: white;
      border-bottom: 1px solid #ddd;
    }

    .date {
      padding: 15px;
      text-align: center;
      min-width: 80px;
      cursor: pointer;
      color: #666;
    }

    .date:hover {
      background-color: #333;
    }

    .date.active {
      background: #ffc107;
      color: white;
      font-weight: bold;
    }

    
    .dynamic-theater {
      background: #1a1a2e;
      margin: 15px 20px;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(255, 255, 255, 0.05);
    }

    .dynamic-theater h4 {
      margin: 0;
      color: #ffc107;
    }

    .showtimes {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .showtime {
      border: 1px solid #28a745;
      color: #e9f9ee;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      background-color: #28a745;
    }

  </style>
</head>
<body>
  <header class="navbar">
    <div class="logo"><i>FlexiGo</i></div>
    <div class="search">
      <form method="POST" style="display: flex; gap: 10px;">
        <input type="text" name="city" placeholder="Enter city name" required>
        <button type="submit" style="padding: 6px 12px; background: #ffc107; border: none; border-radius: 4px; cursor: pointer;">Search</button>
      </form>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <div class="breadcrumb"><i>FlexiGo</i></div>
      <h1>GENTLEWOMAN</h1>
      <div class="ratings">⭐ 4.7 (IMDB) | ⏱ 1hr 53mins</div>
      <p>A married woman's husband mysteriously disappears, leading to revelations of his affair with a client. As authorities investigate, tensions rise between the two women amid growing suspicions.</p>
      <p><strong style="color: rgb(38, 33, 33) ">Release Date:</strong>MARCH 07,2025</p>
      <p><strong style="color: rgb(38, 33, 33)">Cast:</strong> Lijomol Jose, Hari Krishnan,Losliya Mariyanesan</p>
      <p><strong style="color: rgb(38, 33, 33)">Genre:</strong> Drama, Mystery, Thriller</p>
      
    </div>
  </section>

  <div class="date-bar">
  <?php foreach ($days as $i => $day): ?>
      <div class="date <?= $i === 0 ? 'active' : '' ?>" 
           data-day="<?= $day['day'] ?>" 
           data-date="<?= $day['date'] ?>"
           data-full-date="<?= $day['full_date'] ?>">
        <?= $day['day'] ?><br><?= $day['date'] ?>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="filters">
  <select id="price-filter">
      <option value="">Price Range</option>
      <option value="100-200">₹100 - ₹200</option>
      <option value="200-300">₹200 - ₹300</option>
      <option value="300-500">₹300 - ₹500</option>
    </select>
    <select id="time-filter">
      <option value="">Preferred Time</option>
      <option value="10:00 AM">Morning Marvells</option>
      <option value="01:00 PM">Midday Magic</option>
      <option value="04:00 PM">Evening Elegance</option>
      <option value="07:00 PM">Starlight Series</option>
    </select>
    <input type="text" id="search-bar" placeholder="Search..." />
  </div>
  <?php
  $showtimes = ["10:00 AM", "01:00 PM", "04:00 PM", "07:00 PM"];
  $priceMap = [
    'Theatre' => 350,
    'multiplex' => 250,
    'INOX' => 120,
    'Satyam' => 200,
    'PVR' => 300,
    'cinemas' => 220
  ];

  if (!empty($cinemas)): ?>
    <div style='padding: 20px;'>
      <h2 style='color: #ffc107;'>Cinemas found in <?= htmlspecialchars($city) ?>:</h2>
      <?php foreach ($cinemas as $cinema):
        $price = 200;
        foreach ($priceMap as $keyword => $mappedPrice) {
          if (stripos($cinema['name'], $keyword) !== false) {
              $price = $mappedPrice;
              break;
          }
        } ?>
        <div class='dynamic-theater' data-price='<?= $price ?>'>
          <h4><?= htmlspecialchars($cinema['name']) ?></h4>
          <div class='showtimes'>
            <?php foreach ($showtimes as $time): ?>
              <a href="#" class="showtime" data-time="<?= $time ?>"><?= $time ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div style='padding: 20px;'>
    <h2 style='color: #ffc107;'>Popular Theaters:</h2>
    <?php 
    $staticTheatres = ["KAILASH PRAKASH", "ARRS MULTIPLEX", "AASCARS CINEMAS", "SANGEETH THEATRE"];
    foreach ($staticTheatres as $theatre): ?>
      <div class='dynamic-theater' data-price='300'>
        <h4><?= $theatre ?></h4>
        <div class='showtimes'>
          <?php foreach ($showtimes as $time): ?>
            <a href="#" class="showtime" data-time="<?= $time ?>"><?= $time ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  ?>
  <script>
    let selectedDateData = {
      day: '<?= $days[0]['day'] ?>',
      date: '<?= $days[0]['date'] ?>',
      full_date: '<?= $days[0]['full_date'] ?>'
    };

    document.addEventListener('DOMContentLoaded', function() {
      // Date selection
      document.querySelectorAll('.date').forEach(date => {
        date.addEventListener('click', function() {
          document.querySelectorAll('.date').forEach(d => d.classList.remove('active'));
          this.classList.add('active');
          
          selectedDateData = {
            day: this.dataset.day,
            date: this.dataset.date,
            full_date: this.dataset.fullDate
          };
        });
      });

      // Showtime selection
      document.querySelectorAll('.showtime').forEach(showtime => {
        showtime.addEventListener('click', function(e) {
          e.preventDefault();
          const theatre = this.closest('.dynamic-theater').querySelector('h4').textContent;
          const time = this.dataset.time;
          
          window.location.href = `seats.php?theatre=${encodeURIComponent(theatre)}&time=${encodeURIComponent(time)}&movie=GENTLE%20WOMAN&day=${selectedDateData.day}&date=${encodeURIComponent(selectedDateData.date)}&full_date=${selectedDateData.full_date}`;
        });
      });

      // Filters
      document.getElementById('price-filter').addEventListener('change', function() {
        const [min, max] = this.value ? this.value.split('-').map(Number) : [0, Infinity];
        document.querySelectorAll('.dynamic-theater').forEach(theatre => {
          const price = parseInt(theatre.dataset.price);
          theatre.style.display = (!this.value || (price >= min && price <= max)) ? 'block' : 'none';
        });
      });

      document.getElementById('time-filter').addEventListener('change', function() {
        const selectedTime = this.value;
        document.querySelectorAll('.dynamic-theater').forEach(theatre => {
          const matches = [...theatre.querySelectorAll('.showtime')].some(st => st.dataset.time === selectedTime);
          theatre.style.display = (!selectedTime || matches) ? 'block' : 'none';
        });
      });

      document.getElementById('search-bar').addEventListener('input', function() {
        const value = this.value.toLowerCase();
        document.querySelectorAll('.dynamic-theater').forEach(theatre => {
          const name = theatre.querySelector('h4').textContent.toLowerCase();
          theatre.style.display = name.includes(value) ? 'block' : 'none';
        });
      });
    });
  </script>  
</body>
</html>