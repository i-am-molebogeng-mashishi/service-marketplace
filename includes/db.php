<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "service_marketplace"
);

if (!$conn) {

    die("Database Connection Failed");

}
?>