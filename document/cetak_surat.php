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
<style>
body {
    font-family: "Times New Roman";
    margin: 60px;
    font-size: 16px;
}

.kop {
    text-align: center;
    border-bottom: 3px solid black;
    padding-bottom: 10px;
}

.kop img {
    float: left;
    width: 80px;
}

.judul {
    font-size: 20px;
    font-weight: bold;
}

.isi {
    margin-top: 30px;
    line-height: 1.8;
    text-align: justify;
}

.ttd {
    margin-top: 80px;
    text-align: right;
}
</style>

<body onload="window.print()">

<div class="kop">
    <img src="../assets/img/logo_pgri.png">
    <div class="judul">
        PEMERINTAH KABUPATEN TAPIN<br>
        SDN PULAU PINANG 2
    </div>
</div>

<div class="isi">
    <p>Nomor : <?= $data['no_surat'] ?></p>
    <p><b>Perihal :</b> <?= $data['perihal'] ?></p>

    <br><br>

    <p><?= nl2br($data['isi_surat']) ?></p>
</div>

<div class="ttd">
    <p>Tapin <?= date('d F Y', strtotime($data['tanggal_surat'])) ?></p>

    <br><br><br>

    <b><?= $data['nama_ttd'] ?></b><br>
    NIP. <?= $data['nip_ttd'] ?>
</div>

</body>
</html>



