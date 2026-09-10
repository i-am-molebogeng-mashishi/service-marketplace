<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'customer') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Customer Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:#f5f5f5;
}

/* MAIN */
.main{
    margin-left:260px;
    padding:50px;
}

/* HERO */
.hero h2{
    font-family:'Poppins',sans-serif;
    font-size:45px;
}

.hero p{
    color:#666;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    margin-top:40px;
}

.card{
    background:white;
    padding:30px;
    border-radius:30px;
}

.btn{
    display:inline-block;
    padding:12px 25px;
    background:#111;
    color:white;
    text-decoration:none;
    border-radius:50px;
}

</style>

</head>

<body>

<?php include("sidebar.php"); ?>

<div class="main">

    <div class="hero">
        <h2>Welcome, <?php echo $_SESSION['user']; ?></h2>
        <p>Your customer dashboard is now active.</p>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Browse Services</h3>
            <a class="btn" href="view_services.php">Open</a>
        </div>

        <div class="card">
            <h3>My Bookings</h3>
            <a class="btn" href="my_bookings.php">Open</a>
        </div>

        <div class="card">
            <h3>Help Center</h3>
            <a class="btn" href="help.php">Open</a>
        </div>

        <div class="card">
            <h3>Contact Support</h3>
            <a class="btn" href="contact.php">Open</a>
        </div>

    </div>

</div>

</body>
</html>