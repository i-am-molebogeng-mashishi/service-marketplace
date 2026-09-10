<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'provider') {
    header("Location: ../auth/login.php");
    exit();
}

$provider = $_SESSION['user'];
function updateStatus($conn, $id, $status) {
    $id = mysqli_real_escape_string($conn, $id);
    $status = mysqli_real_escape_string($conn, $status);

    mysqli_query($conn, "
        UPDATE bookings 
        SET status='$status' 
        WHERE id='$id'
    ");
}

if (isset($_GET['accept'])) {
    updateStatus($conn, $_GET['accept'], 'Accepted');
    header("Location: bookings.php");
    exit();
}

if (isset($_GET['reject'])) {
    updateStatus($conn, $_GET['reject'], 'Rejected');
    header("Location: bookings.php");
    exit();
}

if (isset($_GET['start'])) {
    updateStatus($conn, $_GET['start'], 'In Progress');
    header("Location: bookings.php");
    exit();
}

if (isset($_GET['complete'])) {
    updateStatus($conn, $_GET['complete'], 'Completed');
    header("Location: bookings.php");
    exit();
}

$query = "
SELECT bookings.*, services.title
FROM bookings
JOIN services ON bookings.service_id = services.id
WHERE services.provider_name='$provider'
ORDER BY bookings.id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Bookings | Handy Market</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    background:#f8f8f8;
    font-family:'Inter',sans-serif;
}

h1,h2,h3{
    font-family:'Poppins',sans-serif;
}

.main{
    padding:40px;
}

.back-btn{
    display:inline-block;
    margin-bottom:20px;
    text-decoration:none;
    color:#111;
    font-weight:600;
    font-family:'Poppins',sans-serif;
}

.page-title{
    margin-bottom:30px;
}

.booking-card{
    background:white;
    padding:25px;
    border-radius:25px;
    margin-bottom:20px;
    box-shadow:0 10px 20px rgba(0,0,0,0.04);
}

.booking-card h3{
    margin-top:0;
    margin-bottom:10px;
}

.booking-info{
    color:#555;
    margin-bottom:15px;
}

.status{
    display:inline-block;
    padding:8px 16px;
    border-radius:30px;
    color:white;
    font-size:14px;
    margin-bottom:15px;
}

.pending{
    background:orange;
}

.accepted{
    background:green;
}

.rejected{
    background:red;
}

.btn{
    display:inline-block;
    padding:10px 18px;
    border-radius:30px;
    text-decoration:none;
    color:white;
    margin-right:10px;
    font-size:14px;
}

.accept-btn{
    background:green;
}

.reject-btn{
    background:red;
}

.empty-box{
    background:white;
    padding:40px;
    border-radius:25px;
    text-align:center;
}

</style>

</head>

<body>

<?php include("../includes/provider_menu.php"); ?>

<div class="main">

    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>

    <h1 class="page-title">
        Manage Bookings
    </h1>

    <?php if(mysqli_num_rows($result) > 0){ ?>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="booking-card">

                <h3>
                    <?php echo $row['title']; ?>
                </h3>

                <div class="booking-info">
                    <strong>Booking ID:</strong>
                    <?php echo $row['id']; ?>
                </div>

                <div class="booking-info">
                    <strong>Customer:</strong>
                    <?php echo $row['customer_name']; ?>
                </div>

                <?php
                $statusClass = "pending";

                if($row['status'] == "Accepted"){
                    $statusClass = "accepted";
                }

                if($row['status'] == "Rejected"){
                    $statusClass = "rejected";
                }
                ?>

                <div class="status <?php echo $statusClass; ?>">
                    <?php echo $row['status']; ?>
                </div>

                <br>

               
            </div>

            <div style="margin-top:15px;">

<?php if ($row['status'] == "Pending") { ?>

    <a class="btn accept-btn"
       href="?accept=<?php echo $row['id']; ?>">
        Accept
    </a>

    <a class="btn reject-btn"
       href="?reject=<?php echo $row['id']; ?>">
        Reject
    </a>

<?php } ?>


<?php if ($row['status'] == "Accepted") { ?>

    <a class="btn"
       style="background:#3498db;"
       href="?start=<?php echo $row['id']; ?>">
        Start Job
    </a>

<?php } ?>


<?php if ($row['status'] == "In Progress") { ?>

    <a class="btn"
       style="background:#2ecc71;"
       href="?complete=<?php echo $row['id']; ?>">
        Complete
    </a>

<?php } ?>


<?php if ($row['status'] == "Completed") { ?>

    <span class="btn" style="background:gray; cursor:default;">
        Completed
    </span>

<?php } ?>


<?php if ($row['status'] == "Rejected") { ?>

    <span class="btn" style="background:red; cursor:default;">
        Rejected
    </span>

<?php } ?>

</div>

        <?php } ?>

    <?php } else { ?>

        <div class="empty-box">

            <h3>No Bookings Yet</h3>

            <p>
                You currently have no booking requests.
            </p>

        </div>

    <?php } ?>

</div>

</body>
</html>