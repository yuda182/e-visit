<?php 
session_start();

if(!isset($_SESSION["rap"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$deteni = query("SELECT * FROM deteni");

$depor = query("SELECT * FROM deportasi");

if (isset($_POST["submit"])) {
  
  if ( tambah($_POST) > 0 ) {
      echo "
            <script>
              alert('Deteni berhasil ditambahkan!');
              document.location.href = 'rap.php';
              </script>
              ";
        } else {
          echo "
            <script>
              alert('gagal menambahkan Deteni!');
              </script>
              ";
        }
  
}

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
        <a class="navbar-brand" href="rap.php"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
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
      <a name="rap">
        <div class="container">
          <div class="row text-center mb-5 text-white">
            <div class="col-md-12 mb-2">
              <div class="card bg-dark mt-3 mb-3">
                <h2 class="display-5 text-light fw-bold mb-3">HALAMAN ADMINISTRATOR </h2>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">TAMBAH DETENI</button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Deteni</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="" enctype="multipart/form-data">
                          <div class="row">
                            <div class="col-6 mb-3">
                              <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Deteni" />
                            </div>
                            <div class="col-6 mb-3">
                              <input type="text" name="negara" id="negara" class="form-control" placeholder="Kewarganegaraan Deteni" />
                            </div>
                            <div class="col-12 text-start mb-3">
                              <label for="kelamin" class="form-label text-dark">Jenis Kelamin</label>
                              <select name="kelamin" class="form-select">
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                              </select>
                            </div>
                            <div class="col-12 text-start mb-5">
                              <label for="foto" class="form-label text-dark">Upload Foto</label>
                              <input class="form-control" type="file" name="foto" id="foto">
                            </div>
                          </div>
                          <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                            <button type="submit" name="submit" class="btn btn-primary">TAMBAH</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="card bg-light">
                <div class="card-header bg-dark text-center fw-normal text-light">
                DAFTAR DETENI PADA RUMAH DETENSI IMIGRASI DENPASAR.
                </div>
                <div class="m-4">
                <table class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3" id="myTable">
                  <thead class="table-dark fs-5">
                    <tr>
                      <th class="text-start text-light" scope="col">NAMA</th>
                      <th class="text-start text-light" scope="col">J.K.</th>
                      <th class="text-start text-light" scope="col">NEGARA</th>
                      <th class="text-light" scope="col">FOTO</th>
                      <th class="text-light" scope="col">AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($deteni as $row ) : ?>
                    <tr class="text-start ms-5">
                      <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["kelamin"]; ?></td>
                      <td class="text-light fw-normal text-uppercase"><?php echo $row["negara"]; ?></td>
                      <td class="text-center "><img src="deteni/<?php echo $row["foto"]; ?>" width="57" height="50" class="img-thumbnail border-dark"></td>
                      <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-primary" type="button" id="dropDown Pilihan" data-bs-toggle="dropdown" aria-expanded="false">
                          PILIH</button>
                            <ul class="dropdown-menu" aria-labelledby="dropDown Pilihan">
                              <li><a class="dropdown-item" href="ubah.php?id=<?php echo $row["deteni_id"]; ?>">UBAH</a></li>
                              <li><a class="dropdown-item" href="depor.php?id=<?php echo $row["deteni_id"]; ?>">DEPORTASI</a></li>
                              <li><a class="dropdown-item" onclick="hapus(<?php echo $row["deteni_id"]; ?>)">HAPUS</a>
                                <script language="javascript">
                                  function hapus(id) {
                                    if(confirm("Apakan anda yakin untuk menghapus Deteni?")) {
                                      window.location.href='hapus.php?id=' + id + '';
                                      return true;
                                    }
                                  }
                                </script>
                              </li>
                            </ul>
                        </div>
                      </td></tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <div class="card bg-light">
                <div class="card-header bg-dark text-center fw-normal text-light">
                DAFTAR DEPORTASI DETENI PADA RUMAH DETENSI IMIGRASI DENPASAR.
                </div>
                <div class="m-4">
                <table class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3" id="exTable">
                  <thead class="table-dark fs-5">
                    <tr>
                      <th class="text-start text-light" scope="col">NAMA</th>
                      <th class="text-start text-light" scope="col">J.K.</th>
                      <th class="text-start text-light" scope="col">NEGARA</th>
                      <th class="text-light" scope="col">TANGGAL</th>
                      <th class="text-light" scope="col">KET.</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($depor as $row ) : ?>
                    <tr class="text-start ms-5">
                      <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["kelamin"]; ?></td>
                      <td class="text-light fw-normal text-uppercase"><?php echo $row["negara"]; ?></td>
                      <td class="text-light fw-normal"><?php echo $row["tanggal"]; ?></td>
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
    $('#exTable').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>