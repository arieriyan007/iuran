<?php
session_start();
include "../layouts/header.php"
?>
<main class="mian" id="main">
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
 </style>
 <div class="continer mt-4">

<div class="d-flex justify-content-center align-item-center" style="min-height:70vh;">

<!-- surat undangan -->
<div class="col-md-4 col-lg-3">
    <div class="card shadow-sm h-100 card-hover" onclick="pilihSurat('undangan')">
        <div class="card-body text-center">
            <i class="bi bi-envelope-paper fs-1 text-primary"></i> 
            <h5 class="mt-5">Surat Undangan</h5>
            <small class="text-muted">Undangan Kegiatan / Rapat</small>
        </div>
    </div>
</div>

<!-- surat tugas -->
 <div class="col-md-4">
    <div class="card shadow-sm h-100 card-hover" onclick="pilihSurat('tugas')">
        <div class="card-body text-center">
            <i class="bi bi-envelope-paper fs-1 text-primary"></i> 
            <h5 class="mt-5">Surat Tugas</h5>
            <small class="text-muted">Penugasan Guru</small>
        </div>
    </div>
</div>

<!-- surat keterangan -->
 <div class="col-md-4">
    <div class="card shadow-sm h-100 card-hover" onclick="pilihSurat('keterangan')">
        <div class="card-body text-center">
            <i class="bi bi-envelope-paper fs-1 text-primary"></i> 
            <h5 class="mt-5">Surat Keterangan</h5>
            <small class="text-muted">Keterangan siswa / guru</small>
        </div>
    </div>
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
