<?php

// ini dibuat agar jika session_start(); terlalu banyak itu bisa di ignore
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once "db.php";
