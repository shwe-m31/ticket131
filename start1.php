<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flexigo - Book My Ticket</title>
  <link rel="icon" href="flexigo2.png" type="image/png">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
  margin:0;
  padding: 0;
}

.carousel, .carousel-inner, .carousel-item, iframe {
  height: 100vh;
  width: 100vw;
}

iframe {
  border: none;
}
.carousel-item {
  height: 100vh;
}

.carousel-item iframe,
.carousel-item .container {
  height: 100%;
  width: 100%;
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
  perspective: 1000px;
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
  display: flex;
  align-items: flex-start;
}

.column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.column-up img {
  animation-name: scroll-up;
}

.column-down img {
  animation-name: scroll-down;
}

.column img {
  width: 150px;
  height: 150px;
  border-radius: 12px;
  object-fit: cover;
  animation-duration: 10s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
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


</style>
</head>
<body>
 
   
  <div id="fullscreenCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container">
          <div class="left">
            <div class="image-grid">
              <div class="column column-up">
                <img src="wolfman.webp" alt="" />
                <img src="dragon.webp" alt="" />
                <img src="malayalam.jpg" alt="" />
              </div>
              <div class="column column-down">
                <img src="thandel.webp" alt="" />
                <img src="love.avif" alt="" />
                <img src="download.jpg" alt="" />
              </div>
              <div class="column column-up">
                <img src="horror.jpg" alt="" />
                <img src="comedy.webp" alt="" />
                <img src="last movie.jpg" alt="" />
              </div>
            </div>
          </div>
          <div class="right">
            <i><h1 class="brand">FlexiGo</h1></i>
            <h2>Welcome to FlexiGo!<br>Book My Ticket</h2>
            <p>"Your front-row pass to the movies—book fast, sit back, and enjoy the show!".</p>
          </div>
        </div>

      </div>
      <div class="carousel-item">
        <iframe src="start2.php"></iframe>
      </div>
      <div class="carousel-item">
        <iframe src="start3.php"></iframe>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#fullscreenCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#fullscreenCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  <!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
