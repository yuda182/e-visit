<?php 
session_start();

if(!isset($_SESSION["admin"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$kunjungan = query("SELECT count(*) AS jumlah FROM kunjungan");

$deteni = query("SELECT count(*) AS jumlah FROM deteni");

$laki = query("SELECT count(*) AS pria FROM deteni WHERE kelamin = 'Laki-Laki'");

$perem = query("SELECT count(*) AS wanita FROM deteni WHERE kelamin = 'Perempuan'");

$admin = query("SELECT count(*) AS admin FROM users WHERE level = 'Admin'");

$kamtib = query("SELECT count(*) AS kamtib FROM users WHERE level = 'KAMTIB'");

$rap = query("SELECT count(*) AS rap FROM users WHERE level = 'RAP'");

$fo = query("SELECT count(*) AS fo FROM users WHERE level = 'FO'");

$jaga = query("SELECT count(*) AS penjagaan FROM users WHERE level = 'Penjagaan'");

$kun = query("SELECT * FROM kunjungan ORDER BY kun_id DESC LIMIT 5");

$kunjung = query("SELECT * FROM kunjung WHERE status = 'Selesai'");

$det = query("SELECT * FROM deteni ORDER BY deteni_id DESC LIMIT 4");

$dtni = query(" SELECT * FROM deteni");

$dep = query("SELECT * FROM deportasi ORDER BY depor_id DESC LIMIT 4");

$depor = query("SELECT * FROM deportasi");

$feedback = query("SELECT * FROM feedback LIMIT 5");

$fdbck = query("SELECT * FROM feedback");

if (isset($_POST["tambah"])) {
  
  if ( tambahuser($_POST) > 0 ) {
      echo "
            <script>
              alert('User berhasil ditambahkan!');
              document.location.href = 'admin.php';
              </script>
              ";
        } else {
          echo "
            <script>
              alert('gagal menambahkan User!');
              </script>
              ";
        }
  
}

if (isset($_POST["submit"])) {
  
  if ( tambah($_POST) > 0 ) {
      echo "
            <script>
              alert('Deteni berhasil ditambahkan!');
              document.location.href = 'admin.php';
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
<<html lang="en">
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
      <nav class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="admin.php"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
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

    <!-- visit -->

    <section id="form">
      <div class="container">
        <div class="row text-center">
          <div class="col mb-3">
            <div class="card bg-dark ">
              <div class="card-body">
              <h2 class="display-5 text-light fw-bold">HALAMAN ADMINISTRATOR </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- lihat Kunjungan -->
          <div class="col-md-3 mb-3">
            <div class="card bg-dark">
              <div class="card-header bg-transparent text-start fw-bold text-light">
                KUNJUNGAN DETENI
              </div>
              <div class="card-body">
                <?php foreach ($kun as $row ) : ?>
                <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["nama"]; ?> | <?php echo $row["deteni"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <div class="d-grid gap-2">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#kunjungan">LIHAT DAFTAR</button>
                    <div class="modal fade" id="kunjungan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kunjunganLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="kunjunganLabel">KUNJUNGAN DETENI</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-12">
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
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <!-- lihat rekap -->
          <div class="col-md-6 mb-2">
            <div class="card bg-dark">
              <div class="card-header bg-transparent text-start fw-bold text-light">
                FEEDBACK PENGUNJUNG
              </div>
              <div class="card-body">
                <?php foreach ($feedback as $row ) : ?>
                <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["nama"]; ?> | <?php echo $row["pesan"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#feedback">LIHAT DAFTAR</button>
                    <div class="modal fade" id="feedback" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="feedbackLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="feedbackLabel">FEEDBACK PENGUNJUNG</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-12">
                                  <table id="my1Table" class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3">
                                    <thead class="table-dark">
                                      <tr>
                                        <th class="text-start text-light" scope="col">NAMA</th>
                                        <th class="text-start text-light" scope="col">EMAIL</th>
                                        <th class="text-start text-light" scope="col">PESAN</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($fdbck as $row ) : ?>
                                      <tr class="text-start ms-5">
                                        <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                                        <td class="text-light fw-normal"><?php echo $row["email"]; ?></td>
                                        <td class="text-light fw-normal"><?php echo $row["pesan"]; ?></td>
                                      <?php endforeach; ?>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <!-- lihat user -->
          <div class="col-md-3 mb-2">
            <div class="card bg-dark">
              <div class="card-header bg-transparent text-start fw-bold text-light">
              JUMLAH USER
              </div>
              <div class="card-body">
                <?php foreach ($admin as $row ) : ?>
                  <input class="form-control mb-3 text-center" type="text" placeholder="ADMIN : <?php echo $row["admin"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <?php foreach ($kamtib as $row ) : ?>
                  <input class="form-control mb-3 text-center" type="text" placeholder="KAMTIB : <?php echo $row["kamtib"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <?php foreach ($rap as $row ) : ?>
                  <input class="form-control mb-3 text-center" type="text" placeholder="RAP : <?php echo $row["rap"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <?php foreach ($fo as $row ) : ?>
                  <input class="form-control mb-3 text-center" type="text" placeholder="FO : <?php echo $row["fo"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <?php foreach ($jaga as $row ) : ?>
                  <input class="form-control mb-3 text-center" type="text" placeholder="PENJAGAAN : <?php echo $row["penjagaan"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <div class="d-grid gap-2">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahUSer">TAMBAH USER</button>
                    <div class="modal fade" id="tambahUSer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahUSerLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="tambahUSerLabel">TAMBAH DETENI</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                              <div class="mb-3">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
                              </div>
                              <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="password" />
                              </div>
                              <div class="mb-3">
                                <label for="level" class="form-label">Level Akun</label>
                                <select name="level" class="form-select">
                                  <option value="Admin">Admin</option>
                                  <option value="KAMTIB">KAMTIB</option>
                                  <option value="RAP">RAP</option>
                                  <option value="FO">FO</option>
                                  <option value="Penjagaan">Regu Jaga</option>
                                </select>
                              </div>
                              <div class="text-end mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                                <button type="submit" name="tambah" class="btn btn-primary">TAMBAH</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <!-- lihat Deteni -->
          <div class="col-md-3 mb-4">
            <div class="card bg-dark">
              <div class="card-header bg-transparent text-start fw-bold text-light">
                DETENI
              </div>
              <div class="card-body">
                <?php foreach ($det as $row ) : ?>
                <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["nama"]; ?> | <?php echo $row["negara"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <div class="d-grid gap-2">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Deteni">LIHAT DAFTAR</button>
                    <div class="modal fade" id="Deteni" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DeteniLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="DeteniLabel">DAFTAR DETENI</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-12">
                                  <table id="my2Table" class="table table-responsive-md table-dark table-hover border border-dark border-2 rounded-3">
                                    <thead class="table-dark fs-5">
                                      <tr>
                                        <th class="text-start text-light" scope="col">NAMA</th>
                                        <th class="text-start text-light" scope="col">J.K.</th>
                                        <th class="text-start text-light" scope="col">NEGARA</th>
                                        <th class="text-light" scope="col">FOTO</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($dtni as $row ) : ?>
                                        <tr class="text-start ms-5">
                                          <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                                          <td class="text-light fw-normal"><?php echo $row["kelamin"]; ?></td>
                                          <td class="text-light fw-normal text-uppercase"><?php echo $row["negara"]; ?></td>
                                          <td class="text-center "><img src="deteni/<?php echo $row["foto"]; ?>" width="57" height="50" class="img-thumbnail border-dark"></td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <!-- lihat deportasi -->
          <div class="col-md-3 mb-4">
            <div class="card bg-dark">
              <div class="card-header bg-transparent text-start fw-bold text-light">
                DEPORTASI
              </div>
              <div class="card-body">
                <?php foreach ($dep as $row ) : ?>
                <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["nama"]; ?> | <?php echo $row["negara"]; ?> | <?php echo $row["keterangan"]; ?>" aria-label="Disabled input example" disabled>
                <?php endforeach; ?>
                <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Depor">LIHAT DAFTAR</button>
                  <div class="modal fade" id="Depor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="DeporLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="DeporLabel">DAFTAR DEPORTASI DETENI</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-md-12">
                                <table class="table table-responsive-sm table-dark table-hover border border-dark border-2 rounded-3" id="my3Table">
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
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- lihat jumlah deteni -->
          <div class="col-md-6 mb-4">
            <div class="card bg-dark">
              <div class="card-header bg-transparent text-start fw-bold text-light">
              JUMLAH DETENI
              </div>
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-sm-6">
                    <div class="d-grid gap-2 mb-3">
                      <button class="btn border-2 btn-outline-light text-light fw-bolder">LAKI-LAKI</button>
                    </div>
                      <?php foreach ($laki as $row ) : ?>
                        <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["pria"]; ?>" aria-label="Disabled input example" disabled>
                      <?php endforeach; ?>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-grid gap-2 mb-3">
                      <button class="btn border-2 btn-outline-light text-light fw-bolder ">PEREMPUAN</button>
                    </div>
                      <?php foreach ($perem as $row ) : ?>
                        <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["wanita"]; ?>" aria-label="Disabled input example" disabled>
                      <?php endforeach; ?>
                  </div>
                </div>
                <div class="d-grid gap-2 mb-3">
                  <button class="btn border-2 btn-outline-light text-light fw-bolder">TOTAL</button>
                </div>
                  <?php foreach ($deteni as $row ) : ?>
                    <input class="form-control mb-3 text-center" type="text" placeholder="<?php echo $row["jumlah"]; ?>" aria-label="Disabled input example" disabled>
                  <?php endforeach; ?>
                <div class="d-grid gap-2">
                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahDeteni">TAMBAH DETENI</button>
                  <div class="modal fade" id="tambahDeteni" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahDeteniLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="tambahDeteniLabel">TAMBAH DETENI</h5>
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
            </div>
          </div>
        </div>
      </div>
      </section>
    <!-- end visit -->
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
    $('#my1Table').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $('#my2Table').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $('#my3Table').DataTable({
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