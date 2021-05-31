<?php 
session_start();

if(!isset($_SESSION["rap"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$id = $_GET["id"];

$deteni = query("SELECT * FROM deteni WHERE deteni_id = $id")[0];

if(isset($_POST["submit"])){
      
          if(depor($_POST) > 0 ) {
            echo "
              <script>
                alert('Berhasil mendeportasi deteni!');
                document.location.href = 'rap.php';
                </script>
                ";
          } else {
            echo "
              <script>
                alert('Gagal!');
                </script>
                ";
          }
  }
?>

<!DOCTYPE html>
<<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />

    <!-- my CSS -->
    <link rel="stylesheet" href="css/style.css" />

    <title>E-Visit | Rudenim Bali</title>
  </head>
  <body>
    <!-- navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="rap.php"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <button class="btn btn-primary ms-2" type="button" onclick="window.location='rap.php'">DAFTRA DETENI</button>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- visit -->
    <section id="form">
      <div class="container">
        <div class="row text-center mb-5">
          <div class="col text-white fw-bold">
            <h2 class="display-4 text-white fw-bold mb-3 text-uppercase">Halaman Deportasi</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-7 mb-5">
            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
              <input type="hidden" name="id" value="<?= $deteni["deteni_id"]; ?>">
              <div class="col-md-6">
                <label for="nama" class="form-label text-white">Nama Deteni</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $deteni["nama"]; ?>">
              </div>
              <div class="col-md-6">
                <label for="negara" class="form-label text-white">Kebangsaan Deteni</label>
                <input type="text" class="form-control" name="negara" id="negara" value="<?= $deteni["negara"]; ?>">
              </div>
              <div class="col-md-6">
                <label for="kelamin" class="form-label text-white">Jenis Kelamin</label>
                <input type="text" class="form-control" name="kelamin" id="kelamin" value="<?= $deteni["kelamin"]; ?>">
              </div>
              <div class="col-md-6">
                <label for="tanggal" class="form-label text-white">Tanggal Deportasi</label>
                <input type="date" class="form-control" name="tanggal" id="tanggal">
              </div>
              <div class="col-md-12">
                <label for="keterangan" class="form-label text-white">Keterangan Kunjungan</label>
                <select name="keterangan" id="keterangan" class="form-select">
                  <option value="Deportasi">Deportasi</option>
                  <option value="Pemulangan">Pemulangan</option>
                  <option value="Pemindahan">Pemindahan</option>
                </select>
              </div>
              <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary mt-3 me-3">SELESAI</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#222222"
          fill-opacity="1"
          d="M0,160L60,144C120,128,240,96,360,112C480,128,600,192,720,181.3C840,171,960,85,1080,64C1200,43,1320,85,1380,106.7L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
        </path>
      </svg>
    </section>
    <!-- end visit -->

    <!-- footer -->
    <style>
      footer {
        background-color: #222222;
      }
    </style>
    <footer class="text-white text-center pb-3">
      <p>Copyright &copy <a href="https://www.instagram.com/rudenim_bali/" class="text-white fw-bold text-decoration-none">Humas IDC Bali 2021</a></p>
    </footer>
    <!-- end footer -->
    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
