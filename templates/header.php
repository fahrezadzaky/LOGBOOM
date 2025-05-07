<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGBOOM SATPOL PP</title>
  <!-- icon LOGBOOM -->
  <link rel="icon" href="assets/dist/img/LOGBOOM.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/plugins/bootstrap4/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
</head>
<style>
  /* Add this to your style.css file */
  .jumbotron2 {
    padding-top: 30px;
    /* Adds padding to the top of the jumbotron */
  }

  .form-container {
    padding-top: 20px;
    /* Additional padding for the form container */
  }

  /* These styles ensure the layout works with the added spacing */
  .container {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
  }

  .form-container {
    width: 50%;
    position: relative;
    z-index: 2;
  }

  .image-container {
    width: 50%;
    text-align: right;
  }

  .image-container img {
    max-width: 100%;
    height: auto;
  }

  /* Responsive layout */
  @media (max-width: 991.98px) {
    .container {
      flex-direction: column;
    }

    .form-container,
    .image-container {
      width: 100%;
    }

    .image-container {
      text-align: center;
      margin-top: 30px;
    }

    /* For smaller screens, adjust the top margin */
    .form-container h1 {
      margin-top: 40px;
    }
  }
</style>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <img class="logo" src="assets/dist/img/LOGBOOM.png">
      <img class="logo" src="assets/dist/img/Pemkotsby.png">
      <img class="logo" src="assets/dist/img/SatpolPPsby.png">
      <a class="navbar-brand" href="index.php">LOGBOOM</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="form-pelaporan.php">Laporan Kegiatan</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="form-iko.php">Laporan IKO</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary login-button" href="auth/login.php">Log in</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <style>
  body {
    font-family: 'Poppins', sans-serif;
  }
  
  .jumbotron2 h1, 
  .jumbotron2 p {
    color: white;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
  }
  
  .jumbotron2::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.4); /* lapisan gelap */
    z-index: 1;
  }
  
  .form-container {
    position: relative;
    z-index: 2;
  }
</style>
  <!-- end navbar -->
  <!-- header -->