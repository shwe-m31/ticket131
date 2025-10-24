<?php
$logged=0;
$invalid=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
include 'server.php';
$email=$_POST['email'];
$password=$_POST['password'];
$sql="SELECT * FROM signin_det WHERE email='$email' AND password='$password'";
$result=mysqli_query($con,$sql);
if($result){
$num=mysqli_num_rows($result);
if($num>0){
$logged=1;
 session_start();
  $_SESSION['email']=$email;
}
else{
$invalid=1;
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="script.js"></script>
<script>
    function formValidation() {
    let x = document.forms["form2"]["email"].value;
    if (x == "") {
    alert("Fill in the details");
    return false;
    }
    }
    
    </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - Anywhere App</title>
  <link rel="icon" href="flexigo2.png" >
  <link rel="stylesheet" href="styles.css">
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    position: relative;
  background-color: #0e1218;
  color: white;
  min-height: 100vh;
  overflow-x: hidden;
  overflow-y: auto;
}
.background-image {
  background-image: url('passport.png'); /* Replace with correct path if deployed */
  background-position: right center;
  background-repeat: no-repeat;
  background-size: cover;
  position: absolute;
  top: 0;
  right: 0;
  width: 60%;
  height: 100%;
  z-index: 1;
}
.overlay {
  background: linear-gradient(to right, rgba(14, 18, 24, 0.95) 40%, rgba(14, 18, 24, 0.3));
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
}
.container {
  width: 100%;
  max-width: 900px;
  padding: 2rem;
  position: relative;
  z-index: 3;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 4rem;
}

.logo {
  font-size: 1.2rem;
  font-weight: bold;
  color: #facc15;
}

.logo span {
  color: yellow;
}

.navbar ul {
  display: flex;
  gap: 1.5rem;
  list-style: none;
}

.navbar a {
  color: #fff;
  text-decoration: none;
  font-size: 0.95rem;
}

.form-container {
  background: rgba(255, 255, 255, 0.03);
  padding: 2rem;
  border-radius: 12px;
  backdrop-filter: blur(10px);
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
}

.form-container h5 {
  color: #aaa;
  font-size: 0.8rem;
  margin-bottom: 0.5rem;
}

.form-container h1 {
  font-size: 2rem;
  margin-bottom: 0.5rem;
}

.form-container h1 span {
  color: white;
}

.form-container p {
  font-size: 0.9rem;
  margin-bottom: 1.5rem;
}

.form-container a {
  color: #2f80ed;
  text-decoration: none;
}

form input[type="text"],
form input[type="email"],
form input[type="password"],
form input[type="phonenumber"],
form input[type="dateofbirth"] {
  width: 100%;
  padding: 0.9rem;
  border: none;
  border-radius: 8px;
  background: #2a2f3a;
  color: #fff;
  margin-bottom: 1rem;
  font-size: 0.95rem;
}

.input-group {
  display: flex;
  gap: 1rem;
}

.input-group input {
  flex: 1;
}

.button-group {
  display: flex;
  gap: 1rem;
  margin-top: 1rem;
}

.primary-btn,
.secondary-btn {
  padding: 0.9rem 1.5rem;
  border: none;
  border-radius: 10px;
  font-weight: bold;
  cursor: pointer;
  font-size: 1rem;
}

.primary-btn {
  background: #facc15;
  color: black;
}

.secondary-btn {
  background: #3c3f46;
  color: #ccc;
}

  </style>
</head>
<body>
<?php
        if ($invalid){
             echo "Login invalid";
        }
    ?>
    <?php 
    if($logged){
        echo "Logged sucessfully";
        header('location:movies.php'); 
    }
    ?>
  <div class="background-image"></div>
  <div class="overlay"></div>
  <div class="container">
    <nav class="navbar">
      <div class="logo"><i>FlexiGo</i></div>

    </nav>

    <div class="form-container">
      <h1>Log in to your account<span>.</span></h1>
      <form action="login.php" method="POST" name="form2" onsubmit="return formValidation()">
        
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="password"name="password" id="password" placeholder="Password">
        
        <div class="button-group">
          <button type="submit" class="primary-btn">Log In</button>
      </div>
      </form>
    </div>
  </div>
</body>

</html>