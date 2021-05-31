<?php 
session_start();

if(!isset($_SESSION["kamtib"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$deteni = query("SELECT * FROM deteni");

$id = $_GET["id"];

$kun = query("SELECT * FROM kunjungan WHERE kun_id = $id")[0];

if(isset($_POST["submit"])){
      
          if(ubah($_POST) > 0 ) {
            echo "
              <script>
                alert('Berhasil mengupdate data!');
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
        <a class="navbar-brand" href="kamtib.php"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <button class="btn btn-primary" type="button" onclick="window.location='kamtib.php'">DAFTAR KUNJUNGAN</button>
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
            <h2 class="display-4 text-white fw-bold mb-3 text-uppercase">Halaman Verifikasi</h2>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-md-7 mb-5">
            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="kun_id" value="<?= $kun["kun_id"]; ?>">
                <input type="hidden" name="noktp" value="<?= $kun["noktp"]; ?>">
                <input type="hidden" name="nama" value="<?= $kun["nama"]; ?>">
                <input type="hidden" name="tanggal_pengajuan" value="<?= $kun["tanggal_pengajuan"]; ?>">
                <input type="hidden" name="alamat" value="<?= $kun["alamat"]; ?>">
                <input type="hidden" name="ktplama" value="<?= $kun["ktp"]; ?>">
                <input type="hidden" name="kklama" value="<?= $kun["kk"]; ?>">
              <div class="col-md-6">
                <label for="noktp" class="form-label text-white">No. Identitas</label>
                <input type="number" class="form-control" id="noktp" placeholder="<?= $kun["noktp"]; ?>" disabled>
              </div>
              <div class="col-md-6">
                <label for="nama" class="form-label text-white">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="<?= $kun["nama"]; ?>" disabled>
              </div>
              <div class="col-12">
                <label for="alamat" class="form-label text-white">Alamat</label>
                <input type="text" class="form-control" id="alamat" placeholder="<?= $kun["alamat"]; ?>" disabled>
              </div>
              <div class="col-md-6">
                <label for="nohp" class="form-label text-white">No. Telfon/HP</label>
                <input type="number" class="form-control" name="nohp" id="nohp" value="<?= $kun["nohp"]; ?>">
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label text-white">Email</label>
                <input type="email" class="form-control"name="email" id="email" value="<?= $kun["email"]; ?>">
              </div>
              <div class="col-md-4">
                <label for="deteni" class="form-label text-white">Nama Deteni</label>
                <input type="text" class="form-control" name="deteni" id="deteni" value="<?= $kun["deteni"]; ?>">
              </div>
              <div class="col-md-4">
                <label for="negara" class="form-label text-white">Kebangsaan Deteni</label>
                <input type="text" class="form-control" name="negara" id="negara" value="<?= $kun["negara"]; ?>">
              </div>
              <div class="col-md-4">
                <label for="tanggal" class="form-label text-white">Masa berlaku kunjungan</label>
                <input type="date" class="form-control" name="tanggal_berlaku" id="tanggal" required>
              </div>
              <div class="col-md-4">
                <label for="keterangan" class="form-label text-white">Status Kunjungan</label>
                <select name="keterangan" class="form-select">
                  <?php
                    if($kun["keterangan"] == "Ditolak"){
                      echo "<option name='keterangan' value='Ditolak'> Ditolak </option>";
                      echo "<option name='keterangan' value='Disetujui'> Disetujui </option>";
                    }else{
                      echo "<option name='keterangan' value='Disetujui'> Disetujui </option>";
                      echo "<option name='keterangan' value='Ditolak'> Ditolak </option>";
                    }
                  ?>
                </select>
              </div>
              <div class="col-md-8">
                <label for="status" class="form-label text-white">Keterangan Kunjungan</label>
                <textarea class="form-control" name="status" id="status" placeholder="<?= $kun["status"]; ?>" style="height: 100px" required></textarea>
              </div>
              <label for="dokumen" class="form-label text-white">Dokumen Identitas dan Bukti Hubungan</label>
              <div class="zoom col-md-6">
                <img src="dokumen/<?= $kun["ktp"]; ?>" style="width: 400px" class="img-thumbnail" id="dokumen">
              </div>
              <div class="zoom col-md-6">
                <img src="dokumen/<?= $kun["kk"]; ?>" style="width: 400px" class="img-thumbnail" id="dokumen">
              </div>
              <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary ms-2" type="button">SELESAI</button>
                <button type="button" class="btn btn-primary ms-2" onclick="window.location='cetak.php?id=<?= $id; ?>'" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                  KIRIM EMAIL
                </button>
            </form>
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Kirim Email konfirmasi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="kirim_email.php" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-6 mb-3">
                            <input type="hidden" name="nama" value="<?= $kun["nama"]; ?>">
                            <input type="email" class="form-control" name="email_penerima" value="<?= $kun["email"]; ?>">
                          </div>
                          <div class="col-6 mb-3">
                            <input type="text" class="form-control" name="subjek" value="<?= $kun["keterangan"]; ?>">
                          </div>
                          <div class="col-12 mb-3">
                            <textarea class="form-control" name="pesan" placeholder="Pesan kepada Pemohon" rows="3" required></textarea>
                          </div>
                          <div class="col-12 mb-3">
                            <input class="form-control form-control mb-3" name="attachment" type="file" required>
                          </div>
                        </div>
                        <div class="text-end">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                          <button type="submit" name="kirim" class="btn btn-primary">KIRIM EMAIL</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
          <div class="col-md-5">
            <h2 class="text-center text-white fw-bold mb-3">DAFTAR DETENI PADA RUDENIM DENPASAR</h2>
            <p class="text-center text-white mb-3">sesuaikan Nama dan Negara asal deteni pada pengajuan kunjungan dengan data berikut ini.</p>
            <div class="card bg-light">
              <div class="m-4">
                <table class="table table-dark table-hover border border-dark border-2 rounded-3 text-center" id="myTable">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-light" scope="col">NAMA</th>
                      <th class="text-light" scope="col">NEGARA ASAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($deteni as $row ) : ?>
                    <tr class="ms-5">
                      <td class="text-light fw-normal"><?php echo $row["nama"]; ?></td>
                      <td class="text-light fw-normal text-uppercase"><?php echo $row["negara"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end visit -->

    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>