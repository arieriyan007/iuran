<?php
// require_once "../auth.php";
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT 
        pembayaran.*, sekolah.nama_sekolah, users.nama
        FROM pembayaran 
        JOIN sekolah ON pembayaran.nama_sekolah = sekolah.id_sekolah
        JOIN users ON pembayaran.user = users.id 
        WHERE pembayaran.id = '$id'");

    $data = mysqli_fetch_assoc($query);
    if (!$data) {
        die("Data tidak ditemukan.");
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #eef1f5;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .logo {
            position: absolute;
            top: 40px;
            right: 50px;
            width: 80px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0077cc;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #0077cc;
            margin: 0;
        }

        .info p {
            margin: 10px 0;
            font-size: 15px;
        }

        .label {
            display: inline-block;
            width: 180px;
            font-weight: 600;
        }

        .total {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            line-height: 1.5;
        }

        .signature img {
            width: 100px;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 40px;
            color: #888;
        }

        @media print {
            body {
                background: none;
                margin: 0;
            }

            .container {
                box-shadow: none;
                border: none;
            }

            .logo {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">
        <img src="../assets/img/logo.png" alt="Logo" class="logo" />

        <div class="header">
            <h2>KWITANSI PEMBAYARAN</h2>
            <small>No: <?= 'KW-' . str_pad($data['id'], 3, '0', STR_PAD_LEFT); ?> | <?= date('d F Y'); ?></small>
        </div>

        <div class="info">
            <p><span class="label">Nama Sekolah</span>: <?= $data['nama_sekolah']; ?></p>
            <p><span class="label">Pembayaran Ke</span>: <?= $data['pembayaran_ke']; ?></p>
            <p><span class="label">Tanggal Pembayaran</span>: <?= date('d-m-Y', strtotime($data['tgl_pembayaran'])); ?></p>
            <p class="total"><span class="label">Jumlah Pembayaran</span>: Rp <?= number_format($data['jumlah_pembayaran'], 0, ',', '.'); ?></p>
        </div>

        <div class="signature">
            <p>Petugas,</p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= urlencode('ID: ' . $data['id'] . ', Nama Sekolah: ' . $data['nama_sekolah']) ?>" alt="QR Code">
            <p><strong><?= $data['nama_sekolah']; ?></strong></p>
        </div>

        <div class="footer">
            Dicetak otomatis oleh sistem — <?= date('d/m/Y H:i'); ?>
        </div>
    </div>

</body>

</html>