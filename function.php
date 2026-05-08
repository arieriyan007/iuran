<?php
function generateNoSurat($conn) {

    $tahun = date('Y');
    $bulan = date('n');

    $romawi = [
        1=>'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'
    ];

    $query = mysqli_query($conn, "SELECT COUNT(*) as total
    FROM surat_keluar
    WHERE YEAR(tanggal_surat) = $tahun ");

    $data = mysqli_fetch_assoc($query);

    $urut = $data['total'] + 1;

    $nomor = str_pad($urut, 3, "0", STR_PAD_LEFT);

    return $nomor . "/SDN-PP2/" . $romawi['$bulan'] . "/" . $tahun;
}


?>