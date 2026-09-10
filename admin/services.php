<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// DELETE SERVICE

if (isset($_GET['delete'])) {

    $service_id = $_GET['delete'];

    $delete_query = "
    DELETE FROM services
    WHERE id='$service_id'
    ";

    mysqli_query($conn, $delete_query);
}

// GET SERVICES

$query = "
SELECT *
FROM services
ORDER BY id DESC
";

$result = mysqli_query($conn, $query);
?>

<h1>Manage Services</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Title</th>
    <th>Provider</th>
    <th>Price</th>
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
        <?php echo $row['provider_name']; ?>
    </td>

    <td>
        R<?php echo $row['price']; ?>
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