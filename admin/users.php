<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// VERIFY USER

if (isset($_GET['verify'])) {

    $user_id = $_GET['verify'];

    $verify_query = "
    UPDATE users
    SET verified='yes'
    WHERE id='$user_id'
    ";

    mysqli_query($conn, $verify_query);
}

// DELETE USER

if (isset($_GET['delete'])) {

    $user_id = $_GET['delete'];

    $delete_query = "
    DELETE FROM users
    WHERE id='$user_id'
    ";

    mysqli_query($conn, $delete_query);
}

// GET USERS

$query = "
SELECT *
FROM users
ORDER BY id DESC
";

$result = mysqli_query($conn, $query);
?>

<h1>Manage Users</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Verified</th>
    <th>Actions</th>

</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td>
        <?php echo $row['id']; ?>
    </td>

    <td>
        <?php echo $row['name']; ?>
    </td>

    <td>
        <?php echo $row['email']; ?>
    </td>

    <td>
        <?php echo $row['role']; ?>
    </td>

    <td>
        <?php echo $row['verified']; ?>
    </td>

    <td>

        <a href="?verify=<?php echo $row['id']; ?>">

            <button>
                Verify
            </button>

        </a>

        <a href="?delete=<?php echo $row['id']; ?>">

            <button>
                Delete
            </button>

        </a>

    </td>

</tr>

<?php } ?>

</table>