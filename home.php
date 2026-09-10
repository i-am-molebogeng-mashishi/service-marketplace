<?php
session_start();
include("includes/db.php");
include("includes/nav.php");

$logged_in = isset($_SESSION['user_id']);
$role = $_SESSION['role'] ?? "guest";
?>

<!DOCTYPE html>
<html>
<head>

<title>Handy Market</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Inter',sans-serif;
}

/* HERO */
.hero{
    position:relative;
    height:500px;
    overflow:hidden;
}

.slide{
    position:absolute;
    width:100%;
    height:100%;
    opacity:0;
    transition:1.2s ease;
}

.slide img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.slide.active{
    opacity:1;
}

.overlay{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.45);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:white;
    z-index:10;
}

.overlay h1{
    font-size:55px;
    font-family:'Poppins',sans-serif;
    color:white;
    text-shadow:0 2px 10px rgba(0,0,0,0.7);
}


.btn{
    padding:12px 22px;
    border-radius:30px;
    text-decoration:none;
    margin:8px;
    display:inline-block;
    font-weight:600;
}

.button-group{
    display:flex;
    gap:15px;
    justify-content:center;
    align-items:center;
    margin-top:10px;
}

.btn1{
    border:2px solid #111;
    color:#111;
}

.btn2{
    background:#111;
    color:#fff;
}

/* SECTIONS */
.section{
    padding:60px 20px;
    max-width:1100px;
    margin:auto;
    text-align:center;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.box{
    background:#f5f5f5;
    padding:25px;
    border-radius:15px;
}

/* NEWSLETTER */
.newsletter{
    background:#111;
    color:#fff;
    padding:60px 20px;
    text-align:center;
}

.newsletter input{
    padding:12px;
    width:260px;
    border-radius:30px;
    border:none;
}

.newsletter button{
    padding:12px 20px;
    border-radius:30px;
    border:none;
    margin-left:10px;
    cursor:pointer;
}

/* FOOTER */
footer{
    background:#111;
    color:#fff;
    padding:40px 20px;
    text-align:center;
}

</style>

</head>

<body>

<!-- HERO -->
<div class="hero">

    <div class="slide active">
        <img src="assets/images/cleaning.jpg">
    </div>

    <div class="slide">
        <img src="assets/images/gardening.jpg">
    </div>

    <div class="slide">
        <img src="assets/images/plumbing.jpg">
    </div>

    <div class="slide">
        <img src="assets/images/electrical.jpg">
    </div>

    <div class="slide">
        <img src="assets/images/painting.jpg">
    </div>

    <div class="overlay">

        <h1>Handy Market</h1>
       <p style="
    font-size:22px;
    margin-top:-10px;
    margin-bottom:25px;
    font-weight:500;
    color:white;
    text-shadow:0 2px 10px rgba(0,0,0,0.7);
">
    Find Trusted Local Service Providers at Your Fingertips
</p> 

       <?php if(!$logged_in){ ?>

    <div class="button-group">

        <a href="auth/register.php" class="btn btn1">
            Register
        </a>

        <a href="auth/login.php" class="btn btn2">
            Login
        </a>

    </div>

<?php } else { ?>

    <a href="<?php echo ($role=='provider') ? 'provider/index.php' : 'customer/index.php'; ?>" class="btn btn2">
        Go to Dashboard
    </a>

<?php } ?>

    </div>

</div>


<!-- WHY + PROMO SIDE BY SIDE -->
<div class="section">

    <div class="grid">

        <div class="box">
            <h3>⭐ Why Choose Us</h3>
            <p>Verified Providers</p>
            <p>Fast Booking</p>
            <p>Affordable Prices</p>
        </div>

        <div class="box">
            <h3>🎉 Promotions</h3>
            <p>10% First Booking</p>
            <p>Cleaning Deals</p>
            <p>Plumbing Offers</p>
        </div>

    </div>

</div>

<!-- NEWSLETTER -->
<div class="newsletter">

    <h2>Newsletter</h2>
    <p>Get updates on deals</p>

    <input type="email" placeholder="Email">
    <button>Subscribe</button>

</div>

<!-- FOOTER -->
<footer>

    <h3>Handy Market</h3>

    <p>Email: support@handymarket.co.za</p>
    <p>Phone: +27 12 345 6789</p>

</footer>

<script>

let slides = document.querySelectorAll(".slide");
let i = 0;

setInterval(() => {
    slides.forEach(s => s.classList.remove("active"));
    i = (i + 1) % slides.length;
    slides[i].classList.add("active");
}, 3000);

</script>

</body>
</html>