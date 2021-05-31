<?php 
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

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
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="#guide">PANDUAN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="#about">TENTANG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="#contact">KONTAK</a>
            </li>
            <button class="btn btn-outline-warning ms-2 me-2" type="button" onclick="window.location='loginindo.php'">LOGIN</button>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="index.php">ENG <img src="img/en.png" alt="eg" width="10" height="10" class="d-inline-block align-text-top" /></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- home -->
    <section id="home" class="jumbotron text-start">
      <div class="container">
        <div class="row justify-content-evenly">
          <div class="d-flex align-items-center col-md-6 mt-6 text-white">
            <div class="d-flex flex-column bd-highlight mb-3">
              <div class="display-4 text-white fw-bold mb-3">e-Visit</div>
              <div class="lead text-white mb-3">Berkunjung dengan mudah melalui ponsel atau tablet Anda.</div>
              <div class="d-grid gap-2 d-md-block">
                <div class="btn btn-warning fw-bold mb-3" role="button" onclick="window.location='visitindo.php'">KUNJUNGI SEKARANG</div>
              </div>
            </div>
          </div>
          <div class="col-md-5 mb-3">
            <div class="card bg-transparent border-0">
              <img src="img/home/1.png" class="card-img-top" alt="ilustrasi" />
            </div>
          </div>
        </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#141414"
          fill-opacity="1"
          d="M0,128L60,160C120,192,240,256,360,245.3C480,235,600,149,720,128C840,107,960,149,1080,154.7C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
        ></path>
      </svg>
    </section>
    <!-- end home -->

    <!-- guide -->
    <section id="guide">
      <a name="guide">
        <div class="container">
          <div class="row text-center mb-5">
            <div class="col text-white fw-bold">
              <h2 class="display-4 text-white fw-bold">Panduan Kunjungan</h2>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-4 mb-3 text-white">
              <p class="fw=normal">pesan kunjungan Anda pada jadwal kunjungan yaitu : Selasa dan Kamis.</p>
              <p class="fw=normal">untuk bantuan, hubungi kami di 0881 037 227 229</p>
              <p class="fw=bold">Berdasarkan Standar Operasional Prosedur Kunjungan.</p>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card bg-transparent border-0">
                <img src="img/guide/indo.png" class="card-img-top" alt="alur" />
              </div>
            </div>
          </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path
            fill="#222222"
            fill-opacity="1"
            d="M0,160L60,144C120,128,240,96,360,112C480,128,600,192,720,181.3C840,171,960,85,1080,64C1200,43,1320,85,1380,106.7L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
          ></path>
        </svg>
      </a>
    </section>
    <!-- end guide -->

    <!-- about -->
    <section id="about">
      <a name="about">
        <div class="container">
          <div class="row text-center mb-5 text-white">
            <div class="col">
              <h2 class="display-4 text-white fw-bold mb-5">Tentang Kami</h2>
              <p>
                Rumah Detensi Imigrasi memiliki 3 tugas pokok yaitu melaksanakan tugas penindakan, melaksanakan tugas pengisolasian, melaksanakan tugas pemulangan dan pengusiran / deportasi. Pemulangan adalah mengembalikan orang asing dari wilayah Negara
                Republik Indonesia ke negara asal atau ke negara lain yang menerimanya. Pengusiran atau Deportasi adalah Tindakan mengeluarkan Orang Asing dari Wilayah Republik Indonesia karena keberadaanya tidak dikehendaki.
              </p>
            </div>
          </div>
          <div class="row justify-content-center fs-5 text-center">
            <div class="col-md-4 mb-3 text-white">
              <div class="card bg-dark">
                <img src="img/gallery/1.jpeg" class="card-img-top" alt="1" />
                <div class="card-body">
                  <p class="card-text text-white">Kegiatan Perkantoran.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3 text-white">
              <div class="card bg-dark">
                <img src="img/gallery/2.jpeg" class="card-img-top" alt="1" />
                <div class="card-body">
                  <p class="card-text text-white">Kegiatan Pendetensian.</p>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3 text-white">
              <div class="card bg-dark">
                <img src="img/gallery/3.jpeg" class="card-img-top" alt="1" />
                <div class="card-body">
                  <p class="card-text text-white">Kegiatan Pendeportasian.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path
            fill="#141414"
            fill-opacity="1"
            d="M0,128L60,160C120,192,240,256,360,245.3C480,235,600,149,720,128C840,107,960,149,1080,154.7C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
          ></path>
        </svg>
      </a>
    </section>
    <!-- end about -->

    <!-- contact -->
    <?php 
      if(isset($_POST["submit"])){
        
        if(feedback($_POST) > 0 ) {
          echo "<script>
              alert('Terimakasih atas masukan anda!');
              </script>
              ";
        } else {
          echo "
            <script>
              alert('gagal mengirim masukan!');
              </script>
              ";
        }
      }
    ?>
    <section id="contact">
      <a name="about">
        <div class="container">
          <div class="row text-center mb-5">
            <div class="col text-white fw-bold">
              <h2 class="display-4 text-white fw-bold mb-3">Kontak Kami</h2>
              <p>jangan ragu untuk menghubungi kami jika anda mengalami kendala, kepuasan anda adalah prioritas kami.</p>
            </div>
          </div>
          <div class="row justify-content-evenly">
            <div class="col-md-6 mb-3">
              <p class="text-white fw-bold fs-3">Hubungi kami di :</p>
              <p class="text-white"><i class="bi bi-telephone"></i> : (+62361) 704723 | <i class="bi bi-phone"></i> : 0881 037 227 229</p>
              <p class="text-white">
                <a href="https://www.instagram.com/rudenim_bali/" class="text-white text-decoration-none"><i class="bi bi-instagram"></i> : Rudenim_Bali</a> |
                <a href="https://twitter.com/rudenim_bali" class="text-white text-decoration-none"><i class="bi bi-twitter"></i> : Rudenim_Bali</a> |
                <a href="https://www.facebook.com/rudenimdenpasar.bali.5" class="text-white text-decoration-none"><i class="bi bi-facebook"></i> : Rudenim Bali</a> |
                <a href="https://www.youtube.com/channel/UCUHV2iLcJ-NB5vDwA4_yCsg" class="text-white text-decoration-none"><i class="bi bi-youtube"></i> : Rudenim Denpasar</a>
              </p>
              <form action="" method="post">
                <div>
                  <label for="name" class="form-label text-white fw-bold fs-3">atau Berikan Masukan :</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap" />
                </div>
                <div>
                  <label for="email" class="form-label"></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email" />
                </div>
                <div>
                  <label for="pesan" class="form-label"></label>
                  <textarea class="form-control" placeholder="pesan" name="pesan" id="pesan" rows="6"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-warning mt-3"><a class="text-dark fw-bold text-decoration-none">KIRIM</a></button>
              </form>
            </div>
            <div class="col-md-6 map-responsive">
              <iframe
                class="border border-white border-4 rounded-3"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2788.060773135776!2d115.16099813858118!3d-8.7942104712396!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb665752e4f42221!2sRumah%20Detensi%20Imigrasi%20Denpasar!5e0!3m2!1sid!2sid!4v1619771857394!5m2!1sid!2sid"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
              ></iframe>
            </div>
          </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path
            fill="#222222"
            fill-opacity="1"
            d="M0,160L60,144C120,128,240,96,360,112C480,128,600,192,720,181.3C840,171,960,85,1080,64C1200,43,1320,85,1380,106.7L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
          ></path>
        </svg>
      </a>
    </section>
    <!-- end contact -->

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
