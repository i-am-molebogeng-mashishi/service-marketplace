<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_services.php");
    exit();
}

$service_id = $_GET['id'];

$query = "
SELECT *
FROM services
WHERE id='$service_id'
";

$result = mysqli_query($conn, $query);

$service = mysqli_fetch_assoc($result);

if (!$service) {
    die("Service not found!");
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Payment Gateway</title>

    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>

<div class="container">

    <div class="card" style="
        max-width:500px;
        margin:auto;
        margin-top:50px;
    ">

        <h1 style="text-align:center;">
            Payment Gateway
        </h1>

        <h3>
            Service:
            <?php echo $service['title']; ?>
        </h3>

        <h2 style="color:green;">
            Amount: R <?php echo $service['price']; ?>
        </h2>

        <form method="POST" action="process_payment.php">

            <input type="hidden"
                   name="service_id"
                   value="<?php echo $service_id; ?>">

            <label>Card Holder Name</label>

            <input type="text"
                   name="card_name"
                   required
                   style="
                   width:100%;
                   padding:12px;
                   margin-top:10px;
                   margin-bottom:20px;
                   ">

            <label>Card Number</label>

            <input type="text"
                   name="card_number"
                   required
                   placeholder="1234 5678 9012 3456"
                   style="
                   width:100%;
                   padding:12px;
                   margin-top:10px;
                   margin-bottom:20px;
                   ">

            <label>Expiry Date</label>

            <input type="text"
                   name="expiry"
                   required
                   placeholder="MM/YY"
                   style="
                   width:100%;
                   padding:12px;
                   margin-top:10px;
                   margin-bottom:20px;
                   ">

            <label>CVV</label>

            <input type="password"
                   name="cvv"
                   required
                   placeholder="123"
                   style="
                   width:100%;
                   padding:12px;
                   margin-top:10px;
                   margin-bottom:20px;
                   ">

            <button class="btn" type="submit">
                Pay Now
            </button>

        </form>

    </div>

</div>

</body>
</html>