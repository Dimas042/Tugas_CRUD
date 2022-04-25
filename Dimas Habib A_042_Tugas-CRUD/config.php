<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "crud1";

$koneksi = mysqli_connect($server, $user, $pass, $database);

if (!$koneksi) {
    die("<script>alert('Connection Failed.')</script>");
}

?>