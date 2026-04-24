<?php

include '../db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($id <= 0) {
        die("Data tidak valid");
    }

    // membuat soft delete
    $hapus = mysqli_query($conn, "DELETE FROM pembayaran WHERE id = $id");

    if (!$hapus) {
        die("Gagal hapus: " . mysqli_error($conn));
    }

    echo "<script>
        alert('Data berhasil dihapus ');
        window.location.href='pembayaran.php';
    </script>";
}

?>