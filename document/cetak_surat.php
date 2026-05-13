<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../db.php";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
    }

    $id = (int) $_GET['id'];
    
    $query = mysqli_query($conn,"SELECT * FROM surat_keluar WHERE id=$id");

    if (!$query) {
        die("Query error: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Data tidak ditemukan");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>surat keterangan pindah</title>
</head>
<style>
body {
    font-family: "Times New Roman", serif;
    margin: 40px;
    color: #000;
}

.kop-surat {
    width: 100%;
    border-bottom: 4px solid #000;
    padding-bottom: 10px;
    margin-bottom: 25px;
}

.kop-table {
    width: 100%;
}

.kop-table td {
    vertical-align: top;
}

.logo {
    width: 95px;
}

.kop-text {
    text-align: center;
    line-height: 1.3;
}

.kop-text h1,
.kop-text h2,
.kop-text h3,
.kop-text p {
    margin: 0;
}

.kop-text h1 {
    font-size: 20px;
    font-weight: bold;
}

.kop-text h2 {
    font-size: 34px;
    font-weight: bold;
}

.kop-text h3 {
    font-size: 18px;
    font-weight: normal;
}

.kop-text p {
    font-size: 16px;
    font-style: italic;
}

.nss {
    text-align: right;
    margin-top: 10px;
    font-size: 15px;
}

.judul {
    text-align: center;
    font-size: 15px;
    margin-top: 10px;
}

.judul h2 {
    margin: 0;
    text-decoration: underline;
    font-size: 22px;
}

.judul p {
    margin-top: 8px;
    font-size: 18px;
}

.isi {
    margin-top: 18px;
    line-height: 1.8;
    text-align: justify;
}

.data-siswa {
    width: 80%;
    margin: 20px auto;
}

.data-siswa td {
    padding: 2px 8px;
    vertical-align: top;
    font-size: 18px;
}

.ttd {
    width: 100%;
    margin-top: 50px;
}

.tdd-kanan {
    width: 300px;
    float: right;
    text-align: left;
    line-height: 1.8;
}

.nama-kepsek {
    margin-top: 80px;
    font-weight: bold;
    text-decoration: underline;
    font-size: 20px;
}

@media print {
    body {
        margin: 20px;
    }
}
</style>

<body onload="window.print()">

<!-- Kop surat -->
 <div class="kop-surat">

 <table class="kop-table">
    <tr>
        <!-- logo kiri -->
         <td width="15%">
            <img src="../assets/img/Kab.Tapin.jpg" class="logo" alt="SDNPP2">
         </td>

         <!-- text tengah -->
          <div class="kop-text">
            <h1>PEMERINTAH KABUPATEN TAPIN</h1>
                <h3>DINAS PENDIDIKAN</h3>
                <h2>SDN NEGERI PULAU PINANG 2</h2>
                <h3>KECAMATAN PULAU PINANG KAB TAPIN</h3>
                <p>Alamat : </p>
          </div>

          <!-- Logo Kanan -->
           <td width="15%" align="right">
            <img src="../assets/img/Logo TutWurHandayani.png" class="logo">
           </td>
    </tr>
 </table>

 </div>

 <!-- NSS -->
  <div class="nss">
    Nomor Statistik Sekolah (NSS) <br>
    101150802001
  </div>

  <!-- Judul -->
   <div class="judul">
    <h2>SURAT KETERANGAN PINDAH SEKOLAH</h2>
    <p>NOMOR : <?= $data['no_surat']; ?></p>
   </div>

   <!-- Isi Surat -->
    <div class="isi">

    <p>
        Yang bertanda tangan dibawah ini, Kepala Sekolah Dasar Negeri Pulau Pinang 2
        Kecamatan Pulau Pinang, Kabupaten Tapin, Provinsi Kalimantan Selatan menerangkan bahwa :
    </p>

    <!-- data siswa -->
     <table class="data-siswa">
        <tr>
            <td width="35%">Nama</td>
            <td width="5%">:</td>
            <td><?= $data['nama_siswa'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td>NISN/NIS</td>
            <td>:</td>
            <td><?= $data['nisn'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= $data['kelas'] ?? '-'; ?></td>
        </tr>
     </table>

     <p>
        Sesuai surat permohonan pindah sekolah yang diajukan oleh orang tua/wali murid tersebut dibawah ini :
     </p>

     <!-- Data ortu -->
      <table class="data-siswa">
        <tr>
            <td width="35%">Nama</td>
            <td width="5%">:</td>
            <td><?= $data['nama_ortu'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td><?= $data['pekerja'] ?? '-'; ?></td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $data['alamat'] ?? '-'; ?></td>
        </tr>
      </table>

      <p>
        Telah mengajukan surat permohonan pindah sekolah ke
        <b><?= $data['sekolah_tujuan'] ?? '-'; ?></b>
        dengan alasan
        <b><?= $data['alsan_pindah'] ?? '-';?></b>
      </p>

    </div>

    <!-- TTD -->
    <div class="ttd">

    <div class="ttd-kanan">
        Pulau Pinang, <?= date('d F Y', strtotime($data['tanggal_surat'])); ?> <br>
        Kepala Sekolah

        <div class="nama-kepsek">
            <?= $data['nama_ttd']; ?>
        </div>

        NIP. <?= $data['nip_ttd']; ?>
    </div>
    </div>

</body>
</html>



