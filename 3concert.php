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
      color: white;
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

    nav li {
      cursor: pointer;
    }


    /* Hero Section */
    .hero {
      height: 100vh;
      background: url('Vijayantony.jpg') center center/cover no-repeat;
      background-color: rgba(0,0,0,0.3);
      background-blend-mode: darken;
      display: flex;
      align-items: center;
      padding: 50px;
    }

    .hero-content {
      max-width: 600px;
    }

    .hero h1 {
      font-size: 48px;
      margin: 10px 0;
    }

    .breadcrumb {
      color: #ffc107;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .legend {
      font-size: 12px;
      padding: 10px;
      background: #fff;
      color: #666;
    }
    .screen {
      background: #ffc107;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      color: #000;
    }
    .summary {
      margin-top: 30px;
    }
    .book-now-container {
  display: flex;
  justify-content: center;
  margin: 60px 0;
}

    .book-now-btn {
        background: linear-gradient(to right, #e52d27, #b31217);
  color: white;
  padding: 18px 48px;
  font-size: 24px;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  font-weight: bold;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.25);
  transition: transform 0.2s, box-shadow 0.2s;
  
}

.book-now-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0px 12px 20px rgba(0, 0, 0, 0.3);
}


  </style>
</head>
<body>
  <header class="navbar">
    <div class="logo"><i>FlexiGo</i></div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <div class="breadcrumb"><i>FlexiGo</i></div>
      <h1>VIJAY ANTONY 2.0</h1>
      <p><strong>Starring:</strong> Vijay Antony</p>
      <p><strong>Date:</strong> July 6,2025</p>
      <p><strong>Venue:</strong> Axiata Arena,Bukit Jalil,Kuala Lumpur</p>
      <p><strong>Tickets:</strong> Rs.1900/-</p>
      <h4>This event promises an upgraded musical experience, bringing back the "OG Vibe" with a blend of his classic hits and new performances.</h4>
      <div class="book-now-container">
        <a href="payment2.php">
        <button class="book-now-btn">Book Now</button>
        </a>
      </div>
    </div>
  </section>
</body>
</html>