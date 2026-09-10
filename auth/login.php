<?php
session_start();

include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "
    SELECT *
    FROM users
    WHERE email='$email'
    LIMIT 1
    ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user['name'];
            $_SESSION['role'] = strtolower($user['role']);
            $_SESSION['user_id'] = $user['id'];

            if ($_SESSION['role'] == 'customer') {

                header("Location: ../customer/dashboard.php");
                exit();

            }

            if ($_SESSION['role'] == 'provider') {

                header("Location: ../provider/dashboard.php");
                exit();

            }

            if ($_SESSION['role'] == 'admin') {

                header("Location: ../admin/dashboard.php");
                exit();

            }

        } else {

            echo "<script>alert('Incorrect Password');</script>";
        }

    } else {

        echo "<script>alert('User Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Login | Handy Market</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:#f5f5f5;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            width:400px;
            background:white;
            padding:45px;
            border-radius:30px;
            box-shadow:0 10px 25px rgba(0,0,0,0.05);
        }

        h2{
            text-align:center;
            margin-bottom:10px;
            font-family:'Poppins',sans-serif;
            font-size:34px;
        }

        .subtitle{
            text-align:center;
            color:#666;
            margin-bottom:35px;
        }

        input{
            width:100%;
            padding:15px;
            border-radius:15px;
            border:1px solid #ddd;
            margin-bottom:20px;
            font-size:15px;
        }

        .password-box{
            position:relative;
        }

        .eye{
            position:absolute;
            right:15px;
            top:17px;
            cursor:pointer;
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:50px;
            background:#111;
            color:white;
            font-size:15px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            background:#333;
        }

        .bottom-text{
            text-align:center;
            margin-top:20px;
            color:#666;
        }

        .bottom-text a{
            color:#111;
            text-decoration:none;
            font-weight:600;
        }

    </style>

</head>

<body>

<div class="login-box">

    <h2>
        Welcome Back
    </h2>

    <p class="subtitle">
        Login to Handy Market
    </p>

    <form method="POST">

        <input type="email"
               name="email"
               placeholder="Email Address"
               required>

        <div class="password-box">

            <input type="password"
                   name="password"
                   id="password"
                   placeholder="Password"
                   required>

            <span class="eye"
                  onclick="togglePassword()">
                  👁
            </span>

        </div>

        <button type="submit">
            Login
        </button>

    </form>

    <div class="bottom-text">

        Don't have an account?

        <a href="register.php">
            Register
        </a>

    </div>

</div>

<script>

function togglePassword(){

    let password =
    document.getElementById("password");

    if(password.type === "password"){

        password.type = "text";

    } else {

        password.type = "password";
    }
}

</script>

</body>
</html>