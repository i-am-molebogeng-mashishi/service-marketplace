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
FROM services
WHERE provider_name='$provider'
ORDER BY id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

    <title>My Services | Handy Market</title>

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

        .main h1{
            margin-bottom:30px;
        }

        .services-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:25px;
        }

        .service-card{
            background:#fff;
            border-radius:30px;
            overflow:hidden;
            box-shadow:0 10px 20px rgba(0,0,0,0.04);
            transition:0.3s;
        }

        .service-card:hover{
            transform:translateY(-5px);
        }

        .service-card img{
            width:100%;
            height:220px;
            object-fit:cover;
        }

        .service-content{
            padding:25px;
        }

        .service-content h3{
            margin-top:0;
            margin-bottom:10px;
        }

        .service-content p{
            color:#666;
            line-height:1.5;
        }

        .price{
            font-size:24px;
            font-weight:700;
            margin-top:15px;
        }

        .category{
            display:inline-block;
            margin-top:10px;
            background:#f2f2f2;
            padding:8px 16px;
            border-radius:50px;
            font-size:14px;
        }

        .empty-box{
            background:white;
            padding:40px;
            border-radius:30px;
            text-align:center;
            font-size:18px;
        }

    </style>

</head>

<body>

<?php include("../includes/provider_menu.php"); ?>

<div class="main">

    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>

    <h1>My Services</h1>

    <?php if(mysqli_num_rows($result) > 0){ ?>

    <div class="services-grid">

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <div class="service-card">

                <img src="../uploads/<?php echo $row['image']; ?>">

                <div class="service-content">

                    <h3>
                        <?php echo $row['title']; ?>
                    </h3>

                    <p>
                        <?php echo $row['description']; ?>
                    </p>

                    <div class="category">
                        <?php echo $row['category']; ?>
                    </div>

                    <div class="price">
                        R <?php echo $row['price']; ?>
                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

    <?php } else { ?>

        <div class="empty-box">

            <h3>No Services Yet</h3>

            <p>
                You have not added any services yet.
            </p>

        </div>

    <?php } ?>

</div>

</body>
</html>