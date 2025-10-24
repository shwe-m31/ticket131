<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include 'server.php';

$email = $_SESSION['email'];
$updateSuccess = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $phonenumber = $_POST['phonenumber'];
    $dob = $_POST['dob'];

    $sql = "UPDATE signin_det SET fname=?, lname=?, gender=?, phonenumber=?, dob=? WHERE email=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssss", $fname, $lname, $gender, $phonenumber, $dob, $email);
    if ($stmt->execute()) {
        $updateSuccess = true;
    }
}

// Fetch current user data
$sql = "SELECT fname, lname, gender, email, phonenumber, dob FROM signin_det WHERE email=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile - FlexiGo</title>
  <link rel="icon" href="flexigo2.png">
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      background-color: #0e1218;
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 2rem;
    }
    .edit-profile {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 2rem;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
    .edit-profile h1 {
      margin-bottom: 1rem;
      color: #facc15;
    }
    .edit-profile form {
      display: flex;
      flex-direction: column;
    }
    input[type="text"],
    input[type="tel"],
    input[type="date"] {
      padding: 0.8rem;
      border: none;
      border-radius: 8px;
      background: #2a2f3a;
      color: white;
      margin-bottom: 1rem;
      font-size: 1rem;
    }
    select {
      padding: 0.8rem;
      background: #2a2f3a;
      color: white;
      border: none;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-size: 1rem;
    }
    .btn-save {
      background-color: #facc15;
      color: black;
      padding: 0.8rem;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.2s ease-in-out;
    }
    .btn-save:hover {
      background-color: #eab308;
    }
    .back-link {
      color: #2f80ed;
      display: block;
      margin-top: 1.5rem;
      text-align: center;
      text-decoration: none;
    }
    .success-message {
      color: #86efac;
      margin-bottom: 1rem;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="edit-profile">
    <center><h1>Edit Your Profile</h1></center>
    
    <?php if ($updateSuccess): ?>
      <div class="success-message">Profile updated successfully ✅</div>
    <?php endif; ?>

    <form method="POST" action="editprofile.php">
      <input type="text" name="fname" value="<?= htmlspecialchars($user['fname']) ?>" placeholder="First Name" required>
      <input type="text" name="lname" value="<?= htmlspecialchars($user['lname']) ?>" placeholder="Last Name" required>
      <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
      </select>
      <input type="tel" name="phonenumber" value="<?= htmlspecialchars($user['phonenumber']) ?>" placeholder="Phone Number" required>
      <input type="date" name="dob" value="<?= htmlspecialchars($user['dob']) ?>" required>
      
      <button type="submit" class="btn-save">Save Changes</button>
    </form>

    <a href="profile.php" class="back-link">← Back to Profile</a>
  </div>
</body>
</html>