<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flexigo - Book My Ticket</title>
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: #0f0f0f;
  color: #fff;
  font-family: 'Segoe UI', sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.container {
  display: flex;
  flex-wrap: wrap;
  max-width: 1200px;
  width: 90%;
  background-color: #0f0f0f;
  border-radius: 12px;
  overflow: hidden;
  justify-content: center;
  align-items: center;
  padding: 40px;
}

.left {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 2rem;
}

.image-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: repeat(3, 1fr);
  gap: 20px;
}

.image-grid img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 10px;
}

.right {
  flex: 1;
  padding: 3rem 2rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.brand {
  font-size: 2rem;
  font-weight: bold;
  color: #facc15;
  margin-bottom: 1rem;
}

h2 {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

p {
  font-size: 0.95rem;
  margin-bottom: 2rem;
  color: #ccc;
}

.sign-in-btn {
  background-color: #facc15;
  color: #000;
  padding: 0.75rem;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  margin-bottom: 1rem;
  padding: 16px 60px;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  transition: background-color 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}
.sign-in-btn:hover {
  background-color: #e5b800;
}

.divider {
  text-align: center;
  margin: 1rem 0;
  font-size: 0.85rem;
  color: #999;
}

.google-btn {
  background-color: transparent;
  border: 1px solid #444;
  color: #fff;
  padding: 0.75rem;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  cursor: pointer;
}

.google-btn img {
  width: 20px;
}

@media (max-width: 768px) {
  .container {
    flex-direction: column;
  }

  .left {
    order: 2;
  }

  .image-grid {
    grid-template-columns: repeat(3, 80px);
    grid-template-rows: repeat(3, 80px);
  }

  .image-grid img {
    width: 80px;
    height: 80px;
  }

  .right {
    text-align: center;
  }

  .google-btn,
  .sign-in-btn {
    width: 100%;
  }
}

  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="image-grid">
        <img src="flight1.jpg" alt="" />
        <img src="flight 2.webp" alt="" />
        <img src="flight3.avif" alt="" />
        <img src="flight 4.webp" alt="" />
        <img src="flight 5.jpg" alt="" />
        <img src="flight 6.jpg" alt="" />
        <img src="flight 7.webp" alt="" />
        <img src="flight 8.jpg" alt="" />
        <img src="flight 9.jpg" alt="" />
      </div>
    </div>
    <div class="right">
      <i><h1 class="brand">FlexiGo</h1></i>
      <h2>Welcome to FlexiGo!<br>Book My Ticket</h2>
      <p>"Your next adventure takes off here."</p>
      <button class="sign-in-btn" onclick="window.top.location.href='signin.php'">Sign in</button>

  </div>
  
</body>
</html>
