<?php
session_start();
include '../db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // ambil data untuk log
    $ambil = mysqli_query($conn, "SELECT p.id, s.nama_sekolah
    FROM pembayaran p
    JOIN sekolah s ON s.id_sekolah = p.nama_sekolah
    WHERE p.id = $id");

    $data = mysqli_fetch_assoc($ambil);
    $namaSekolah = $data['nama_sekolah'] ?? 'Tidak diketahui';

    // query hapus
    $hapus = mysqli_query($conn, "DELETE FROM pembayaran WHERE id = $id");

    if (!$hapus) {
        $_SESSION['error'] = "Gagal Menghapus Data";
    } else {
        // log aktivitas
        $user = $_SESSION['username'] ?? 'admin';

        mysqli_query($conn, "INSERT INTO log_aktivitas (aksi, deskripsi, user, created_at)
        VALUES ('DELETE', 
        'Menghapus data pembayaran sekolah: $namaSekolah (ID : $id)',
        '$user', NOW() )
        ");

        $_SESSION['success'] = "Data berhasil dihapus";

    }

    header("location: pembayaran.php");
    exit;
}

?>