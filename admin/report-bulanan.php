<?php
include "templates/header-report.php";
include "templates/sidebar-report.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Report Bulanan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Report</a></li>
            <li class="breadcrumb-item active">Report Bulanan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-book mr-3"></i>Data Pelaporan Kegiatan Lapangan</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
    <div class="card-body">
      <?php if (isset($_POST['month']) && isset($_POST['year'])) : ?>
        <a href="cetakpdf_bulan.php?month=<?php echo $_POST['month']; ?>&year=<?php echo $_POST['year']; ?>" class="btn btn-primary">PDF</a>
        <a href="cetakexcel_bulan.php?month=<?php echo $_POST['month']; ?>&year=<?php echo $_POST['year']; ?>" class="btn btn-success">Excel</a>
      <?php endif; ?>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" width="100%">
          <thead align="center">
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th>Tim</th>
            <th>Bidang</th>
            <th>Nama Kegiatan</th>
            <th>Lokasi</th>
            <th>Kecamatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Jam Kegiatan</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Catatan</th>
          </thead>
          <tbody align="center">
            <?php
            $month = $_POST['month'];
            $year = $_POST['year'];
            $data = query("SELECT * FROM pelaporan WHERE MONTH(tgl_kegiatan)='$month' AND YEAR(tgl_kegiatan)='$year' ORDER BY tgl_kegiatan DESC");
            foreach ($data as $d) :
            ?>
              <tr>
                <td><?= $d['id']; ?></td>
                <td><?= $d['n_pelapor']; ?></td>
                <td><?= $d['t_pelapor']; ?></td>
                <td><?= $d['b_pelapor']; ?></td>
                <td><?= $d['n_kegiatan']; ?></td>
                <td><?= $d['lokasi']; ?></td>
                <td><?= $d['kecamatan']; ?></td>
                <td><?= $d['tgl_kegiatan']; ?></td>
                <td><?= $d['j_kegiatan']; ?></td>
                <td><?= $d['ket']; ?></td>
                <td><img src="../<?= $d['foto']; ?>" alt="Foto Kegiatan" style="max-width: 100px;height: auto;"> </td>
                <td><?= $d['status']; ?></td>
                <td><?= $d['ket_petugas']; ?></td>
              </tr>
            <?php
            endforeach;
            ?>
          </tbody>
          <tfoot align="center">
            <th>No.</th>
            <th>Nama Pegawai</th>
            <th>Tim</th>
            <th>Bidang</th>
            <th>Nama Kegiatan</th>
            <th>Lokasi</th>
            <th>Kecamatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Jam Kegiatan</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Catatan</th>
          </tfoot>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>