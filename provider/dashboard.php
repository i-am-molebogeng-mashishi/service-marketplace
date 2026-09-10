<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'provider') {
    header("Location: ../auth/login.php");
    exit();
}

$provider = $_SESSION['user'];

$services_result = mysqli_query($conn,"
SELECT COUNT(*) AS total_services
FROM services
WHERE provider_name='$provider'
");
$services_data = mysqli_fetch_assoc($services_result);

$bookings_result = mysqli_query($conn,"
SELECT COUNT(*) AS total_bookings
FROM bookings
INNER JOIN services
ON bookings.service_id = services.id
WHERE services.provider_name='$provider'
");
$bookings_data = mysqli_fetch_assoc($bookings_result);

$completed_result = mysqli_query($conn,"
SELECT COUNT(*) AS completed_jobs
FROM bookings
INNER JOIN services
ON bookings.service_id = services.id
WHERE services.provider_name='$provider'
AND bookings.status='Completed'
");
$completed_data = mysqli_fetch_assoc($completed_result);

$pending_result = mysqli_query($conn,"
SELECT COUNT(*) AS pending_bookings
FROM bookings
INNER JOIN services
ON bookings.service_id = services.id
WHERE services.provider_name='$provider'
AND bookings.status='Pending'
");
$pending_data = mysqli_fetch_assoc($pending_result);

?>

<!DOCTYPE html>
<html>
<head>

<title>Provider Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:#f7f7f7;
}

/* TOP BAR */

.topbar{
    background:white;
    padding:18px 25px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:1px solid #eee;
}

.menu-btn{
    font-size:28px;
    cursor:pointer;
    border:none;
    background:none;
}

.logo{
    font-size:24px;
    font-weight:700;
    font-family:'Poppins',sans-serif;
}

/* SIDEBAR */

.sidebar{
    position:fixed;
    left:-300px;
    top:0;
    width:280px;
    height:100%;
    background:white;
    z-index:999;
    transition:0.3s;
    padding:25px;
    box-shadow:0 0 20px rgba(0,0,0,0.1);
}

.sidebar.active{
    left:0;
}

.close-btn{
    font-size:22px;
    cursor:pointer;
    margin-bottom:25px;
}

.sidebar a{
    display:block;
    text-decoration:none;
    color:#111;
    padding:14px;
    margin-bottom:10px;
    border-radius:50px;
    transition:0.3s;
    font-family:'Poppins',sans-serif;
}

.sidebar a:hover{
    background:#111;
    color:white;
}

.overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.4);
    display:none;
}

.overlay.active{
    display:block;
}

/* MAIN */

.main{
    padding:40px;
}

.welcome h1{
    font-size:40px;
    margin-bottom:10px;
}

.welcome p{
    color:#666;
}

/* QUICK ACTIONS */

.quick-actions{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-top:30px;
    margin-bottom:30px;
}

.action-card{
    background:white;
    border-radius:25px;
    padding:25px;
    text-decoration:none;
    color:#111;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.action-card:hover{
    transform:translateY(-5px);
}

/* STATS */

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:30px;
    border-radius:25px;
}

.card h2{
    font-size:42px;
}

.card p{
    color:#666;
    margin-top:10px;
}

/* HELP */

.help-box{
    margin-top:35px;
    background:#111;
    color:white;
    padding:35px;
    border-radius:25px;
}

.help-box a{
    display:inline-block;
    margin-top:15px;
    padding:12px 22px;
    border-radius:50px;
    background:white;
    color:black;
    text-decoration:none;
}

</style>

</head>

<body>
   

<div class="topbar">

    <button class="menu-btn" onclick="openMenu()">☰</button>

    <div class="logo">
        Handy Market
    </div>

</div>

<div class="overlay" id="overlay" onclick="closeMenu()"></div>

<div class="sidebar" id="sidebar">

    <div class="close-btn" onclick="closeMenu()">✖ Close</div>

    <a href="../home.php">🏠 Home</a>

    <a href="dashboard.php">📊 Dashboard</a>

    <a href="profile.php">👤 Profile</a>

    <a href="add_service.php">➕ Add Service</a>

    <a href="my_services.php">🛠 My Services</a>

    <a href="messages.php">💬 Messages</a>

    <a href="bookings.php">📅 Manage Bookings</a>

    <a href="reviews.php">⭐ Reviews</a>

    <a href="../customer/dashboard.php">🔄 Switch to Customer</a>

    <a href="help.php">❓ Help & Contact</a>

    <a href="../auth/logout.php">🚪 Logout</a>

</div>

<div class="main">

    <div class="welcome">

        <h1>Welcome, <?php echo $_SESSION['user']; ?></h1>

        <p>Manage your services, bookings and grow your business.</p>

    </div>

    <div class="quick-actions">

        <a href="add_service.php" class="action-card">
            <h2>➕</h2>
            <h3>Add Service</h3>
        </a>

        <a href="my_services.php" class="action-card">
            <h2>🛠</h2>
            <h3>My Services</h3>
        </a>

        <a href="bookings.php" class="action-card">
            <h2>📅</h2>
            <h3>Bookings</h3>
        </a>

        <a href="reviews.php" class="action-card">
            <h2>⭐</h2>
            <h3>Reviews</h3>
        </a>

    </div>

    <div class="cards">

    <div class="card">
        <h2><?php echo $services_data['total_services']; ?></h2>
        <p>🛠 Total Services</p>
    </div>

    <div class="card">
        <h2><?php echo $pending_data['pending_bookings']; ?></h2>
        <p>⏳ Pending Bookings</p>
    </div>

    <div class="card">
        <h2><?php echo $bookings_data['total_bookings']; ?></h2>
        <p>📅 Total Bookings</p>
    </div>

    <div class="card">
        <h2><?php echo $completed_data['completed_jobs']; ?></h2>
        <p>✅ Completed Jobs</p>
    </div>

</div>

    <div class="help-box">

        <h2>Need Help?</h2>

        <p>
            Contact Handy Market support for bookings,
            payments and account assistance.
        </p>

        <a href="help.php">Contact Support</a>

    </div>

</div>

<script>

function openMenu(){
    document.getElementById('sidebar').classList.add('active');
    document.getElementById('overlay').classList.add('active');
}

function closeMenu(){
    document.getElementById('sidebar').classList.remove('active');
    document.getElementById('overlay').classList.remove('active');
}

</script>

</body>
</html>