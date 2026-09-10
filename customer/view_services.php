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

<title>Browse Services</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:#f5f5f5;
}

.main{
    margin-left:260px;
    padding:40px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

.card{
    background:white;
    padding:30px;
    border-radius:30px;
}

.btn{
    display:inline-block;
    margin-top:15px;
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

<h1>Browse Services</h1>

<?php
include("../includes/db.php");

$result = mysqli_query($conn, "SELECT * FROM services");
?>

<div class="grid">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card">

        <h3><?php echo $row['service_name']; ?></h3>

        <p><b>Provider:</b> <?php echo $row['provider_name']; ?></p>

        <!-- MESSAGE BUTTON -->
        <form method="POST" action="../provider/messages.php">

            <input type="hidden" name="sender_name" value="<?php echo $_SESSION['user']; ?>">
            <input type="hidden" name="receiver_name" value="<?php echo $row['provider_name']; ?>">

            <textarea name="message" placeholder="Write message..." required></textarea>

            <button class="btn" type="submit" name="send_message">
                💬 Message
            </button>

        </form>

        <a class="btn" href="book.php?service=<?php echo $row['id']; ?>">
            Book
        </a>

    </div>

<?php } ?>

</div>

</div>

</body>
</html>