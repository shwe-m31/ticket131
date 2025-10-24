<?php
session_start();
if (!isset($_SESSION['email'])) {
    // Not logged in, redirect to login
    header('Location: login.php');
    exit();
}

include 'server.php';

$email = $_SESSION['email'];

// Prepare statement to fetch user data
$sql = "SELECT fname, lname, gender, email, phonenumber, dob FROM signin_det WHERE email = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Profile - FlexiGo</title>
  <link rel="icon" href="flexigo2.png">
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      background-color: #0e1218;
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 2rem;
    }
    .profile-card {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 2rem;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      
    }
    .profile-card h1 {
      margin-bottom: 1rem;
      color: #facc15;
    }
    .profile-info {
      margin-bottom: 1rem;
      padding-left: 150px;
    }
    .profile-info strong {
      display: inline-block;
      width: 120px;
      color: #ccc;
    }
    .logout-btn {
      background-color: #facc15;
      padding: 0.6rem 1rem;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      color: black;
      cursor: pointer;
      margin-top: 1.5rem;
    }
    .logout-btn:hover {
      background-color: #eab308;
    }
    .image{
        height:100px;
        width:100px;
    }
  </style>
</head>
<body>
  <div class="profile-card">
    <center><img src="profile.jpg" alt="Profile image" class="image">
    <h1><?= htmlspecialchars($user['fname']) ?></h1></center>

    <div class="profile-info"><strong>Full Name:</strong> <?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?></div>
    <div class="profile-info"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></div>
    <div class="profile-info"><strong>Phone:</strong> <?= htmlspecialchars($user['phonenumber']) ?></div>
    <div class="profile-info"><strong>Gender:</strong> <?= htmlspecialchars($user['gender']) ?></div>
    <div class="profile-info"><strong>Date of Birth:</strong> <?= htmlspecialchars($user['dob']) ?></div>

   <center> <form action="logout.php" method="POST">
      <button type="submit" class="logout-btn">Log Out</button>
    </form></center>
  </div>
</body>
</html>