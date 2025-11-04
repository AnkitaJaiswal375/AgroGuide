<?php
ob_start();
session_start();
include 'connect.php';

// Enable error reporting dashboard_.
ini_set('display_errors', 1);
error_reporting(E_ALL);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM customer_info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password
        if (password_verify($password, $hashed_password)) {
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bank Of Baroda - Login</title>
  <style type="text/css">
    body {
      font-family: Georgia, 'Times New Roman', Times, serif;
      font-size: 15px;
      color: black;
      margin: 0px;
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
      font-size: 35px;
      margin-top: 25px;
      margin-bottom: 10px;
      text-align: center;
    }

    label {
      font-weight: bold;
    }

    .center {
      padding: 60px 20px;
      text-align: center;
    }

    input[type="email"], input[type="password"] {
      padding: 8px;
      width: 250px;
      font-size: 16px;
      margin-top: 5px;
    }

    button, input[type="submit"] {
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      background-color: purple;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 15px;
    }

    button:hover, input[type="submit"]:hover {
      background-color: #660066;
    }

    .shaded {
      background-color: #ffd0d0;
    }

    .nav-table {
      width: 100%;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    a {
      color: purple;
      text-decoration: none;
      font-weight: bold;
    }

    .nav-table td {
      text-align: center;
      padding: 10px;
    }

    .error-message {
      color: red;
      background-color: #ffe6e6;
      padding: 10px;
      border-radius: 5px;
      margin: 10px auto;
      max-width: 400px;
      text-align: center;
    }

    .success-message {
      color: green;
      background-color: #e6ffe6;
      padding: 10px;
      border-radius: 5px;
      margin: 10px auto;
      max-width: 400px;
      text-align: center;
    }

    .signup-link {
      margin-top: 20px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="section">
    <img src="bankofbaroda.png"
         alt="Bank of Baroda Logo"
         width="100"
         height="100"
         align="left"
         hspace="10"
         vspace="10">
    <h1>BANK OF BARODA</h1>
  </div>

  <table border="1" class="nav-table shaded">
    <tr>
      <td><a href="Lab3bank.html">Home</a></td>
      <td><a href="#">About Us</a></td>
      <td><a href="signup.php">Sign Up</a></td>
      <td><a href="login.php">Login</a></td>
      <td><a href="openacc.php">Open A/C</a></td>
    </tr>
  </table>

  <div class="hero">
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<div class='error-message'>$error</div>"; ?>
    <form method="POST" action="login.php">
      <label>Email:</label><br>
      <input type="email" name="email" required><br><br>
      <label>Password:</label><br>
      <input type="password" name="password" required><br><br>
      <input type="submit" value="Login">
    </form>
    <div class="signup-link">
      Don't have an account? <a href="signup.php">Sign up here</a>
    </div>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>