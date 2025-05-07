<?php
include "templates/header.php";
include "templates/sidebar-pelaporan.php";

if (isset($_POST['submit'])) {
  if (updatePelaporan($_POST) > 0) {
    echo "<script>alert('Update data successfully!'); window.location='data-pelaporan.php';</script>";
  } else {
    echo "<script>alert('Data update failed or you did not make any changes!'); window.location='data-pelaporan.php';</script>";
  }
}

$id = $_GET['id'];
$data = query("SELECT * FROM pelaporan WHERE id = '$id'");
foreach ($data as $d) :

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pelaporan <?= $d['id']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Report</a></li>
              <li class="breadcrumb-item active">Bulanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <form action="" method="POST">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-2">
                  <label for="id">Nomor pelaporan :</label>
                  <input type="text" name="id" id="id" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['id']; ?>" readonly>
                </div>
                <div class="col-md-2">
                  <label for="tgl">Tanggal Pelaporan :</label>
                  <input type="text name=" tgl_pelaporan" id="tgl_pelaporan" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['tgl_kegiatan']; ?>" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="np">Nama Pelapor :</label>
                  <input type="text" name="np" id="np" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['n_pelapor']; ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="tp">Tim :</label>
                  <input type="text" name="tp" id="tp" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['t_pelapor']; ?>" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="bp">Bidang :</label>
                  <input type="text" name="bp" id="bp" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['b_pelapor']; ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="nk">Nama Kegiatan :</label>
                  <input type="text" name="nk" id="nk" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['n_kegiatan']; ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="lokasi">Lokasi :</label>
                  <input type="text" name="lokasi" id="lokasi" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['lokasi']; ?>" readonly>
                </div>
              </div>
              <div class="col-md-4">
                <label for="kecamatan">Kecamatan :</label>
                <input type="text" name="kecamatan" id="kecamatan" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['kecamatan']; ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <label for="tgl_kegiatan">Tanggal Kegiatan :</label>
              <input type="text" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['tgl_kegiatan']; ?>" readonly>
            </div>
            <div class="col-md-4">
              <label for="j_kegiatan">Jam Kegiatan :</label>
              <input type="text" name="j_kegiatan" id="j_kegiatan" class="form-control mb-3 bg-transparent" style="cursor: default;" value="<?= $d['j_kegiatan']; ?>" readonly>
            </div>
            <div class="row">
              <div class="col-md-8">
                <label for="ket">Keterangan :</label>
                <textarea name="ket" id="ket" class="form-control mb-3 bg-transparent" style="cursor: default;" readonly><?= $d['ket']; ?></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8">
                <label for="ket">Tampilkan Foto:</label>
                <img src="../<?= $d['foto']; ?>" alt="Foto Kegiatan" style="max-width: 200px;height: auto;">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4" style="border: 1px solid #ced4da; border-radius: 5px; margin: 7px 7px; padding: 7px 10px;">
                <p><b>Status :</b></p>
                <?php
                if ($d['status'] == 'Sedang diajukan') {
                ?>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Sedang diajukan" id="opt1" name="status" class="custom-control-input" checked>
                    <label class="custom-control-label" for="opt1">Sedang diajukan</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Sedang diproses" id="opt2" name="status" class="custom-control-input">
                    <label class="custom-control-label" for="opt2">Sedang diproses</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Selesai diproses" id="opt3" name="status" class="custom-control-input">
                    <label class="custom-control-label" for="opt3">Selesai diproses</label>
                  </div>
                <?php
                } elseif ($d['status'] == 'Sedang diproses') {
                ?>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Sedang diajukan" id="opt1" name="status" class="custom-control-input">
                    <label class="custom-control-label" for="opt1">Sedang diajukan</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Sedang diproses" id="opt2" name="status" class="custom-control-input" checked>
                    <label class="custom-control-label" for="opt2">Sedang diproses</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Selesai diproses" id="opt3" name="status" class="custom-control-input">
                    <label class="custom-control-label" for="opt3">Selesai diproses</label>
                  </div>
                <?php
                } else {
                ?>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Sedang diajukan" id="opt1" name="status" class="custom-control-input">
                    <label class="custom-control-label" for="opt1">Sedang diajukan</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Sedang diproses" id="opt2" name="status" class="custom-control-input">
                    <label class="custom-control-label" for="opt2">Sedang diproses</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" value="Selesai diproses" id="opt3" name="status" class="custom-control-input" checked>
                    <label class="custom-control-label" for="opt3">Selesai diproses</label>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 mt-2">
                <label for="ket_petugas">Catatan dari petugas :</label>
                <textarea name="ket_petugas" id="ket_petugas" class="form-control mb-2"><?= $d['ket_petugas']; ?></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 mt-2">
                <button type="submit" value="submit" name="submit" class="btn btn-outline-success mr-2" style="width: 100px;">
                  <span class="fas fa-check mr-2"></span>
                  Save
                </button>
                <button type="reset" value="reset" class="btn btn-outline-danger mr-2" style="width: 100px;">
                  <span class="fas fa-times mr-2"></span>
                  Reset
                </button>
                <a href="#" class="btn btn-outline-primary" onclick="history.back()" style="width: 100px;">
                  <span class="fas fa-arrow-left mr-2"></span>
                  Back
                </a>
              </div>
            </div>
        </div>
        </form>
      </div>
      <!-- /.card-body -->
    <?php
  endforeach;
    ?>

  </div>
  <!-- /.card -->

  </section>
  <!-- /.content -->
  </div>
  <?php
  include "templates/footer.php";
  ?>