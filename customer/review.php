<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$provider_id = $_GET['provider_id'];

if (isset($_POST['submit_review'])) {

    $customer_name = $_SESSION['user'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $sql = "INSERT INTO ratings
            (provider_id, customer_name, rating, review)
            VALUES
            ('$provider_id', '$customer_name', '$rating', '$review')";

    if (mysqli_query($conn, $sql)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error submitting review";
    }
}
?>

<h2>Leave Review</h2>

<form method="POST">

    <label>Rating (1-5)</label>
    <br><br>

    <input type="number"
           name="rating"
           min="1"
           max="5"
           required>

    <br><br>

    <textarea name="review"
              placeholder="Write your review"
              required></textarea>

    <br><br>

    <button type="submit" name="submit_review">
        Submit Review
    </button>

</form>