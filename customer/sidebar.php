<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<style>

.sidebar{
    width:260px;
    height:100vh;
    background:white;
    padding:30px 20px;
    position:fixed;
    left:0;
    top:0;
    border-right:1px solid #eee;
    overflow-y:auto;
    z-index:1000;
}

.logo h1{
    font-family:'Poppins',sans-serif;
    font-size:28px;
    margin-bottom:5px;
}

.logo p{
    color:#666;
    font-size:13px;
    margin-bottom:30px;
}

.menu a{
    display:block;
    text-decoration:none;
    color:#111;
    padding:14px 18px;
    margin-bottom:12px;
    border-radius:50px;
    background:#f5f5f5;
    font-weight:600;
    transition:0.3s;
}

.menu a:hover{
    background:#111;
    color:white;
}

</style>

<div class="sidebar">

    <div class="logo">
        <h1>Handy Market</h1>
        <p>Customer Panel</p>
    </div>

    <div class="menu">

        <a href="dashboard.php">Dashboard</a>
        <a href="home.php">Home</a>
        <a href="view_services.php">Browse Services</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="help.php">Help Center</a>
        <a href="contact.php">Contact Support</a>
        <a href="../auth/logout.php">Logout</a>

    </div>

</div>