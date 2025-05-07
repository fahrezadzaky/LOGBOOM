<?php
include 'templates/header3.php';
require 'function.php';
?>
<h1 class="display-4" style="margin-top: -50px;">Status Pelaporan Anda</h1>

<div class="row">
  <div class="col">
    <?php
    $keyword = $_POST['keyword'];
    $data = query("SELECT * FROM pelaporan WHERE id = '$keyword'");
    if ($data) {
      foreach ($data as $d) :
    ?>
        <div class="row">
          <div class="col">
            <p>Nomor Pelaporan : <?= $d['id']; ?></p>
            <p>Nama Pelapor : <?= $d['n_pelapor']; ?></p>
            <p>Tim : <?= $d['t_pelapor']; ?></p>
            <p>Bidang : <?= $d['b_pelapor']; ?></p>
            <p>Nama Kegiatan : <?= $d['n_kegiatan']; ?></p>
            <p>Lokasi : <?= $d['lokasi']; ?></p>
            <p>Kecamatan : <?= $d['kecamatan']; ?></p>
            <p>Tanggal Kegiatan : <?= $d['tgl_kegiatan']; ?></p>
            <p>Jam Kegiatan : <?= $d['j_kegiatan']; ?></p>
            <p>Keterangan : <?= $d['ket']; ?></p>
            <p>Foto :</p>
            <img src="<?= $d['foto']; ?>" alt="Foto Kegiatan" style="max-width: 200px;height: auto;">
            <p>Status : <?= $d['status']; ?></p>
            <p><b><u>Catatan dari petugas</u></b> <br><?= $d['ket_petugas']; ?></p>
          </div>
        </div>
        <br>
        <a href="index.php" class="btn btn-sm btn-primary" style="width: 80px;"><span class="fas fa-arrow-left mr-2"></span>Back</a>
    <?php
      endforeach;
    } else {
      echo "<p>Data pelaporan tidak ditemukan.</p>";
    }
    ?>
  </div>
</div>
<?php
include 'templates/footer.php';
?>