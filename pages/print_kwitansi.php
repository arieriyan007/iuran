<?php
// require_once "../auth.php";
include '../db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $query = mysqli_query($conn, "SELECT 
        pembayaran.*, sekolah.nama_sekolah
        FROM pembayaran 
        JOIN sekolah ON pembayaran.nama_sekolah = sekolah.id_sekolah
        -- JOIN users ON pembayaran.user = users.id 
        WHERE pembayaran.id = '$id'") or die("SQL Error: " . mysqli_error($conn));

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
            font-family: 'Poppins', Arial, sans-serif;
            background: #fff;
            color: #222;
        }

        .receipt {
            width: 800px;
            margin: auto;
            padding: 40px 50px;
            position: relative;
        }

        .logo {
            /* display: block; */
            position: absolute;
            top: 25px;
            right: 60px;
            width: 120px;
        }

        .title {
            text-align: center;
        }

        .title h1 {
            font-size: 22px;
            color: #0b66d6;
            margin: 0;
            letter-spacing: 1px;
        }

        .title p {
            margin-top: 6px;
            font-size: 14px;
        }

        hr {
            margin: 25px 0 35px;
            border: none;
            border-top: 2px solid #0b66d6;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .info-table td {
            padding: 6px 0;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 220px;
            font-weight: 600;
        }

        .info-table .total td {
            padding-top: 14px;
            font-size: 16px;
            font-weight: 700;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }

        .signature .date,
        .signature .role {
            margin: 4px 0;
            font-size: 14px;
        }

        .signature .spacer {
            height: 60px;
        }

        .signature .name {
            font-weight: 700;
            text-decoration: underline;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        @media print {
            body {
                margin: 0;
            }

            .receipt {
                padding: 30px 40px;
            }

            .container {
                box-shadow: none;
                border: none;
            }

            .tanggal {
                margin-bottom: 4px;
            }

            .jabatan {
                margin-top: 0;
            }

        }
    </style>
</head>

<body onload="window.print()">

    <div class="receipt">
        <img src="../assets/img/logo_pgri.png" class="logo" />

        <div class="title">
            <h1>KWITANSI PEMBAYARAN</h1>
            <p>No. <?= 'KW-' . str_pad($data['id'], 3, '0', STR_PAD_LEFT); ?>
                | <?= date('dmY'); ?></p>
        </div>

        <hr>

        <table class="info-table">
            <tr>
                <td>Nama Sekolah</td>
                <td>: <?= $data['nama_sekolah']; ?></td>
            </tr>
            <tr>
                <td>Pembayaran Bulan</td>
                <td>: <?= $data['pembayaran_ke']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran</td>
                <td>: <?= date('d-m-Y', strtotime($data['tgl_pembayaran'])); ?></td>
            </tr>
            <tr class="total">
                <td>Jumlah Pembayaran</td>
                <td>: Rp <?= number_format($data['jumlah_pembayaran'], 0, ',', '.'); ?></td>
            </tr>
        </table>

        <div class="signature">
            <p class="date">Binuang, <?= date('d-m-Y', strtotime($data['tgl_pembayaran'])); ?></p>
            <p class="role">Bendahara PGRI Cab. Binuang</p>

            <div class="spacer"></div>

            <p class="name">Siti Patimah, S.Pd</p>
        </div>

        <div class="footer">
            Dicetak otomatis oleh sistem — <?= date('d/m/Y H:i'); ?>
        </div>
    </div>

</body>

</html>