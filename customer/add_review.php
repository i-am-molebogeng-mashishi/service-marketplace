<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$provider = $_GET['provider'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $customer = $_SESSION['user'];

    $query = "
    INSERT INTO reviews
    (provider_name, customer_name, rating, review)

    VALUES

    ('$provider', '$customer', '$rating', '$review')
    ";

    mysqli_query($conn, $query);

    echo "Review added successfully!";
}
?>

<h1>Add Review</h1>

<form method="POST">

    <label>Rating (1-5)</label>

    <br><br>

    <input type="number"
           name="rating"
           min="1"
           max="5"
           required>

    <br><br>

    <textarea
        name="review"
        placeholder="Write your review"
        required></textarea>

    <br><br>

    <button type="submit">
        Submit Review
    </button>

</form>