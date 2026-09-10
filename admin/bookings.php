<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// DELETE BOOKING

if (isset($_GET['delete'])) {

    $booking_id = $_GET['delete'];

    $delete_query = "
    DELETE FROM bookings
    WHERE id='$booking_id'
    ";

    mysqli_query($conn, $delete_query);
}

// GET BOOKINGS

$query = "
SELECT bookings.*, services.title

FROM bookings

LEFT JOIN services
ON bookings.service_id = services.id

ORDER BY bookings.id DESC
";

$result = mysqli_query($conn, $query);
?>

<h1>Manage Bookings</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Service</th>
    <th>Customer</th>
    <th>Status</th>
    <th>Action</th>

</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td>
        <?php echo $row['id']; ?>
    </td>

    <td>
        <?php echo $row['title']; ?>
    </td>

    <td>
        <?php echo $row['customer_name']; ?>
    </td>

    <td>
        <?php echo $row['status']; ?>
    </td>

    <td>

        <a href="?delete=<?php echo $row['id']; ?>">

            <button>
                Delete
            </button>

        </a>

    </td>

</tr>

<?php } ?>

</table>