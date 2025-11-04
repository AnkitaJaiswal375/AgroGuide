<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['firstname']);
    $address = htmlspecialchars($_POST['address']);
     $cityname = htmlspecialchars($_POST['cityname']);
  } else {
   
    header("Location: openacc.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Open Account - Bank Of Baroda</title>
  <style>
   
    body {
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-size: 15px;
      color: black;
      margin: 20px;
      background-image: url("boback.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    h1 {
      font-size: 50px;
      margin-top: 50px;
      margin-bottom: 50px;
      text-align: center;
      border-bottom: 2px solid white;
    }

    h2 {
      font-size: 18px;
      margin-top: 25px;
      margin-bottom: 10px;
      text-align: center;
    }

    .logo-img {
      float: left;
      margin: 10px;
      width: 100px;
      height: 100px;
    }

    .nav-table {
      width: 100%;
      margin-top: 10px;
      margin-bottom: 10px;
      background-color: #ffd0d0;
    }

    .nav-table td {
      text-align: center;
      padding: 10px;
    }

    a {
      color: purple;
      text-decoration: none;
      font-weight: bold;
    }

    .center-form {
      padding: 30px;
      margin: 30px auto;
      width: 400px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    .center-form input,
    .center-form textarea,
    .center-form button {
      width: 90%;
      padding: 8px;
      margin-top: 8px;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .center-form label {
      font-weight: bold;
      display: block;
      text-align: left;
    }

    footer {
      text-align: center;
      font-size: 13px;
      margin-top: 40px;
    }
  </style>
</head>

<body>

  <div class="section">
    <img src="bankofbaroda.png" alt="Bank of Baroda Logo" class="logo-img">
    <h1>BANK OF BARODA</h1>
  </div>

  <table border="1" class="nav-table">
    <tr>
      <td><a href="Bank.html">Home</a></td>
      <td><a href="#">About Us</a></td>
      <td><a href="login.php">Login</a></td>
      <td><a href="openacc.php">Open A/C</a></td>
    </tr>
  </table>

  <div class="center-form">
    <h2>Account Opening Form</h2>
    <p><strong>Customer Name:</strong> <?php echo $firstname; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>City:</strong> <?php echo $cityname; ?></p>
  </div>

  <footer>
    <hr>
    <p>© 2025 Bank of Baroda. All rights reserved. | Contact: info@bankofbaroda.com</p>
  </footer>

</body>
</html>
