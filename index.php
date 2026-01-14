<?php
// require_once 'auth.php';
require_once 'db.php';
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - iuran</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<!-- Tambahkan CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Iuran PGRI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div> -->
        <!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/kosong.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username'] ?? 'SDN PP 2'; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION['username'] ?? 'SDN PP 2'; ?></h6>
                            <span><?php echo $_SESSION['nama'] ?? 'Admin'; ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="../index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-heading">Menu</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages/pembayaran.php">
                    <i class="bi bi-person"></i>
                    <span>Pembayaran</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages/pengeluaran.php">
                    <i class="bi bi-person"></i>
                    <span>Pengeluaran</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages/kartu_iuran.php" target="_blank">
                    <i class="bi bi-printer"></i>
                    <span>Kartu Iuran</span>
                </a>
            </li><!-- End kartu iuaran Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages/laporan.php">
                    <i class="bi bi-file-earmark"></i>
                    <span>Laporan</span>
                </a>
            </li><!-- End laporan Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Pembayaran Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Total <span>| Pembayaran</span></h5>
                                    <?php
                                    include 'db.php';

                                    $data = mysqli_query($conn, "SELECT SUM(jumlah_pembayaran) as total_pembayaran from pembayaran");
                                    $hasil = mysqli_fetch_assoc($data);
                                    $total_pembayaran = $hasil['total_pembayaran'] ?? 0;
                                    ?>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>Rp <?= number_format($total_pembayaran, 0, ',', '.'); ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Pembayaran Card -->

                        <!-- Pengeluaran Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">Total <span>| Pengeluaran</span></h5>
                                    <?php
                                    include 'db.php';

                                    $data = mysqli_query($conn, "SELECT SUM(jumlah) as total_pengeluaran from pengeluaran");
                                    $hasil = mysqli_fetch_assoc($data);
                                    $total_pengeluaran = $hasil['total_pengeluaran'] ?? 0;
                                    ?>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Pengeluaran Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Jumlah <span>| anggota PGRI</span></h5>

                                    <?php
                                    include 'db.php';

                                    $sekolah = mysqli_query($conn, "SELECT COUNT(*) as jumlah_sekolah from sekolah");
                                    $data = mysqli_fetch_assoc($sekolah);
                                    $jumlah_sekolah = $data['jumlah_sekolah'] ?? 0;
                                    ?>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $jumlah_sekolah; ?></h6>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div><!-- End Customers Card -->


                        <!-- List sudah -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <!-- menampilkan list sekolah yg sudah byr iuran -->
                                <?php
                                // require_once 'db.php';

                                // ambil data yang bayar bulan ini
                                $query = mysqli_query($conn, "
                                        SELECT 
                                            sekolah.nama_sekolah,
                                            pembayaran.jumlah_pembayaran,
                                            pembayaran.tgl_pembayaran,
                                            pembayaran.pembayaran_ke
                                        FROM pembayaran
                                        JOIN sekolah ON pembayaran.id = sekolah.id_sekolah
                                        WHERE pembayaran.tgl_pembayaran >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
                                        AND pembayaran.tgl_pembayaran < DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'),
                                        INTERVAL 1 MONTH)
    ");
                                ?>
                                <div class="card-body pb-0">
                                    <h5 class="card-title">List <span>| Bayar iuran</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Sekolah</th>
                                                <th scope="col">Bayar</th>
                                                <th scope="col">Tgl bayar</th>
                                                <th scope="col">Bulan iuran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            while ($data = mysqli_fetch_assoc($query)) {
                                                # code...

                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $no++; ?></th>
                                                    <td><a href="#" class="text-primary fw-bold"><?= $data['nama_sekolah']; ?></a></td>
                                                    <td>Rp. <?= number_format($data['jumlah_pembayaran'], 0, ',', '.'); ?></td>
                                                    <td class="fw-bold"><?= date('d-m-Y', strtotime($data['tgl_pembayaran'])); ?></td>
                                                    <td><?= $data['pembayaran_ke']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End sudah bayar -->

                        <!-- Chart Pembayaran -->
                        <div class="col-6">
                            <div class="card top-selling overflow-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Grafik | Pendapatan per Bulan</h5>
                                        <canvas id="chartPendapatan" height="100"></canvas>
                                    </div>
                                </div>

                                <?php
                                include 'db.php';

                                // Ambil total pembayaran per bulan
                                $query = mysqli_query($conn, "
                                    SELECT MONTH(tgl_pembayaran) AS bulan, SUM(jumlah_pembayaran) AS total 
                                    FROM pembayaran 
                                    GROUP BY MONTH(tgl_pembayaran)
                                    ORDER BY bulan
                                ");

                                $bulan = [];
                                $total = [];

                                $nama_bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                                while ($row = mysqli_fetch_assoc($query)) {
                                    $bulan[] = $nama_bulan[$row['bulan']];
                                    $total[] = $row['total'];
                                }
                                ?>

                                <script>
                                    const ctxPendapatan = document.getElementById('chartPendapatan').getContext('2d');
                                    const chart = new Chart(ctxPendapatan, {
                                        type: 'bar',
                                        data: {
                                            labels: <?= json_encode($bulan); ?>,
                                            datasets: [{
                                                label: 'Total Pendapatan (Rp)',
                                                data: <?= json_encode($total); ?>,
                                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1,
                                                borderRadius: 8
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        callback: function(value) {
                                                            return 'Rp ' + value.toLocaleString('id-ID');
                                                        }
                                                    }
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: true,
                                                    labels: {
                                                        color: '#333',
                                                        font: {
                                                            weight: 'bold'
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>

                        <!-- chart pengeluaran -->
                        <div class="col-6">
                            <div class="card top-selling overflow-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Grafik | Pengeluaran</h5>
                                        <canvas id="chartPengeluaran" height="100"></canvas>
                                    </div>
                                </div>

                                <?php
                                include 'db.php';

                                // Ambil total pengeluaran per bulan
                                $query = mysqli_query($conn, "
                                    SELECT MONTH(tgl) AS bulan, SUM(jumlah) AS total 
                                    FROM pengeluaran 
                                    GROUP BY MONTH(tgl)
                                    ORDER BY bulan
                                ");

                                $bulan = [];
                                $total = [];

                                $nama_bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                                while ($row = mysqli_fetch_assoc($query)) {
                                    $bulan[] = $nama_bulan[$row['bulan']];
                                    $total[] = $row['total'];
                                }
                                ?>

                                <script>
                                    const ctxPengeluaran = document.getElementById('chartPengeluaran').getContext('2d');
                                    const chartPengeluaran = new Chart(ctxPengeluaran, {
                                        type: 'bar',
                                        data: {
                                            labels: <?= json_encode($bulan); ?>,
                                            datasets: [{
                                                label: 'Total Pendapatan (Rp)',
                                                data: <?= json_encode($total); ?>,
                                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1,
                                                borderRadius: 8
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        callback: function(value) {
                                                            return 'Rp ' + value.toLocaleString('id-ID');
                                                        }
                                                    }
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: true,
                                                    labels: {
                                                        color: '#333',
                                                        font: {
                                                            weight: 'bold'
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>SDN PP 2</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>