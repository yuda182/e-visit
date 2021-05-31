<?php 
session_start();

require 'functions.php';

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, " SELECT * FROM users WHERE username = '$username' AND password = '$password'");
  $a = mysqli_fetch_assoc($result);
  // cek user
  if (mysqli_num_rows($result) === 1 ) {
      if($a['level']=='Admin'){
        $_SESSION["admin"] = true;
        echo "<script>
              alert('you are logged in as Admin!');
              document.location.href = 'admin/admin.php';
              </script>
              ";
      }else if($a['level']=='KAMTIB'){
        $_SESSION["kamtib"] = true;
         echo "<script>
              alert('you are logged in as KAMTIB!');
              document.location.href = 'admin/kamtib.php';
              </script>
              ";
      }else if($a['level']=='RAP'){
        $_SESSION["rap"] = true;
         echo "<script>
              alert('you are logged in as RAP!');
              document.location.href = 'admin/rap.php';
              </script>
              ";
      }else if($a['level']=='FO'){
        $_SESSION["fo"] = true;
         echo "<script>
              alert('you are logged in as Front Office!');
              document.location.href = 'admin/frontoffice.php';
              </script>
              ";
      }else if($a['level']=='Penjagaan'){
        $_SESSION["penjagaan"] = true;
         echo "<script>
              alert('you are logged in as Guard Team!');
              document.location.href = 'admin/penjagaan.php';
              </script>
              ";
      }else{
        echo "<script>
                  alert('login failed!');
                  </script>
                  ";
      }
  }
}

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
        <a class="navbar-brand" href="index.php#home"> <img src="img/logo1.png" alt="" width="500" height="65" class="d-inline-block align-text-top" /></a>
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
              <a class="nav-link fw-bold text-white" href="loginindo.php">INA <img src="img/indo.png" alt="indo" width="10" height="10" class="d-inline-block align-text-top" /></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- login -->
    <section id="form">
      <div class="container">
        <div class="row text-center mb-5">
          <div class="col text-white fw-bold">
            <h2 class="display-4 text-white fw-bold mb-3">Officer Login</h2>
            <p>a special login page for authorized officials or employees.</p>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-5">
            <form action="" method="post">
              <div class="mb-3">
                <label for="username" class="form-label text-white">Username</label>
                <input type="text" name="username" class="form-control" id="username"  />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control" id="password" />
              </div>
              <button type="submit" name="login" class="btn btn-warning fw-bold">LOGIN</button>
            </form>
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
    </section>
    <!-- end login -->

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
