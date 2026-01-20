<?php
include '../db.php';
session_start();

if (isset($_POST['addPengeluaran'])) {
    $danaKeluar = $_POST['danaKeluar'];
    $tglKeluar = $_POST['tglKeluar'];
    $jumlahKeluar = $_POST['jumlahKeluar'];

    $data = $conn->prepare("INSERT INTO pengeluaran (keterangan, tgl, jumlah) VALUES (?, ?, ?)");
    $data->bind_param("ssi", $danaKeluar, $tglKeluar, $jumlahKeluar);
    $data->execute();

    echo "<script>alert('Data berhasil disimpan'); window.location.href='pengeluaran.php';</script>";
} else {
    echo "<script>alert('Pastikan semua data terisi'); window.history.back();</script>";
}

// include '../db.php';
// session_start();

// if (
//     isset($_POST['addPengeluaran']) &&
//     !empty($_POST['keterangan']) &&
//     !empty($_POST['jumlah'])
// ) {
//     $keterangan = $_POST['keterangan'];
//     $jumlah     = (float) $_POST['jumlah'];

//     // opsional: kalau pakai login
//     $user_id = $_SESSION['user_id'] ?? null;

//     // kalau tgl diisi dari form
//     if (!empty($_POST['tgl'])) {
//         $tgl = $_POST['tgl'];

//         $sql = "INSERT INTO pengeluaran (keterangan, tgl, jumlah, user_id)
//                 VALUES (?, ?, ?, ?)";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ssdi", $keterangan, $tgl, $jumlah, $user_id);
//     } else {
//         // pakai CURRENT_TIMESTAMP dari database
//         $sql = "INSERT INTO pengeluaran (keterangan, jumlah, user_id)
//                 VALUES (?, ?, ?)";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("sdi", $keterangan, $jumlah, $user_id);
//     }

//     if ($stmt->execute()) {
//         echo "<script>alert('Data berhasil disimpan'); window.location.href='pengeluaran.php';</script>";
//     } else {
//         echo "<script>alert('Gagal menyimpan data'); window.history.back();</script>";
//     }
// } else {
//     echo "<script>alert('Pastikan semua data terisi'); window.history.back();</script>";
// }
