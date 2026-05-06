<?php
session_start();
include "db.php";

//ambil data login di login.php
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// prepared untuk kunci sql injection dan koneksi ke db
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $login = false;

    // cek password hash
    if (password_verify($password, $user['password'])) {
        $login = true;

        // cek password md5 lama
    } elseif (md5($password) === $user['password']) {
        $login = true;

        // ubah ke password hash dari md5
        $newHash = password_hash($password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $update->bind_param("si", $newHash, $user['id']);
        $update->execute();
    }

    if ($login) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'];

    header("Location:index.php?alert=login");
    exit;
    }   
}

// gagal login notifikasi
$_SESSION['error'] = "Username dan password salah";
header("Location:login.php");
exit;