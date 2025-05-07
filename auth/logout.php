<?php
session_start();
session_destroy();
echo "<script>alert('Berhasil logout dari LOGBOOM!'); window.location='../index.php';</script>";