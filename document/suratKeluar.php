<?php
session_start();
include "../layouts/header.php"
?>
<main class="main" id="main">
<!-- css di html -->
 <style>
    .card-hover {
     cursor: pointer;
     transition: all 0.2s ease-in-out;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table tbody tr:hover {
        background-color: #f1f5ff;
        transition: 0.2s;
    }

    .badge-surat {
        background: #e7f1ff;
        color: #0d6efd;
        padding: 6px 10px;
        border-radius: 10px;
        font-size: 12px;
    }

    .btn-action {
        padding: 5px 10px;
        border-radius: 8px;
    }
 </style>
 <div class="container">

    <div class="d-flex justify-content-center align-items-center" style="min-height:60vh;">

        <div class="row justify-content-center g-4">
 
               <!-- surat undangan -->
                <div class="col-md-4 col-lg-4">
                    <div class="card shadow-sm h-100 card-hover" onclick="pilihSurat('undangan')">
                        <div class="card-body text-center">
                            <i class="bi bi-envelope-paper fs-1 text-primary"></i> 
                            <h5 class="mt-5">Surat Undangan</h5>
                            <small class="text-muted">Undangan Kegiatan / Rapat</small>
                        </div>
                    </div>
                </div>

                <!-- surat tugas -->
                <div class="col-md-4 col-lg-4">
                    <div class="card shadow-sm h-100 card-hover" onclick="pilihSurat('tugas')">
                        <div class="card-body text-center">
                            <i class="bi bi-briefcase fs-1 text-primary"></i> 
                            <h5 class="mt-5">Surat Tugas</h5>
                            <small class="text-muted">Penugasan Guru</small>
                        </div>
                    </div>
                </div>

                <!-- surat keterangan -->
                <div class="col-md-4 col-lg-4">
                    <div class="card shadow-sm h-100 card-hover" onclick="pilihSurat('keterangan')">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-text fs-1 text-primary"></i> 
                            <h5 class="mt-5">Surat Keterangan</h5>
                            <small class="text-muted">Keterangan siswa / guru</small>
                        </div>
                    </div>
                </div>

        </div>

    </div>

<div class="card shadow-sm">
    <div class="card-body">
        <?php 
    $data = mysqli_query($conn, "SELECT * FROM surat_keluar ORDER BY id DESC"); 
    ?>

 <table class="table align-middle table-hover">
    <thead>
        <tr>
        <th>No</th>
        <th>No Surat</th>
        <th>Perihal</th>
        <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php 
    $no = 1;
    while($d = mysqli_fetch_assoc($data)) :
    ?>
        <tr>
        <td><?= $no++ ?></td>

        <td>
            <span class="badge-surat">
                <?= $d['no_surat'] ?>
            </span>
        </td>

        <td><?= $d['perihal'] ?></td>
        <td>
            <a href="cetak_surat.php?id=<?= $d['id'] ?>" target="_blank" class="btn btn-success btn-sm btn-action">
                <i class="bi bi-printer"></i> Cetak</a>
        </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
    
 </table>
    </div>
</div>

    

 </div>

<!-- script -->
 <script>
    function pilihSurat(jenis) {
        window.location.href= "form_surat.php?jenis=" + jenis;
    }
 </script>
</main>

<?php 
include "../layouts/footer.php";
?>
