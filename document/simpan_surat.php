<?php
include "../db.php";

$stmt = $conn->prepare("INSERT INTO surat_keluar (jenis_surat, no_surat, perihal, isi_surat, tanggal_surat, nama_ttd, nip_ttd) VALUES (?, ?, ?, ?, ?, ?, ?) ");

if (!$stmt) {
    die("Prepare gagal:" . $conn->error);
}

$stmt->bind_param("sssssss",
$_POST['jenis_surat'],
$_POST['no_surat'],
$_POST['perihal'],
$_POST['isi_surat'],
$_POST['tanggal_surat'],
$_POST['nama_ttd'],
$_POST['nip_ttd']
);

if (!$stmt->execute()) {
    die("Execute gagal: " . $stmt->error);
}

header("Location: suratKeluar.php");
exit;
?>