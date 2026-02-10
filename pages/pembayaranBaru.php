<?php
// require_once "../auth.php";
include '../db.php';

if (isset($_POST['addPembayaran'])) {
    $sekolah = $_POST['sekolah'];
    $jmlhGuru = (int) $_POST['jmlhGuru'];
    $bayar = $_POST['pembayaran_ke'];
    $tgl = $_POST['tglBayar'];

    // ubah biaya iuran jika dibutuhkan
    $iuranGuru = 10000;

    $jumlah = $jmlhGuru * $iuranGuru; // rumus hitung otomatis

    if ($sekolah && $jmlhGuru > 0 && $jumlah > 0 && $tgl && !empty($bayar)) {
        // menggabungkan bulan saat di pilih pada cekbox
        $gabung_bulan = implode(", ", $bayar);

        $data = $conn->prepare("INSERT INTO pembayaran (nama_sekolah, pembayaran_ke, tgl_pembayaran, jumlah_guru, iuran_per_guru, jumlah_pembayaran) 
        VALUES (?, ?, ?, ?, ?, ?)");
        $data->bind_param("issiii", $sekolah, $gabung_bulan, $tgl, $jmlhGuru, $iuranGuru, $jumlah);
        $data->execute();

        echo "<script>alert('Data berhasil disimpan'); window.location.href='pembayaran.php';</script>";
    } else {
        echo "<script>alert('Pastikan semua data terisi'); window.history.back();</script>";
    }
}
