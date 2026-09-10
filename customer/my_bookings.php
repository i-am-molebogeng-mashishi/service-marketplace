<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$customer = $_SESSION['user'];

$query = "
SELECT bookings.id, bookings.status, services.title, services.provider_name
FROM bookings
JOIN services ON bookings.service_id = services.id
WHERE bookings.customer_name='$customer'
ORDER BY bookings.id DESC
";

$result = mysqli_query($conn, $query);
?>

<h1>My Bookings</h1>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Service</th>
    <th>Provider</th>
    <th>Status</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['provider_name']; ?></td>
    <td>
        <span style="
            padding:5px 10px;
            border-radius:5px;
            color:white;
            background:
            <?php 
                if ($row['status'] == 'Accepted') echo 'green';
                else if ($row['status'] == 'Rejected') echo 'red';
                else echo 'orange';
            ?>
        ">
            <?php echo $row['status']; ?>
        </span>
    </td>
</tr>

<?php } ?>

</table>
