<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'provider') {
    header("Location: ../auth/login.php");
    exit();
}

$provider = $_SESSION['user'];

$query = "
SELECT *
FROM reviews
WHERE provider_name='$provider'
ORDER BY id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Customer Reviews | Handy Market</title>

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

.review-card{
    background:white;
    padding:25px;
    border-radius:25px;
    margin-bottom:20px;
    box-shadow:0 10px 20px rgba(0,0,0,0.04);
}

.customer{
    font-size:18px;
    font-weight:600;
    margin-bottom:10px;
}

.stars{
    font-size:22px;
    color:#f5b301;
    margin-bottom:15px;
}

.review-text{
    color:#555;
    line-height:1.7;
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
        Customer Reviews
    </h1>

    <?php if(mysqli_num_rows($result) > 0){ ?>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="review-card">

                <div class="customer">
                    👤 <?php echo $row['customer_name']; ?>
                </div>

                <div class="stars">

                    <?php
                    for($i=1; $i<=$row['rating']; $i++){
                        echo "⭐";
                    }
                    ?>

                </div>

                <div class="review-text">
                    "<?php echo $row['review']; ?>"
                </div>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="empty-box">

            <h3>No Reviews Yet</h3>

            <p>
                Customers have not reviewed your services yet.
            </p>

        </div>

    <?php } ?>

</div>

</body>
</html>