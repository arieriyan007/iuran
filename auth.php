<?php
session_start();

// if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
//     header("location: login.php");
//     exit; }

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once "db.php";
