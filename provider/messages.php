<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>

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
}

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

.container{
    max-width:1200px;
    margin:auto;
    padding:40px;
}

.messages-box{
    background:white;
    border-radius:25px;
    padding:30px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
    min-height:500px;
}

h1{
    margin-bottom:15px;
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

<div class="container">

    <div class="messages-box">

        <h1>💬 Messages</h1>

        <p>View and respond to customer messages.</p>

        <br><br>

       <?php
// get messages for this provider
$provider_name = $_SESSION['user'];

$query = "
SELECT * FROM messages
WHERE receiver_name='$provider_name'
ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<h2>Inbox</h2>

<?php if (mysqli_num_rows($result) > 0): ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>

        <div style="
            background:#f9f9f9;
            padding:15px;
            margin-bottom:10px;
            border-radius:12px;
            border:1px solid #eee;
        ">

            <p><b>From:</b> <?php echo $row['sender_name']; ?></p>

            <p style="margin-top:8px;">
                <?php echo $row['message']; ?>
            </p>

            <small style="color:#777;">
                <?php echo $row['created_at']; ?>
            </small>

        </div>

    <?php endwhile; ?>

<?php else: ?>

    <p>No messages yet.</p>

<?php endif; ?>
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