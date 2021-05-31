<?php 
session_start();

if(!isset($_SESSION["fo"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$kunjungan = query("SELECT * FROM kunjungan WHERE keterangan = 'Disetujui' ORDER BY kun_id DESC");

?>

<!DOCTYPE html>
<html lang="en">
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
        <a class="navbar-brand" href="#"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <button class="btn btn-primary" type="button" onclick="window.location='logout.php'">LOGOUT</button>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- dashboard -->
    <section id="form">
      <a name="kamtib">
        <div class="container">
          <div class="row text-center mb-5 text-white">
            <div class="col">
              <div class="card bg-dark mt-3 mb-3">
                <h2 class="display-5 text-light fw-bold mb-3">HALAMAN ADMINISTRATOR </h2>
              </div>
              <div class="card bg-light">
                <div class="card-header bg-dark text-center fw-normal text-light">
                DAFTAR KUNJUNGAN DETENI PADA RUMAH DETENSI IMIGRASI DENPASAR.
              </div>
              <div class="m-4">
                <table class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3" id="myTable">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-start text-light" scope="col">NAMA</th>
                      <th class="text-start text-light" scope="col">NAMA DETENI</th>
                      <th class="text-center text-light" scope="col">KODE KUNJUNGAN</th>
                      <th class="text-center text-light" scope="col">MASA BERLAKU SURAT</th>
                      <th class="text-light" scope="col">AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($kunjungan as $row ) : ?>
                    <tr class="text-start ms-5">
                      <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["deteni"]; ?></td>
                      <td class="text-light fw-bolder text-center"><?php echo $row["kupon"]; ?></td>
                      <td class="text-light text-center"><?php echo $row["tanggal_berlaku"]; ?></td>
                      <td class="text-center">
                        <button class="btn btn-primary" type="button" onclick="window.location='cetak.php?id=<?php echo $row["kun_id"]; ?>'">CETAK</button>
                        <button class="btn btn-primary" type="button" onclick="kirim(<?php echo $row["kun_id"]; ?>)">KIRIM</button>
                          <script language="javascript">
                            function kirim(id) {
                              if(confirm("Apakan anda yakin untuk mengirim data ke penjagaan?")) {
                                window.location.href='kirim.php?id=' + id + '';
                                return true;
                              }
                            }
                          </script>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center fs-5 text-center">
            <div class="col-md-6 mb-3 text-white"></div>
            <div class="col-md-6 mb-3 text-white"></div>
          </div>
        </div>
        
      </a>
    </section>
    <!-- end dashboard -->

    <!-- footer -->
    
    <!-- end footer -->

    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
  </body>
</html>
