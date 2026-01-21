<?php
// require_once "../auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- DataTables CSS & Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Optional Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .dt-buttons .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <h2>Laporan Pembayaran Iuran Sekolah</h2>

    <table id="laporanTable" class="display nowrap" style="width:100%">
        <?php
        include '../db.php'; // sesuaikan path ke koneksi
        $data = mysqli_query($conn, "SELECT 
                                pembayaran.id AS id, 
                                sekolah.nama_sekolah AS sumber, 
                                pembayaran.pembayaran_ke AS keterangan, 
                                pembayaran.tgl_pembayaran AS tanggal, 
                                pembayaran.jumlah_pembayaran AS jumlah,
                                'Masuk' AS tipe
                                FROM pembayaran
                                JOIN sekolah ON pembayaran.nama_sekolah = sekolah.id_sekolah 
                                
                                UNION ALL

                                SELECT 
                                pengeluaran.id_pengeluaran AS id,
                                pengeluaran.keterangan AS keterangan,
                                '-' AS sumber,
                                pengeluaran.tgl AS tanggal,
                                pengeluaran.jumlah AS jumlah,
                                'Keluar' AS tipe
                            FROM pengeluaran
                            ORDER BY tanggal DESC");
        ?>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Tujuan / Sumber</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $totalMasuk = 0;
            $totalKeluar = 0;

            foreach ($data as $d) :
                if ($d['tipe'] == 'Masuk') {
                    $totalMasuk += $d['jumlah'];
                } else {
                    $totalKeluar += $d['jumlah'];
                }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['tanggal']; ?></td>
                    <td>
                        <?= $d['tipe'] == 'Masuk' ? '<span style="color:green"> Dana Masuk </span>' :
                            '<span style="color:red"> Dana Keluar </span>'; ?>
                    </td>
                    <td><?= $d['sumber']; ?></td>
                    <td><?= $d['keterangan']; ?></td>
                    <td style="text-align: right;">
                        Rp. <?= number_format($d['jumlah'], 0, ',', '.'); ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <hr>
    <h3>Ringkasan Keuangan</h3>
    <p><strong>Total Dana Masuk:</strong> Rp <?= number_format($totalMasuk, 0, ',', '.'); ?></p>
    <p><strong>Total Dana Keluar:</strong> Rp <?= number_format($totalKeluar, 0, ',', '.'); ?></p>
    <p><strong>Saldo:</strong> Rp <?= number_format($totalMasuk - $totalKeluar, 0, ',', '.'); ?></p>

    <!-- jQuery + DataTables + Buttons -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
        $(document).ready(function() {
            $('#laporanTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        title: 'Laporan Pembayaran Iuran',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        title: 'Laporan Pembayaran Iuran',
                        className: 'btn btn-danger',
                        orientation: 'portrait',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        text: 'Cetak',
                        title: 'Laporan Pembayaran Iuran',
                        className: 'btn btn-primary'
                    }
                ]
            });
        });
    </script>
</body>

</html>