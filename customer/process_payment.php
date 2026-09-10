<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: view_services.php");
    exit();
}

$service_id = $_POST['service_id'];

$customer = $_SESSION['user'];

// INSERT BOOKING

$query = "
INSERT INTO bookings
(service_id, customer_name, status)

VALUES

('$service_id', '$customer', 'Pending')
";

mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

    <title>Payment Successful</title>

    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<script>

alert("Payment Successful! Your booking has been submitted.");

</script>

<div class="container">

    <div class="card" style="
        max-width:500px;
        margin:auto;
        margin-top:80px;
        text-align:center;
    ">

        <h1 style="color:green;">
            Payment Successful
        </h1>

        <p style="
            font-size:20px;
            margin-top:20px;
        ">
            Your booking has been submitted successfully.
        </p>

        <br>

        <a href="my_bookings.php" class="btn">
            View My Bookings
        </a>

    </div>

</div>

</body>
</html>