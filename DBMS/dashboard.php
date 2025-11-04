<?php
session_start();
include 'connect.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirect if not logged in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['user_name'];

// Fetch customer details
$stmt = $conn->prepare("SELECT email FROM customer_info WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $user_email = $row['email'];
} else {
    echo "<p style='color:red;'>User not found.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Bank of Baroda</title>
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

        .shaded {
            background-color: #ffd0d0;
        }

        .nav-table {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
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

        .section {
            margin: 30px 40px;
        }

        ul, ol {
            margin-left: 40px;
        }

        #banner {
            background-image: url("bobban.png");
            background-repeat: no-repeat;
            background-size: 100% 250px;
            background-position: center center;
            height: 250px;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            font-size: 13px;
            margin: 30px 0;
            color: #333;
        }

        .tables-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        .table-section {
            flex: 1;
        }

        .table-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #4a90e2;
        }

        th, td {
            border: 1px solid #4a90e2;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #e6f3ff;
            font-weight: bold;
            color: #333;
        }

        .details-header {
            color: #333;
        }

        .details-link {
            color: #e74c3c;
            font-size: 12px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f0f8ff;
        }

        .clickable {
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .clickable:hover {
            background-color: #d4edda;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .welcome {
            font-size: 24px;
            margin-bottom: 20px;
            color: purple;
            text-align: center;
        }

        .user-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 600px;
        }

        .user-info p {
            margin: 10px 0;
            font-size: 16px;
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

    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($username); ?>! 🎉
    </div>

    <div class="user-info">
        <h3>Your Account Information:</h3>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
        <p><strong>Account Status:</strong> <span style="color: green;">Active</span></p>
    </div>

    <div class="tables-container">
        <div class="table-section">
            <div class="table-title">Recent Transactions</div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="clickable">
                        <td>2025-10-01</td>
                        <td>Deposit</td>
                        <td>₹5,000</td>
                        <td>Completed</td>
                    </tr>
                    <tr class="clickable">
                        <td>2025-10-05</td>
                        <td>Withdrawal</td>
                        <td>₹2,000</td>
                        <td>Completed</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-section">
            <div class="table-title">Account Summary</div>
            <table>
                <thead>
                    <tr>
                        <th>Account Type</th>
                        <th>Balance</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Savings</td>
                        <td>₹12,500</td>
                        <td>Panagar</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <footer>
        &copy; 2025 Bank of Baroda. All rights reserved.
    </footer>
</body>
</html>