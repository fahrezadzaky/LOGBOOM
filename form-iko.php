<?php
include 'templates/header2.php';
require 'function.php';
if (isset($_POST['submit'])) {

    // Ambil ID terbesar dari data yang sudah ada
    $data = query("SELECT MAX(id) AS max_id FROM pelaporaniko");
    $max_id = $data[0]['max_id'];

    // Tentukan ID untuk data baru
    $new_id = $max_id + 1;

    // Atur ID pada data baru
    $_POST['id'] = $new_id;

    if (insertpelaporaniko($_POST) > 0) {
        echo "<script>alert('Data pelaporan anda berhasil terkirim.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Data pelaporan anda gagal terkirim.'); window.location='form-iko.php';</script>";
    }
}
// membuat kolom untuk mengirim laporan
?>
<h1 style="margin-top: -40px;">Form Pelaporan Kegiatan IKO</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-row p-3">
        <div class="form-group">
            <label for="tgl_kegiatan">Tanggal Kegiatan</label>
            <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" required>
            <div>
                <div class="form-group">
                    <label for="nama">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                    <div>
                        <label for="tim">Tim Pelapor</label>
                        <select name="tim" id="tim" class="form-control">
                            <option value="Pancanaka 1">Pancanaka 1</option>
                            <option value="Pancanaka 2">Pancanaka 2</option>
                            <option value="Pancanaka 3">Pancanaka 3</option>
                            <option value="Baskara 1">Baskara 1</option>
                            <option value="Baskara 1">Baskara 1</option>
                            <option value="Baskara 2">Baskara 2</option>
                            <option value="Baskara 3">Baskara 3</option>
                            <option value="Kartika 1">Kartika 1</option>
                            <option value="Kartika 2">Kartika 2</option>
                            <option value="Kartika 3">Kartika 3</option>
                            <option value="Chandra 1">Chandra 1</option>
                            <option value="Chandra 2">Chandra 2</option>
                            <option value="Chandra 3">Chandra 3</option>
                            <option value="Jolodoro Rute 1">Jolodoro Rute 1</option>
                            <option value="Jolodoro Rute 2">Jolodoro Rute 2</option>
                            <option value="Jolodoro Rute 3">Jolodoro Rute 3</option>
                            <option value="Jolodoro Rute 4">Jolodoro Rute 4</option>
                            <option value="Jolodoro Rute 5">Jolodoro Rute 5</option>
                            <option value="Jolodoro Rute 6">Jolodoro Rute 6</option>
                            <option value="Jolodoro Rute 7">Jolodoro Rute 7</option>
                            <option value="Jolodoro Rute 8 ">Jolodoro Rute 8</option>
                            <option value="Jolodoro Rute 9">Jolodoro Rute 9</option>
                            <option value="Jolodoro Rute 10">Jolodoro Rute 10</option>
                            <option value="Jolodoro Rute 11">Jolodoro Rute 11</option>
                            <option value="Jolodoro Rute 12">Jolodoro Rute 12</option>
                            <option value="Jolodoro Rute 13">Jolodoro Rute 13</option>
                            <option value="Jolodoro Rute 14">Jolodoro Rute 14</option>
                            <option value="Jolodoro Rute 15">Jolodoro Rute 15</option>
                            <option value="Jolodoro Rute 16">Jolodoro Rute 16</option>
                            <option value="Jolodoro Rute 17">Jolodoro Rute 17</option>
                            <option value="Jolodoro Rute 18">Jolodoro Rute 18</option>
                            <option value="Jolodoro Rute 19">Jolodoro Rute 19</option>
                            <option value="Jolodoro Rute 20">Jolodoro Rute 20</option>
                            <option value="Jolodoro Rute 21">Jolodoro Rute 21</option>
                            <option value="Jolodoro Rute 22">Jolodoro Rute 22</option>
                        </select>
                        <div>
                            <div>
                                <label for="ket">Keterangan</label>
                                <textarea name="ket" id="ket" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto">Tambahkan Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
                                <p style="color: red"> Ukuran maksimal 2 MB </p>
                            </div>
                            <div>
                                <input type="file" id="file-input" accept="image/*" style="display: none;">
                                <button class="btn btn-outline-success mt-3 mr-3" type="submit" name="submit" style="width: 100px;"><span class="fas fa-paper-plane mr-3"></span>Kirim</button>
                                <button class="btn btn-outline-danger mt-3" type="reset" name="reset" style="width: 130px;"><span class="fas fa-undo mr-1"></span>Reset Form</button>
                            </div>
</form>