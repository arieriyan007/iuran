<?php
// require_once '../auth.php';
include '../db.php';
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
    <link href="../assets/img/logo_pgri.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- datatabel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">
    <!-- modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="../index.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo_pgri.png" alt="">
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

                <!-- <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li> -->
                <!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/kosong.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['username'] ?? 'SDN PP 2'; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $_SESSION['username'] ?? 'SDN PP 2'; ?></h6>

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
                <a class="nav-link collapsed" href="../index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-heading">Menu</li>

            <li class="nav-item">
                <a class="nav-link " href="pengeluaran.php">
                    <i class="bi bi-person"></i>
                    <span>Pengeluaran</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="laporanKeluar.php" target="_blank">
                    <i class="bi bi-file-earmark"></i>
                    <span>Laporan</span>
                </a>
            </li><!-- End laporan Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Pengeluaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengeluaran</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-title mb-0">Dana Pengeluaran</h5>
                                <!-- button modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myPembayaran">
                                    Tambah Pengeluaran
                                </button>
                            </div>

                            <!-- The Modal -->
                            <div class="modal fade" id="myPembayaran">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Dana Pengeluaran</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form action="pengeluaranBaru.php" method="post">
                                            <div class="modal-body">
                                                <label for="sekolah">Dana keluar :</label>
                                                <input type="text" name="danaKeluar" placeholder="Keterangan dana keluar..." class="form-control my-2" required>
                                                <input type="date" name="tglKeluar" autocomplete="off" class="form-control my-2">
                                                <input type="number" name="jumlahKeluar" placeholder="Jumlah dana keluar..." autocomplete="off" class="form-control my-2">
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info btn-sm" data-bs-dismiss="modal" name="addPengeluaran">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- membuat filter bedasarkan tgl -->
                            <form method="GET" class="mb-3 d-flex gap-2">
                                <select name="filter_bulan" class="form-control" style="max-width: 150px;">
                                    <option value="">-- Bulan --</option>
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        $selected = (isset($_GET['filter_bulan']) && $_GET['filter_bulan'] == $i) ? 'selected' : '';
                                        echo "<option value='$i' $selected>" . date('F', mktime(0, 0, 0, $i, 10)) . "</option>";
                                    }
                                    ?>
                                </select>

                                <select name="filter_tahun" class="form-control" style="max-width: 120px;">
                                    <option value="">-- Tahun --</option>
                                    <?php
                                    $currentYear = date('Y');
                                    for ($y = $currentYear; $y >= ($currentYear - 5); $y--) {
                                        $selected = (isset($_GET['filter_tahun']) && $_GET['filter_tahun'] == $y) ? 'selected' : '';
                                        echo "<option value='$y' $selected>$y</option>";
                                    }
                                    ?>
                                </select>

                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="pengeluaran.php" class="btn btn-secondary">Reset</a>
                            </form>
                            <!-- end filter -->

                            <!-- Primary Color Bordered Table -->
                            <table class="table table-bordered border-primary" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ket Dana Keluar</th>
                                        <th>Tgl Keluar</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php
                                // filter berdasarkan tgl
                                $where = "";
                                if (!empty($_GET['filter_bulan']) && !empty($_GET['filter_tahun'])) {
                                    $bulan = $_GET['filter_bulan'];
                                    $tahun = $_GET['filter_tahun'];
                                    $where = "WHERE MONTH(pengeluaran.tgl) = '$bulan' AND YEAR(pengeluaran.tgl) = '$tahun'";
                                }

                                $no = 1;
                                $danaKel = mysqli_query($conn, "SELECT * fROM pengeluaran ORDER BY tgl DESC");
                                ?>
                                <tbody>
                                    <?php
                                    foreach ($danaKel as $dk) : $dk['id_pengeluaran'];
                                    ?>
                                        <tr class="align-middle">
                                            <td class="fw-semibold text-muted">
                                                <?= $no++; ?>
                                            </td>

                                            <td>
                                                <div class="fw-semibold text-dark">
                                                    <?= htmlspecialchars($dk['keterangan']); ?>
                                                </div>
                                            </td>

                                            <td>
                                                <span class="badge-date">
                                                    <?= date('d M Y', strtotime($dk['tgl'])); ?>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <span class="amount-out">
                                                    Rp <?= number_format($dk['jumlah'], 0, ',', '.'); ?>
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <a href="#"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                                    title="Print pengeluaran">
                                                    <i class="bi bi-printer me-1"></i> Print
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <!-- End Primary Color Bordered Table -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- script table -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const myTable = document.querySelector("#myTable");
            new simpleDatatables.DataTable(myTable);
        });
    </script>

    <!-- style tr dan td -->
    <style>
        .table tbody tr {
            transition: background-color .2s ease, transform .15s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.003);
        }

        .badge-date {
            background: #f1f3f5;
            border-radius: 12px;
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .amount-out {
            color: #dc3545;
            font-weight: 600;
        }
    </style>


    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <!-- datatable -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" defer></script>
    <!-- modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>