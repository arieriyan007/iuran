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
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Sekolah</th>
                <th>Pembayaran Ke</th>
                <th>Tgl Bayar</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../db.php'; // sesuaikan path ke koneksi

            $no = 1;
            $pembayaran = mysqli_query($conn, "SELECT 
                                pembayaran.id, pembayaran.pembayaran_ke, pembayaran.tgl_pembayaran, pembayaran.jumlah_pembayaran, sekolah.nama_sekolah 
                                FROM pembayaran
                                JOIN sekolah ON pembayaran.nama_sekolah = sekolah.id_sekolah 
                                ORDER BY pembayaran.tgl_pembayaran DESC");
            ?>
            <?php foreach ($pembayaran as $pem) :
                $id = $pem['id']; ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pem['nama_sekolah']; ?></td>
                    <td><?= $pem['pembayaran_ke']; ?></td>
                    <td><?= $pem['tgl_pembayaran']; ?></td>
                    <td><?= $pem['jumlah_pembayaran']; ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

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