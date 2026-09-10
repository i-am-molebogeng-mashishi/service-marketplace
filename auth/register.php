<?php
include("../includes/db.php");
session_start();

/* ================= REGISTER LOGIC ================= */

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $city = $_POST['city'];
    $area = $_POST['area'];

    /* PASSWORD CHECK */
    if($password !== $confirm_password){
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    /* PROFILE IMAGE */
    $profile_image = "";
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0){

        $profile_image = time() . "_profile_" . $_FILES['profile_image']['name'];

        move_uploaded_file(
            $_FILES['profile_image']['tmp_name'],
            "../uploads/" . $profile_image
        );
    }

    /* ID DOCUMENT */
    $id_document = "";
    if(isset($_FILES['id_document']) && $_FILES['id_document']['error'] == 0){

        $id_document = time() . "_id_" . $_FILES['id_document']['name'];

        move_uploaded_file(
            $_FILES['id_document']['tmp_name'],
            "../uploads/" . $id_document
        );
    }

    /* INSERT USER */
    $query = "INSERT INTO users 
    (name, email, password, role, city, area, profile_image, id_document, verified)
    VALUES 
    ('$name', '$email', '$hashed_password', '$role', '$city', '$area', '$profile_image', '$id_document', 'pending')";

    if(mysqli_query($conn, $query)){
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register | Handy Market</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:#f5f5f5;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.container{
    background:#fff;
    padding:35px;
    width:420px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

h2{
    font-family:'Poppins',sans-serif;
    text-align:center;
    margin-bottom:20px;
    color:#000;
}

input, select{
    width:100%;
    padding:12px;
    margin:8px 0;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:14px;
}

input:focus, select:focus{
    outline:none;
    border-color:#000;
}

/* PASSWORD WRAPPER */
.pass-wrapper{
    position:relative;
}

.pass-wrapper span{
    position:absolute;
    right:10px;
    top:12px;
    cursor:pointer;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:30px;
    background:#000;
    color:#fff;
    font-weight:600;
    cursor:pointer;
}

button:hover{
    background:#333;
}

a{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#000;
    text-decoration:none;
}

a:hover{
    text-decoration:underline;
}

.error{
    color:red;
    font-size:13px;
    margin-top:5px;
}

</style>

</head>

<body>

<div class="container">

    <h2>Create Account</h2>

    <form method="POST" enctype="multipart/form-data" onsubmit="return validatePasswords()">

        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <!-- PASSWORD -->
        <div class="pass-wrapper">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span onclick="togglePassword('password')">👁️</span>
        </div>

        <!-- CONFIRM PASSWORD -->
        <div class="pass-wrapper">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <span onclick="togglePassword('confirm_password')">👁️</span>
        </div>

        <div id="error" class="error"></div>

        <select name="role" required>
            <option value="customer">Customer</option>
            <option value="provider">Provider</option>
        </select>

        <input type="text" name="city" placeholder="City">

        <input type="text" name="area" placeholder="Area">

        <label>Profile Picture</label>
        <input type="file" name="profile_image" accept="image/*">

        <label>ID Document</label>
        <input type="file" name="id_document" accept="image/*,.pdf">

        <button type="submit">Register</button>

    </form>

    <a href="login.php">Already have an account? Login</a>

</div>

<script>

// TOGGLE PASSWORD
function togglePassword(id){
    let input = document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
    } else {
        input.type = "password";
    }
}

// VALIDATE PASSWORDS
function validatePasswords(){

    let pass = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;
    let error = document.getElementById("error");

    if(pass !== confirm){
        error.innerHTML = "Passwords do not match!";
        return false;
    }

    return true;
}

</script>

</body>
</html>