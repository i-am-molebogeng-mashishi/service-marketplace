<?php
session_start();
include("../includes/nav.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Provider Help - Handy Market</title>

    <style>

    body{
        font-family:Arial, sans-serif;
        margin:0;
        background:#f8f8f8;
    }

    .container{
        max-width:1000px;
        margin:40px auto;
        padding:20px;
    }

    .card{
        background:white;
        padding:25px;
        border-radius:10px;
        margin-bottom:20px;
        box-shadow:0 2px 8px rgba(0,0,0,0.08);
    }

    h1,h2{
        color:#111;
    }

    </style>
</head>

<body>

<div class="container">

    <h1>Provider Help Centre</h1>

    <div class="card">
        <h2>Add a Service</h2>
        <p>Use the Dashboard to add services that customers can book.</p>
    </div>

    <div class="card">
        <h2>Manage Services</h2>
        <p>Edit, update, or remove services from your dashboard.</p>
    </div>

    <div class="card">
        <h2>Bookings</h2>
        <p>View and manage customer bookings.</p>
    </div>

    <div class="card">
        <h2>Reviews</h2>
        <p>Monitor customer feedback and ratings.</p>
    </div>

    <div class="card">
        <h2>Need More Help?</h2>
        <p>Email: support@handymarket.co.za</p>
        <p>Phone: +27 12 345 6789</p>
    </div>

</div>

</body>
</html>