<?php
session_start();
require "../layouts/header.php";
$jenis = $_GET['jenis'] ?? '';
?>
<main class="main" id="main">

<h4>Form Surat <?= ucfirst($jenis); ?></h4>

    <form action="simpan_surat.php" method="post">

    <input type="hidden" class="" name="jenis_surat" value="<?= $jenis ?>">

    <!-- umum -->
     <input type="text" name="no_surat" class="form-control mb-2" placeholder="Nomor Surat">
     <input type="text" name="perihal" class="form-control mb-2" placeholder="Prihal">
     <textarea name="isi_surat" class="form-control mb-2" placeholder="Isi Surat"></textarea>

     <input type="date" name="tanggal_surat" class="form-control mb-2">

     <!-- TTD -->
      <input type="text" name="nama_ttd" class="form-control mb-2" placeholder="Nama Kepala Sekolah">
      <input type="text" name="nip_ttd" class="form-control mb-2" placeholder="NIP">

      <!-- khusus -->
       <?php if ($jenis == 'undangan') : ?>
      <input type="text" name="tujuan" class="form-control mb-2" placeholder="Tujuan">
      <input type="date" name="tanggal_acara" class="form-control mb-2">
        <?php endif; ?>

        <button class="btn btn-primary">Simpan</button>

    </form>

</main>

<?php 
require "../layouts/footer.php";
?>