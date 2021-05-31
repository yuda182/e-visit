<?php 
require 'functions.php';

if (isset($_POST["submit"])) {
  
    if ( visit($_POST) > 0 ) {
        echo "
              <script>
                alert('Check your email regularly!');
                document.location.href = 'email.php';
                </script>
                ";
          } else {
            echo "
              <script>
                alert('failed !, follow the guide or contact us!!');
                </script>
                ";
          }
    
}
//$deteni = query("SELECT * FROM deteni");

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
        <a class="navbar-brand" href="index.php"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="index.php#guide">GUIDE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="index.php#about">ABOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="index.php#contact">CONTACT</a>
            </li>
            <button class="btn btn-outline-warning ms-2 me-2" type="button" onclick="window.location='login.php'">LOGIN</button>
            <li class="nav-item">
              <a class="nav-link fw-bold text-white" href="visitindo.php">INA <img src="img/indo.png" alt="indo" width="10" height="10" class="d-inline-block align-text-top" /></a>
            </li>
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
            <h2 class="display-4 text-white fw-bold">Visiting Form</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6">
            <h3 class="text-white fw-bold mb-3">Hint :</h3>
            <p class="text-white">1. (*) have to upload a legal  documents.</p>
            <p class="text-white">2. Identity Card : KTP/ SIM/ Passpor/ Visa.</p>
            <p class="text-white">3. Fill Identity form with active phone number and email for Confirmation.</p>
            <p class="text-white">4. Make sure Detainee's Name and Nationality is correct.</p>
            <p class="text-white">5. Example Picture to Upload :</p>
            <img src="img/home/ktp.png" style="width: 300px" class="img-thumbnail mb-4 me-2" alt="ilustrasi" />
            <img src="img/home/kk.png" style="width: 300px" class="img-thumbnail mb-4" alt="ilustrasi" />
          </div>
          <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
              <div>
                <label for="noktp" class="form-label"></label>
                <input type="number" name="noktp" id="noktp" class="form-control" placeholder="ID Card Number" />
              </div>
              <div>
                <label for="nama" class="form-label"></label>
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Full Name" />
              </div>
              <div>
                <label for="alamat" class="form-label"></label>
                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Address" />
              </div>
              <div>
                <label for="nohp" class="form-label"></label>
                <input type="number" name="nohp" id="nohp" class="form-control" placeholder="Phone Number" />
              </div>
              <div>
                <label for="email" class="form-label"></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
              </div>
              <div>
                <label for="deteni" class="form-label"></label>
                <input type="text" name="deteni" id="deteni" class="form-control" placeholder="detainee's Name" />
              </div>
              <div>
                <label for="negara" class="form-label"></label>
                <input type="text" name="negara" id="negara" class="form-control" placeholder="Detainee Nationality" />
              </div>
              <div class="mt-3 mb-3">
                <label for="ktp" class="form-label text-white">*Upload ID Card</label>
                <input class="form-control" type="file" name="ktp" id="ktp" required>
              </div>
              <div class="mb-3">
                <label for="kk" class="form-label text-white">*Upload relation Document</label>
                <input class="form-control" type="file" name="kk" id="kk" required>
              </div>
              <button type="submit" name="submit" class="btn btn-warning mt-3"><a class="text-dark fw-bold text-decoration-none">SUBMIT</a></button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
