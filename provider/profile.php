<?php
session_start();
include("../includes/db.php");

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user data
$query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle profile update
if (isset($_POST['update_profile'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $experience = $_POST['experience'];
    $business_name = $_POST['business_name'];
    $bio = $_POST['bio'];

    // Profile image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $image_name = time() . "_" . $_FILES['profile_image']['name'];
        $tmp = $_FILES['profile_image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/" . $image_name);
    } else {
        $image_name = $user['profile_image'];
    }

    $update = "
        UPDATE users SET
        name='$name',
        email='$email',
        phone='$phone',
        city='$city',
        area='$area',
        experience='$experience',
        business_name='$business_name',
        bio='$bio',
        profile_image='$image_name'
        WHERE id='$user_id'
    ";

    mysqli_query($conn, $update);

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Provider Profile</title>
    <link rel="stylesheet" href="../assets/style.css">

    <style>
        
        body{
    font-family:'Inter',sans-serif;
    background:#f7f7f7;
}

.container{
    max-width:1000px;
    margin:auto;
    padding:40px;
}

       .profile-card{
    background:white;
    padding:35px;
    border-radius:25px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
} 

        .profile-img{
    width:140px;
    height:140px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:20px;
}

        .verified {
            color: green;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        button{
    padding:12px 20px;
    background:#111;
    color:white;
    border:none;
    border-radius:50px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#333;
}

        button:hover {
            background: #0056b3;
        }

        .section-title {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .side-panel {
    position: fixed;
    right: -400px;
    top: 0;
    width: 350px;
    height: 100%;
    background: white;
    box-shadow: -2px 0 10px rgba(0,0,0,0.2);
    padding: 20px;
    transition: 0.3s;
    overflow-y: auto;
    z-index: 999;
}

.side-panel.open {
    right: 0;
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.close-btn {
    font-size: 25px;
    cursor: pointer;
}

.side-panel input,
.side-panel textarea {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
}

.side-panel button{
    width:100%;
    padding:12px;
    background:#111;
    color:white;
    border:none;
    border-radius:50px;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
    z-index: 998;
}

/* When active */
.overlay.show {
    opacity: 1;
    visibility: visible;
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
    color:#111;
}

.logo{
    font-size:24px;
    font-weight:700;
}

/* SIDEBAR */

.sidebar{
    position:fixed;
    left:-300px;
    top:0;
    width:280px;
    height:100%;
    background:white;
    z-index:1000;
    transition:0.3s;
    padding:25px;
    box-shadow:0 0 20px rgba(0,0,0,0.1);
}

.sidebar.active{
    left:0;
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

.menu-close{
    font-size:22px;
    cursor:pointer;
    margin-bottom:25px;
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

<div class="sidebar" id="sidebar">

    <div class="menu-close" onclick="closeMenu()">✖ Close</div>

    <a href="../home.php">🏠 Home</a>

    <a href="dashboard.php">📊 Dashboard</a>

    <a href="profile.php">👤 Profile</a>

    <a href="add_service.php">➕ Add Service</a>

    <a href="my_services.php">🛠 My Services</a>

    <a href="bookings.php">📅 Manage Bookings</a>

    <a href="reviews.php">⭐ Reviews</a>

    <a href="../customer/dashboard.php">🔄 Switch to Customer</a>

    <a href="help.php">❓ Help & Contact</a>

    <a href="../auth/logout.php">🚪 Logout</a>

</div>
   


<div class="container">
    <!-- DARK BACKGROUND OVERLAY -->
<div id="profileOverlay" class="overlay" onclick="closeEditPanel()"></div>

    <div class="profile-card">

        <h2>My Profile</h2>

        <!-- PROFILE IMAGE -->
        <?php if (!empty($user['profile_image'])): ?>
            <img src="../uploads/<?php echo $user['profile_image']; ?>" class="profile-img">
        <?php else: ?>
            <img src="../assets/default.png" class="profile-img">
        <?php endif; ?>

        <!-- NAME -->
        <h3>
            <?php echo $user['business_name'] ?? $user['name']; ?>
        </h3>

        <!-- DETAILS -->
        <p><b>Email:</b> <?php echo $user['email'] ?? '-'; ?></p>
        <p><b>Phone:</b> <?php echo $user['phone'] ?? 'Not added'; ?></p>
        <p><b>City:</b> <?php echo $user['city'] ?? 'Not added'; ?></p>
        <p><b>Area:</b> <?php echo $user['area'] ?? 'Not added'; ?></p>
        <p><b>Experience:</b> <?php echo $user['experience'] ?? '0'; ?> years</p>
        <p><b>Business:</b> <?php echo $user['business_name'] ?? 'Not added'; ?></p>

        <!-- ABOUT -->
        <h3>About Me</h3>
        <p><?php echo $user['bio'] ?? 'No description yet'; ?></p>

        <!-- EDIT BUTTON -->
        <button onclick="openEditPanel()">Edit Profile</button>

    </div>

</div>

<div id="editPanel" class="side-panel">

    <div class="panel-header">
        <h3>Edit Profile</h3>
        <span onclick="closeEditPanel()" class="close-btn">&times;</span>
    </div>

    <form method="POST" enctype="multipart/form-data">

        <label>Full Name</label>
        <input type="text" name="name" value="<?php echo $user['name'] ?? ''; ?>">

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user['email'] ?? ''; ?>">

        <label>Phone</label>
        <input type="text" name="phone" value="<?php echo $user['phone'] ?? ''; ?>">

        <label>City</label>
        <input type="text" name="city" value="<?php echo $user['city'] ?? ''; ?>">

        <label>Area</label>
        <input type="text" name="area" value="<?php echo $user['area'] ?? ''; ?>">

        <label>Experience</label>
        <input type="number" name="experience" value="<?php echo $user['experience'] ?? ''; ?>">

        <label>Business Name</label>
        <input type="text" name="business_name" value="<?php echo $user['business_name'] ?? ''; ?>">

        <label>About You</label>
        <textarea name="bio"><?php echo $user['bio'] ?? ''; ?></textarea>

        <label>Profile Image</label>
        <input type="file" name="profile_image">

        <button type="submit" name="update_profile">Save Changes</button>

    </form>

</div>

<script>
function openEditPanel() {
    document.getElementById("editPanel").classList.add("open");
    document.getElementById("profileOverlay").classList.add("show");
}

function closeEditPanel() {
    document.getElementById("editPanel").classList.remove("open");
    document.getElementById("profileOverlay").classList.remove("show");
}

function openMenu(){
    document.getElementById('sidebar').classList.add('active');
}

function closeMenu(){
    document.getElementById('sidebar').classList.remove('active');
}

</script>

</body>
</html>