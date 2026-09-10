<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'provider') {
    header("Location: ../auth/login.php");
    exit();
}

$booking_id = $_GET['id'];
$status = $_GET['status'];

// allowed statuses only (security)
$allowed = ['Accepted', 'Rejected', 'In Progress', 'Completed'];

if (!in_array($status, $allowed)) {
    die("Invalid status");
}

$sql = "UPDATE bookings SET status='$status' WHERE id='$booking_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: bookings.php?success=1");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>