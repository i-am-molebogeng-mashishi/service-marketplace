<style>

.topbar{
    background:#ffffff;
    padding:18px 25px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:2px solid #e5e5e5;
}

.menu-btn{
    font-size:32px;
    cursor:pointer;
    border:none;
    background:none;
    color:#111;
    font-weight:bold;
}

.logo{
    font-size:24px;
    font-weight:700;
    font-family:'Poppins',sans-serif;
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
    z-index:998;
}

.overlay.active{
    display:block;
}

</style>

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
    <a href="profile.php">👤 My Profile</a>
    <a href="add_service.php">➕ Add Service</a>
    <a href="my_services.php">🛠 My Services</a>
    <a href="bookings.php">📅 Manage Bookings</a>
    <a href="reviews.php">⭐ Reviews</a>
    <a href="../customer/dashboard.php">🔄 Switch to Customer</a>
    <a href="help.php">❓ Help & Contact</a>
    <a href="../auth/logout.php">🚪 Logout</a>

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