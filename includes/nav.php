<?php
if(!isset($_SESSION)) session_start();
?>

<style>

.navbar{
    background:#fff;
    border-bottom:1px solid #eee;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-family:Arial, sans-serif;
}

.logo{
    color:#111;
    font-size:22px;
    font-weight:bold;
}

.links a{
    color:#111;
    text-decoration:none;
    margin-left:20px;
    font-weight:500;
    transition:0.3s;
}

.links a:hover{
    color:#666;
}

</style>

<div class="navbar">

    <div class="logo">
        Handy Market
    </div>

    <div class="links">

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "provider"){ ?>

            <a href="/service-marketplace/home.php">Home</a>
            <a href="/service-marketplace/provider/dashboard.php">Dashboard</a>
            <a href="/service-marketplace/provider/help.php">Help</a>

        <?php } elseif(isset($_SESSION['role']) && $_SESSION['role'] == "customer"){ ?>

            <a href="/service-marketplace/home.php">Home</a>
            <a href="/service-marketplace/customer/dashboard.php">Dashboard</a>

        <?php } else { ?>

            <a href="/service-marketplace/home.php">Home</a>
            <a href="/service-marketplace/auth/login.php">Login</a>
            <a href="/service-marketplace/auth/register.php">Register</a>

        <?php } ?>

        <a href="/service-marketplace/auth/logout.php">Logout</a>

    </div>

</div>