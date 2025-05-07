<?php
require '../function.php';
$id = $_GET['id'];
    if (deletePelaporaniko($id) > 0) {
        echo "<script>alert('Data dengan nomor pelaporan $id berhasil dihapus.'); document.location.href='data-pelaporaniko.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus.'); document.location.href='data-pelaporaniko.php';</script>";
    }

?>