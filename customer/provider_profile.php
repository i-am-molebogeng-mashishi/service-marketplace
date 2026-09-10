<?php
session_start();

include("../includes/db.php");
include("../includes/nav.php");

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$provider = $_GET['provider'];

// GET PROVIDER INFO

$user_query = "
SELECT *
FROM users
WHERE name='$provider'
";

$user_result = mysqli_query($conn, $user_query);

$user = mysqli_fetch_assoc($user_result);

// GET SERVICES

$services_query = "
SELECT *
FROM services
WHERE provider_name='$provider'
ORDER BY id DESC
";

$services_result = mysqli_query($conn, $services_query);

// GET REVIEWS

$reviews_query = "
SELECT *
FROM reviews
WHERE provider_name='$provider'
ORDER BY id DESC
";

$reviews_result = mysqli_query($conn, $reviews_query);
?>

<h1>Provider Profile</h1>

<img
    src="../uploads/<?php echo $user['profile_image']; ?>"
    width="200"
    height="200"
    style="object-fit:cover; border-radius:50%;">

<br><br>

<h2>
    <?php echo $user['name']; ?>
</h2>

<p>

    <b>City:</b>

    <?php echo $user['city']; ?>

</p>

<p>

    <b>Experience:</b>

    <?php echo $user['experience']; ?> years

</p>

<p>

    <b>Verified:</b>

    <?php echo $user['verified']; ?>

</p>

<br>

<a href="add_review.php?provider=<?php echo $provider; ?>">

    <button>
        Leave Review
    </button>

</a>

<hr>

<h2>Services</h2>

<?php while ($service = mysqli_fetch_assoc($services_result)) { ?>

    <div style="
        border:1px solid #ccc;
        padding:15px;
        margin-bottom:15px;
        border-radius:10px;
        width:400px;
    ">

        <img
            src="../uploads/<?php echo $service['image']; ?>"
            width="100%"
            height="200"
            style="object-fit:cover; border-radius:10px;">

        <br><br>

        <h3>
            <?php echo $service['title']; ?>
        </h3>

        <p>
            <?php echo $service['description']; ?>
        </p>

        <p>

            <b>Price:</b>

            R<?php echo $service['price']; ?>

        </p>

    </div>

<?php } ?>

<hr>

<h2>Customer Reviews</h2>

<?php while ($review = mysqli_fetch_assoc($reviews_result)) { ?>

    <div style="
        border:1px solid #ccc;
        padding:15px;
        margin-bottom:15px;
        border-radius:10px;
        width:400px;
    ">

        <p>

            <b>Customer:</b>

            <?php echo $review['customer_name']; ?>

        </p>

        <p>

            <b>Rating:</b>

            <?php echo $review['rating']; ?>/5

        </p>

        <p>

            <?php echo $review['review']; ?>

        </p>

    </div>

<?php } ?>