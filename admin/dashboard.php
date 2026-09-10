<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$totalUsers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));

$providers = mysqli_num_rows(mysqli_query($conn, "
SELECT * FROM users WHERE role='provider'
"));

$customers = mysqli_num_rows(mysqli_query($conn, "
SELECT * FROM users WHERE role='customer'
"));

$services = mysqli_num_rows(mysqli_query($conn, "
SELECT * FROM services
"));

$bookings = mysqli_num_rows(mysqli_query($conn, "
SELECT * FROM bookings
"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>

<body style="font-family:Arial; background:#f5f5f5;">

<div style="padding:30px;">

    <h1>Admin Dashboard</h1>

    <div style="
        display:flex;
        flex-wrap:wrap;
        gap:20px;
        margin-top:30px;
    ">

        <div style="
            background:white;
            padding:25px;
            width:220px;
            border-radius:10px;
            box-shadow:0px 2px 8px rgba(0,0,0,0.1);
        ">
            <h3>Total Users</h3>
            <h1><?php echo $totalUsers; ?></h1>
        </div>

        <div style="
            background:white;
            padding:25px;
            width:220px;
            border-radius:10px;
            box-shadow:0px 2px 8px rgba(0,0,0,0.1);
        ">
            <h3>Providers</h3>
            <h1 style="color:blue;">
                <?php echo $providers; ?>
            </h1>
        </div>

        <div style="
            background:white;
            padding:25px;
            width:220px;
            border-radius:10px;
            box-shadow:0px 2px 8px rgba(0,0,0,0.1);
        ">
            <h3>Customers</h3>
            <h1 style="color:green;">
                <?php echo $customers; ?>
            </h1>
        </div>

        <div style="
            background:white;
            padding:25px;
            width:220px;
            border-radius:10px;
            box-shadow:0px 2px 8px rgba(0,0,0,0.1);
        ">
            <h3>Services</h3>
            <h1 style="color:orange;">
                <?php echo $services; ?>
            </h1>
        </div>

        <div style="
            background:white;
            padding:25px;
            width:220px;
            border-radius:10px;
            box-shadow:0px 2px 8px rgba(0,0,0,0.1);
        ">
            <h3>Bookings</h3>
            <h1 style="color:red;">
                <?php echo $bookings; ?>
            </h1>
        </div>

    </div>

</div>

</body>
</html>