<?php
session_start();

include("../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'provider') {
    header("Location: ../auth/login.php");
    exit();
}

// ADD SERVICE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $provider = $_SESSION['user'];

    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp_name, "../uploads/$image");

    $query = "
    INSERT INTO services
    (
        title,
        description,
        price,
        category,
        image,
        provider_name
    )
    VALUES
    (
        '$title',
        '$description',
        '$price',
        '$category',
        '$image',
        '$provider'
    )
    ";

    if (mysqli_query($conn, $query)) {

        echo "<script>
            alert('Service Added Successfully!');
            window.location='my_services.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Service | Handy Market</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            margin:0;
            font-family:'Inter',sans-serif;
            background:#f8f8f8;
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

        .form-box{
            background:#fff;
            padding:40px;
            border-radius:30px;
            max-width:700px;
            box-shadow:0 10px 20px rgba(0,0,0,0.04);
        }

        .form-box h1{
            margin-bottom:25px;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border-radius:20px;
            border:1px solid #ddd;
            font-size:15px;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        textarea{
            height:120px;
            resize:none;
        }

        button{
            background:#111;
            color:#fff;
            border:none;
            padding:15px 30px;
            border-radius:50px;
            cursor:pointer;
            font-family:'Poppins',sans-serif;
            font-size:15px;
        }

        button:hover{
            background:#333;
        }

    </style>

</head>

<body>

<?php
$menu_path = dirname(__DIR__) . "/includes/provider_menu.php";

if (file_exists($menu_path)) {
    include($menu_path);
} else {
    echo "Menu file not found: " . $menu_path;
}
?>

<div class="main">

    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>

    <div class="form-box">

        <h1>Add New Service</h1>

        <form method="POST" enctype="multipart/form-data">

            <input
                type="text"
                name="title"
                placeholder="Service Title"
                required
            >

            <textarea
                name="description"
                placeholder="Service Description"
                required
            ></textarea>

            <input
                type="number"
                name="price"
                placeholder="Price"
                required
            >

            <select name="category" required>

                <option value="">
                    Select Category
                </option>

                <option value="Plumbing">
                    Plumbing
                </option>

                <option value="Electrical">
                    Electrical
                </option>

                <option value="Cleaning">
                    Cleaning
                </option>

                <option value="Painting">
                    Painting
                </option>

            </select>

            <input
                type="file"
                name="image"
                required
            >

            <button type="submit">
                Add Service
            </button>

        </form>

    </div>

</div>

</body>
</html>