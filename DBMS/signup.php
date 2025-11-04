<?php
session_start();
include 'connect.php'; // Ensure this file connects to your MySQL database dashboard

$error = '';
$success = '';

// Only process form if submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Safely check if keys exist before accessing
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM customer_info WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered! Please login.";
        } else {
            // Hash password and insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO customer_info (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "Signup successful!";
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['user_name'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}
$conn->close();
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Signup - Bank of Baroda</title>
    <style>
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

        input[type="text"], input[type="email"], input[type="password"] {
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
        <h2>Signup</h2>
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required minlength="6"><br><br>

    <button type="submit" name="submit">Register</button>
</form>

        <div class="signup-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>