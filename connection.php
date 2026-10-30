<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "student_db";

$connection = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$connection) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>