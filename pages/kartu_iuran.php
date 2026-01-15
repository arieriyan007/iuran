<?php
// require_once "../auth.php";
include '../db.php';
// Data contoh (biasanya diambil dari database)
$query = mysqli_query($conn, "SELECT 
pembayaran.*, sekolah.nama_sekolah
FROM pembayaran
JOIN sekolah ON pembayaran.nama_sekolah = sekolah.id_sekolah");

$q = mysqli_fetch_assoc($query);

// $link_sekolah = $q['nama_sekolah'];

// QR Code link (menggunakan api.qrserver.com)
// $qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=" . urlencode($link_sekolah);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Pembayaran Iuran Guru</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            padding-left: 8rem;
            padding-right: 7rem;
            /* Tambahan styling opsional */
            border: 1px solid #ddd;
            border-radius: 12px;
            background-color: #fff;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin: 0 0 8px;
            color: #007bff;
        }

        .card p {
            margin: 4px 0;
            color: #333;
        }

        .qr {
            text-align: center;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }

        .badge {
            background: #007bff;
            color: white;
            padding: 2px 8px;
            font-size: 12px;
            border-radius: 12px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    $query = mysqli_query($conn, "SELECT * FROM sekolah");

    while ($data = mysqli_fetch_assoc($query)) {
        # code...
    ?>
        <div class="card">
            <h2>Kartu Iuran bulanan</h2>
            <p><span class="label">Nama Sekolah:</span> <?= $data['nama_sekolah'] ?></p>
            <p><span class="label">Alamat Sekolah:</span> <?= $data['alamat'] ?></p>
            <p><span class="label">Bulan:</span></p>

            <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; text-align: left; font-family: Arial, sans-serif;">
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Bulan</th>
                        <th style="width: 70%;">Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $bulan = [
                        'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    ];
                    foreach ($bulan as $i => $b) {
                        echo "<tr>
                    <td>" . ($i + 1) . "</td>
                    <td>{$b}</td>
                    <td></td>
                  </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p><span class="label">Status:</span> <span class="badge">AKTIF</span></p>

            <!-- <div class="qr">
                <img src="<?= $qr_code_url ?>" alt="QR Code Sekolah">
            <p><small>Scan untuk kunjungi website</small></p>
        </div> -->

            <div class="footer">
                Kartu wajib dibawa saat melakukan pembayaran.
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>