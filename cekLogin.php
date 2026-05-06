<?php
session_start();
include "db.php";

//ambil data login di login.php
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Username dan password wajib diisi";
    header("Location: login.php");
    exit;
}

// prepared untuk kunci sql injection dan koneksi ke db
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'];

    header("Location:index.php?alert=login");
    exit;
    } else {
        // gagal login notifikasi
        $_SESSION['error'] = "Username dan password salah";
        header("Location: login.php");
        exit;
    }
