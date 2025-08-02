<?php
session_start();
include "db.php";

//ambil data login di login.php
$username = $_POST['username'];
$password = md5($_POST['password']);

// koneksi login
$login = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'
AND password = '$password' ");
$cek = mysqli_num_rows($login);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);
    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];

    header("location:index.php?alert=login");
    exit;
} else {
    header("location:login.php?alert=gagal");
    exit;
}
