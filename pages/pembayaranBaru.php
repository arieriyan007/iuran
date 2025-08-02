<?php
include '../db.php';

if (isset($_POST['addPembayaran'])) {
    $sekolah = $_POST['sekolah'];
    $bayar = $_POST['pembayaran_ke'];
    $tgl = $_POST['tglBayar'];
    $jumlah = $_POST['jumlah'];

    if ($sekolah && $jumlah && $tgl && !empty($bayar)) {
        // menggabungkan bulan saat di pilih pada cekbox
        $gabung_bulan = implode(", ", $bayar);

        $data = $conn->prepare("INSERT INTO pembayaran (nama_sekolah, pembayaran_ke, tgl_pembayaran, jumlah_pembayaran) VALUES (?, ?, ?, ?)");
        $data->bind_param("issi", $sekolah, $gabung_bulan, $tgl, $jumlah);
        $data->execute();

        echo "<script>alert('Data berhasil disimpan'); window.location.href='pembayaran.php';</script>";
    } else {
        echo "<script>alert('Pastikan semua data terisi'); window.history.back();</script>";
    }
}
