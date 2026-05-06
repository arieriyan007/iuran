<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../db.php";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
    }

    $id = (int) $_GET['id'];
    
    $query = mysqli_query($conn,"SELECT * FROM surat_keluar WHERE id=$id");

    if (!$query) {
        die("Query error: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Data tidak ditemukan");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
</head>
<body onload="window.print()">
    <h3 style="text-align:center">SDN Pulau Pinang 2</h3>
    <hr>

    <p>Nomor : <?= $data['no_surat'] ?></p>
    <p>Perihal : <?= $data['perihal'] ?></p>

    <br>

    <p><?= nl2br($data['isi_surat']) ?></p>

    <br><br>

    <div style="text-align:right">
        <p><?= date('d-m-Y', strtotime($data['tanggal_surat'])) ?></p>

        <br><br><br>

        <b><?= $data['nama_ttd'] ?></b> <br>
        NIP. <?= $data['nip_ttd'] ?>
    </div>
</body>
</html>



