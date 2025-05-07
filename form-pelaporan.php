<?php
include 'templates/header2.php';
require 'function.php';
if (isset($_POST['submit'])) {
    if (insertPelaporan($_POST) > 0) {
        echo "<script>alert('Data pelaporan anda berhasil terkirim.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Data pelaporan anda gagal terkirim.'); window.location='form-pelaporan.php';</script>";
    }
}

$query = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM pelaporan");
$r = mysqli_fetch_array($query);
$kodeBarang = $r['kodeTerbesar'];

// mengambil angka dari kode terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeBarang, 4, 4);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "NP";
$kodeBarang = $huruf . sprintf("%04s", $urutan);
?>
<h1 style="margin-top: -40px;">Form Pelaporan Kegiatan Lapangan</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-row p-3">
        <div class="form-group">
            <label for="id">Nomor Pelaporan</label>
            <input type="text" name="id" id="id" class="form-control" value="<?= $kodeBarang; ?>" style="cursor: default;" readonly>
            <p class="text-sm"><span style="color: red;">*</span>Harap catat kode ini untuk melakukan pengecekan sendiri melalui kolom pencarian.</p>
            <div>
                <div class="form-group">
                    <label for="nama">Nama Pelapor</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                    <div>
                        <div class="form-group">
                            <label for="tim">Tim Pelapor</label>
                            <select name="tim" id="tim" class="form-control">
                                <option selected>Pilih</option>
                                <option value="Alugoro 1.1">Alugoro 1.1</option>
                                <option value="Alugoro 1.2">Alugoro 1.2</option>
                                <option value="Alugoro 2.1">Alugoro 2.1</option>
                                <option value="Alugoro 2.2">Alugoro 2.2</option>
                                <option value="Alugoro 3.1">Alugoro 3.1</option>
                                <option value="Alugoro 3.2">Alugoro 3.2</option>
                                <option value="Jolodoro 1.1">Jolodoro 1.1</option>
                                <option value="Jolodoro 1.2">Jolodoro 1.2</option>
                                <option value="Jolodoro 1.3">Jolodoro 1.3</option>
                                <option value="Jolodoro 1.4">Jolodoro 4.4</option>
                                <option value="Jolodoro 2.1">Jolodoro 2.1</option>
                                <option value="Jolodoro 2.2">Jolodoro 2.2</option>
                                <option value="Jolodoro 2.3">Jolodoro 2.3</option>
                                <option value="Jolodoro 2.4">Jolodoro 2.4</option>
                                <option value="Jolodoro 3.1">Jolodoro 3.1</option>
                                <option value="Jolodoro 3.2">Jolodoro 3.2</option>
                                <option value="Jolodoro 3.3">Jolodoro 3.3</option>
                                <option value="Jolodoro 3.4">Jolodoro 3.4</option>
                                <option value="Jatisuro">Jatisuro</option>
                                <option value="Pancanaka 1">Pancanaka 1</option>
                                <option value="Pancanaka 2">Pancanaka 2</option>
                                <option value="Pancanaka 3">Pancanaka 3</option>
                                <option value="Pasopati 1">Pasopati 1</option>
                                <option value="Pasopati 2">Pasopati 2</option>
                                <option value="Pasopati 3">Pasopati 3</option>
                                <option value="Baskara 1">Baskara 1</option>
                                <option value="Baskara 2">Baskara 2</option>
                                <option value="Baskara 3">Baskara 3</option>
                                <option value="Kartika 1">Kartika 1</option>
                                <option value="Kartika 2">Kartika 2</option>
                                <option value="Kartika 3">Kartika 3</option>
                                <option value="Chandra 1">Chandra 1</option>
                                <option value="Chandra 2">Chandra 2</option>
                                <option value="Chandra 3">Chandra 3</option>
                            </select>
                            <div>
                                <div class="form-group">
                                    <label for="tim">Bidang</label>
                                    <input type="text" name="bidang" id="bidang" class="form-control" required>
                                    <div>
                                        <div class="form-group">
                                            <label for="nama_kegiatan">Nama Kegiatan</label>
                                            <select name="nama_kegiatan" id="nama_kegiatan" class="form-control">
                                                <option selected>Pilih</option>
                                                <option value="App/Apel">App/Apel</option>
                                                <option value="Asuhan Rembulan">Asuhan Rembulan</option>
                                                <option value="Patroli">Patroli</option>
                                                <option value="Penghalauan">Penghalauan</option>
                                                <option value="Pengondisian Pengamen">Pengondisian Pengamen</option>
                                                <option value="Pengawasan">Pengawasan</option>
                                                <option value="Pengamanan">Pengamanan</option>
                                                <option value="Pembongkaran">Pembongkaran</option>
                                                <option value="Sosialisasi">Sosialisasi</option>
                                            </select>
                                            <div>
                                                <div class="form-group">
                                                    <label for="lokasi">Lokasi</label>
                                                    <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="kecamatan">Kecamatan</label>
                                                            <select name="kecamatan" id="kecamatan" class="form-control">
                                                                <option selected>Pilih</option>
                                                                <option value="Kecamatan Dukuh Pakis">Kecamatan Dukuh Pakis</option>
                                                                <option value="Kecamatan Gayungan">Kecamatan Gayungan</option>
                                                                <option value="Kecamatan Jambangan">Kecamatan Jambangan</option>
                                                                <option value="Kecamatan Karang Pilang">Kecamatan Karang Pilang</option>
                                                                <option value="Kecamatan Sawahan">Kecamatan Sawahan</option>
                                                                <option value="Kecamatan Wiyung">Kecamatan Wiyung</option>
                                                                <option value="Kecamatan Wonocolo">Kecamatan Wonocolo</option>
                                                                <option value="Kecamatan Wonokromo">Kecamatan Wonokromo</option>
                                                                <option value="Kecamatan Gubeng">Kecamatan Gubeng</option>
                                                                <option value="Kecamatan Gunung Anyar">Kecamatan Gunung Anyar</option>
                                                                <option value="Kecamatan Mulyorejo">Kecamatan Mulyorejo</option>
                                                                <option value="Kecamatan Rungkut">Kecamatan Rungkut</option>
                                                                <option value="Kecamatan Sukolilo">Kecamatan Sukolilo</option>
                                                                <option value="Kecamatan Tambaksari">Kecamatan Tambaksari</option>
                                                                <option value="Kecamatan Tenggilis Mejoyo">Kecamatan Tenggilis Mejoyo</option>
                                                                <option value="Kecamatan Asem Rowo">Kecamatan Asem Rowo</option>
                                                                <option value="Kecamatan Benowo">Kecamatan Benowo</option>
                                                                <option value="Kecamatan Lakarsantri">Kecamatan Lakarsantri</option>
                                                                <option value="Kecamatan Pakal">Kecamatan Pakal</option>
                                                                <option value="Kecamatan Sambikerep">Kecamatan Sambikerep</option>
                                                                <option value="Kecamatan Sukomanunggal">Kecamatan Sukomanunggal</option>
                                                                <option value="Kecamatan Tandes">Kecamatan Tandes</option>
                                                                <option value="Kecamatan Bubutan">Kecamatan Bubutan</option>
                                                                <option value="Kecamatan Genteng">Kecamatan Genteng</option>
                                                                <option value="Kecamatan Simokerto">Kecamatan Simokerto</option>
                                                                <option value="Kecamatan Tegalsari">Kecamatan Tegalsari</option>
                                                                <option value="Kecamatan Bulak">Kecamatan Bulak</option>
                                                                <option value="Kecamatan Kenjeran">Kecamatan Kenjeran</option>
                                                                <option value="Kecamatan Krembangan">Kecamatan Krembangan</option>
                                                                <option value="Kecamatan Pabean Cantian">Kecamatan Pabean Cantian</option>
                                                                <option value="Kecamatan Semampir">Kecamatan Semampir</option>
                                                            </select>
                                                            <div>
                                                                <div class="form-group">
                                                                    <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                                                                    <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" required>
                                                                    <div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Jam Kegiatan</label>
                                                                            <input type="text" name="jam_kegiatan" id="jam_kegiatan" class="form-control" required>
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
                                                                            </div>
                                                                            <input type="file" id="file-input" accept="image/*" style="display: none;">
                                                                            <button class="btn btn-outline-success mt-3 mr-3" type="submit" name="submit" style="width: 100px;"><span class="fas fa-paper-plane mr-3"></span>Kirim</button>
                                                                            <button class="btn btn-outline-danger mt-3" type="reset" name="reset" style="width: 130px;"><span class="fas fa-undo mr-1"></span>Reset Form</button>
                                                                        </div>
</form>
<?php
include 'templates/footer.php';
?>