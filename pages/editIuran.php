<?php
// require_once '../auth.php';
include '../db.php';

if (isset($_POST['update'])) {
    $id = (int) $_POST['idi'];

    // kondisi ambil bulan
    $bulan = !empty($_POST['pembayaran_ke'])
    ? implode(", ", $_POST['pembayaran_ke']) : "";

    $tgl = $_POST['tgl'];

 // bersihkan format rupiah 
    $jumlah_input = $_POST['jumlah'] ?? '';
    $jumlah = preg_replace('/[^0-9]/', '', $jumlah_input);

    // fallback kalo data pake 0
    $jumlah = $jumlah !== '' ? (int)$jumlah : 0;

    // ambil data lama
    $ambil = mysqli_query($conn, "SELECT jumlah_guru FROM pembayaran WHERE id= $id");
    if (!$ambil) {
        die("Data query gagal: " . mysqli_error($conn));
    }
    $data = mysqli_fetch_assoc($ambil);
    $jumlahGuru = $data['jumlah_guru'];
    $jumlah = $jumlahGuru * 10000;

    

    // update
    $update = mysqli_query($conn, " UPDATE pembayaran SET 
    pembayaran_ke = '$bulan',
    tgl_pembayaran = '$tgl',
    jumlah_pembayaran = '$jumlah' WHERE id = $id ");

    // debug jika gagal update
    if (!$update) {
        die("Update gagal: " . mysqli_error($conn));
    }

    // notifikasi jika berhasil edit pembayaran
    echo "<script>
        alert('Data berhasil diupdate');
        window.location.href='pembayaran.php';
    </script>";
}
