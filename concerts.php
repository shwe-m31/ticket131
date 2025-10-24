<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlexiGo-BookMyTickets</title>
  <link rel="icon" href="flexigo2.png" type="image/png">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #0f172a;
      color: white;
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
      color:#facc15;
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
      background: url('crowd2.jpg') center/cover no-repeat;
      background-color: rgba(0,0,0,0.6);
      background-blend-mode: darken;
    }

    .hero h1 {
      font-size: 48px;
      margin: 0;
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
    <a href="flights.php">Flights</a>
  </div>

  <h2 style="margin-left: 60px; margin-top: 60px; margin-bottom: 25px;font-size: 32px; color: white;">Upcoming Concerts...</h2>
  <div class="anime-grid">
  <a href="1concert.php" style="text-decoration: none; color: inherit;">
    <div class="anime-card">
      <img src="music 8.jpg" alt="Anime 1">
      <div class="anime-info">
        <div class="anime-title">Hukum World Tour</div>
        <div class="anime-date">May 31,2025</div>
        <div class="stars">Bengaluru</div>
      </div>
    </div>

    <a href="2concert.php" style="text-decoration: none; color: inherit;">
    <div class="anime-card">
      <img src="gvprakash.jpg" alt="Anime 2">
      <div class="anime-info">
        <div class="anime-title">OG Sambavam</div>
        <div class="anime-date">July 12,2025</div>
        <div class="stars">London</div>
      </div>
    </div>

    <a href="3concert.php" style="text-decoration: none; color: inherit;">
    <div class="anime-card">
      <img src="Vijayantony.jpg" alt="Anime 3">
      <div class="anime-info">
        <div class="anime-title">Vijay Antony 2.0</div>
        <div class="anime-date">July 6,2025</div>
        <div class="stars">Kuala Lumpur</div>
      </div>
    </div>

    <a href="4concert.php" style="text-decoration: none; color: inherit;">
    <div class="anime-card">
      <img src="arr.jpg" alt="Anime 4">
      <div class="anime-info">
        <div class="anime-title">The Wonderment Tour</div>
        <div class="anime-date">June 8,2025</div>
        <div class="stars">Coimbatore</div>
      </div>
    </div>

    <a href="5concert.php" style="text-decoration: none; color: inherit;">
    <div class="anime-card">
      <img src="arjitsingh2.webp" alt="Anime 5">
      <div class="anime-info">
        <div class="anime-title">India Tour 24-25</div>
        <div class="anime-date">April 27,2025</div>
        <div class="stars">Chennai</div>
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
    window.location.href = "login.html";
  });
  </script>
</body>
</html>
