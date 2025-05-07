<?php
require '../function.php';
$id = $_GET['id'];
    if (deletePelaporan($id) > 0) {
        echo "<script>alert('Data dengan nomor pelaporan $id berhasil dihapus.'); document.location.href='data-pelaporan.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus.'); document.location.href='data-pelaporan.php';</script>";
    }

?>