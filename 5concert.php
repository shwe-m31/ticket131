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
      background: url('arjit2.jpg') center center/cover no-repeat;
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
        background: linear-gradient(to right,rgb(123, 118, 118),rgb(215, 210, 210));
  color: white;
  padding: 18px 48px;
  font-size: 24px;
  border: none;
  border-radius: 0px;
  cursor: pointer;
  font-weight: bold;
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.25);
  
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
      <h1>INDIA TOUR 2025</h1>
      <p><strong>Starring:</strong> Arjit Singh</p>
      <p><strong>Date:</strong> April 27,2025</p>
      <p><strong>Venue:</strong> YMCA Ground,Chennai</p>
      <p><strong>Duration:</strong> 4 Hours</p>
      <p><strong>Tickets:</strong> Rs.2000/-</p>
      <h4>Arijit Singh's India Tour 2025 is a multi-city concert series showcasing his soulful performances across the country.Experience Arijit Singh's enchanting voice</h4>
      <div class="book-now-container">
        <button class="book-now-btn">SEATS FILLED</button>
      </div>
    </div>
  </section>
</body>
</html>