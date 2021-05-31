<?php 
session_start();

if(!isset($_SESSION["kamtib"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$kunjungan = query("SELECT * FROM kunjungan ORDER BY kun_id DESC");
$kunjung = query("SELECT * FROM kunjung WHERE status = 'Selesai'");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" ></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/sc-2.0.3/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/sc-2.0.3/datatables.min.js"></script>

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
        <a class="navbar-brand" href="kamtib.php"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
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
            <div class="col-md-12 mb-2">
            <div class="card bg-dark mt-3 mb-3">
                <h2 class="display-5 text-light fw-bold mb-3">HALAMAN ADMINISTRATOR </h2>
              </div>
            </div>
            <div class="col-md-5 mb-2">
              <div class="card bg-light">
                <div class="card-header bg-dark text-center fw-normal text-light">
                DAFTAR PENGAJUAN KUNJUNGAN DETENI.
                </div>
              <div class="m-4">
                <table class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3" id="exTable">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-start text-light" scope="col">NAMA</th>
                      <th class="text-start text-light" scope="col">DETENI</th>
                      <th class="text-start text-light" scope="col">TANGGAL</th>
                      <th class="text-light" scope="col">AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($kunjungan as $row ) : ?>
                    <tr class="text-start ms-5">
                      <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["deteni"]; ?></td>
                      <td class="text-light fw-bolder"><?php echo $row["tanggal_pengajuan"]; ?></td>
                      <td class="text-center">
                      <button class="btn btn-primary" type="button" onclick="window.location='kun.php?id=<?php echo $row["kun_id"]; ?>'">TINJAU</button></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
            <div class="col-md-7 mb-2">
            <div class="card bg-light">
                <div class="card-header bg-dark text-center fw-normal text-light">
                DAFTAR KUNJUNGAN DETENI.
              </div>
              <div class="m-4">
                <table class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3" id="myTable">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-start text-light" scope="col">NAMA</th>
                      <th class="text-start text-light" scope="col">DETENI</th>
                      <th class="text-start text-light" scope="col">TANGGAL</th>
                      <th class="text-start text-light" scope="col">KODE</th>
                      <th class="text-start text-light" scope="col">KETERANGAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($kunjung as $row ) : ?>
                    <tr class="text-start ms-5">
                      <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["deteni"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["tanggal"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["kupon"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["keterangan"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </section>
    <!-- end dashboard -->

    <!-- footer -->
    
    <!-- end footer -->

    <script>
    $(document).ready( function () {
    $('#myTable').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $('#exTable').DataTable();
    } );
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
  </body>
</html>