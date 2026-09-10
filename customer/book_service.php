<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_services.php");
    exit();
}

$service_id = $_GET['id'];

// SEND USER TO PAYMENT PAGE

header("Location: payment.php?id=$service_id");
exit();
?>