<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FlexiGo-BookMyTickets</title>
  <link rel="icon" href="flexigo2.png" type="image/png">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body, html {
      height: 100%;
      overflow: hidden;
    }
    video.bg-video {
      position: fixed;
      top: 0;
      left: 0;
      min-width: 100%;
      min-height: 100%;
      object-fit: cover;
      z-index: -1;
    }
  </style>
</head>
<body>

  <video class="bg-video" autoplay muted playsinline>
    <source src="Scene-1.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Optional content on top -->
  <div style="position: relative; z-index: 1; color: white; text-align: center; top: 40%;">
  </div>

</body>
<script>
    const video = document.querySelector('video');
    video.addEventListener('ended', () => {
      window.location.href = "start1.php"; 
    });
  </script>
</html>
