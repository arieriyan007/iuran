<?php
include '../db.php';

if (isset($_POST['update'])) {
    $id = $_POST['idi'];
    // $sekolah = $_POST['sekolah'];
    $bulan = implode(", ", $_POST['pembayaran_ke']);
    $tgl = $_POST['tgl'];
    $jumlah = $_POST['jumlah'];

    // ambil data jumlah_bayaran lama
    $query = mysqli_query($conn, "SELECT jumlah_pembayaran FROM pembayaran WHERE id = '$id'");
    $datalama = mysqli_fetch_assoc($query);
    $jumlah_lama = $datalama['jumlah_pembayaran'];

    // gunakan jumlah lama jika tidak ada update pembayaran baru
    if (empty($jumlah)) {
        $jumlah = $jumlah_lama;
    }

    // update data
    $update = mysqli_query($conn, "UPDATE pembayaran SET 
    -- nama_sekolah = '$sekolah',
    pembayaran_ke = '$bulan',
    tgl_pembayaran = '$tgl',
    jumlah_pembayaran = '$jumlah'
    WHERE id = $id
    ");

    header("location:pembayaran.php?status=updated");
}
