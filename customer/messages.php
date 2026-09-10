<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$sender = $_SESSION['user'];

if (isset($_POST['send'])) {

    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $sql = "
    INSERT INTO messages
    (sender_name, receiver_name, message)

    VALUES

    ('$sender', '$receiver', '$message')
    ";

    mysqli_query($conn, $sql);
}

$query = "
SELECT *
FROM messages
WHERE sender_name='$sender'
OR receiver_name='$sender'
ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<h2>Messages</h2>

<form method="POST">

    <input type="text"
           name="receiver"
           placeholder="Receiver Name"
           required>

    <br><br>

    <textarea name="message"
              placeholder="Type message..."
              required></textarea>

    <br><br>

    <button type="submit" name="send">
        Send Message
    </button>

</form>

<hr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<div style="
    border:1px solid #ddd;
    padding:10px;
    margin:10px;
    border-radius:8px;
">

    <p>
        <b>From:</b>
        <?php echo $row['sender_name']; ?>
    </p>

    <p>
        <b>To:</b>
        <?php echo $row['receiver_name']; ?>
    </p>

    <p>
        <?php echo $row['message']; ?>
    </p>

    <p style="font-size:12px;color:gray;">
        <?php echo $row['created_at']; ?>
    </p>

</div>

<?php } ?>