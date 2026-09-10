<?php
session_start();

if (
    !isset($_SESSION['user']) ||
    $_SESSION['role'] != 'customer'
) {

    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Customer Home | Handy Market</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:#f5f5f5;
            overflow-x:hidden;
        }

        h1,h2,h3{
            font-family:'Poppins',sans-serif;
        }

        /* NAVBAR */

        .navbar{
            position:absolute;
            width:100%;
            top:0;
            left:0;
            padding:25px 60px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            z-index:100;
        }

        .logo h1{
            color:white;
        }

        .nav-links a{
            text-decoration:none;
            margin-left:20px;
            color:white;
            font-weight:600;
        }

        /* HERO */

        .hero{
            height:100vh;
            position:relative;
            overflow:hidden;
        }

        .slide{
            position:absolute;
            width:100%;
            height:100%;
            background-size:cover;
            background-position:center;
            opacity:0;
            animation:slideShow 15s infinite;
        }

        .slide:nth-child(1){
            background-image:url('https://images.unsplash.com/photo-1521791136064-7986c2920216');
            animation-delay:0s;
        }

        .slide:nth-child(2){
            background-image:url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d');
            animation-delay:5s;
        }

        .slide:nth-child(3){
            background-image:url('https://images.unsplash.com/photo-1497366754035-f200968a6e72');
            animation-delay:10s;
        }

        .overlay{
            position:absolute;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.6);
        }

        @keyframes slideShow{

            0%{opacity:0;}
            10%{opacity:1;}
            30%{opacity:1;}
            40%{opacity:0;}
            100%{opacity:0;}
        }

        .hero-content{
            position:relative;
            z-index:10;
            height:100%;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            text-align:center;
            color:white;
            padding:20px;
        }

        .hero-content h1{
            font-size:70px;
            margin-bottom:20px;
        }

        .hero-content p{
            font-size:22px;
            max-width:700px;
            color:#ddd;
            line-height:1.7;
        }

        /* DISCOUNTS */

        .discounts{
            padding:100px 60px;
        }

        .discounts h2{
            text-align:center;
            font-size:45px;
            margin-bottom:50px;
        }

        .discount-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:25px;
        }

        .discount-card{
            background:white;
            padding:35px;
            border-radius:30px;
            transition:0.3s;
        }

        .discount-card:hover{
            transform:translateY(-8px);
        }

        .discount-card h3{
            margin-bottom:15px;
        }

        .discount-card p{
            color:#666;
            line-height:1.7;
        }

        .book-btn{
            display:inline-block;
            margin-top:20px;
            padding:12px 25px;
            background:#111;
            color:white;
            border-radius:50px;
            text-decoration:none;
        }

        footer{
            background:#111;
            color:white;
            text-align:center;
            padding:30px;
        }

    </style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">

        <h1>
            Handy Market
        </h1>

    </div>

    <div class="nav-links">

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="../auth/logout.php">
            Logout
        </a>

    </div>

</div>

<!-- HERO -->

<section class="hero">

    <div class="slide"></div>
    <div class="slide"></div>
    <div class="slide"></div>

    <div class="overlay"></div>

    <div class="hero-content">

        <h1>
            Welcome,
            <?php echo $_SESSION['user']; ?>
        </h1>

        <p>
            Find trusted local providers and exclusive service discounts.
        </p>

    </div>

</section>

<!-- DISCOUNTS -->

<section class="discounts">

    <h2>
        Featured Services & Discounts
    </h2>

    <div class="discount-grid">

        <div class="discount-card">

            <h3>
                Plumbing Services
            </h3>

            <p>
                Get 20% off on plumbing repairs this month.
            </p>

            <a href="#"
               class="book-btn">
               Book Service
            </a>

        </div>

        <div class="discount-card">

            <h3>
                House Cleaning
            </h3>

            <p>
                Trusted cleaners available near your area.
            </p>

            <a href="#"
               class="book-btn">
               View Providers
            </a>

        </div>

        <div class="discount-card">

            <h3>
                Electrical Repairs
            </h3>

            <p>
                Reliable electricians with verified profiles.
            </p>

            <a href="#"
               class="book-btn">
               Hire Now
            </a>

        </div>

    </div>

</section>

<footer>

    © 2026 Handy Market

</footer>

</body>
</html>