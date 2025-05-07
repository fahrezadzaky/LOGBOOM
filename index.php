<?php
include 'templates/header.php';
?>

<div class="jumbotron2 jumbotron-fluid2">
  <div class="container">
    <div class="form-container">
      <!-- Added margin-top to increase spacing from navbar -->
      <h1 style="margin-top: 60px; font-weight: bold; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.7);">
          Pelaporan Kegiatan Lapangan
      </h1>
      
      <p class="lead" style="font-weight: bold; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.7);">
          LAPORKAN KEGIATAN DISINI, DENGAN TERATUR.
      </p>

      <div class="jumbotron-search2">
        <form action="search.php" method="POST">
        <p class="lead" style="font-weight: bold; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.7);">
          CEK DATA PELAPORAN ANDA DISINI.
        </p>
          <input type="text" name="keyword" id="keyword" placeholder="Masukkan nomor pelaporan Anda disini">
          <button type="submit" class="btn btn-primary search-button" value="cari"><span class="fas fa-search mr-2"></span>Cek</button>
        </form>
        <p class="lead mt-2" style="font-weight: bold; color: red; text-shadow: 2px 2px 4px rgba(0,0,0,0.7);">LAPORKAN KEGIATAN DISINI</p>
        <a href="form-iko.php" class="btn btn-primary sub-button"><span class="fas fa-chevron-right mr-2"></span>Disini</a>
      </div>
    </div>
  </div>
</div>
<?php
include 'templates/footer.php';
?>