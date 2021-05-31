<?php 
session_start();

if(!isset($_SESSION["rap"])){
    header("location: ../login.php");
    exit;
}

require '../functions.php';

$id = $_GET["id"];

$edit = query("SELECT * FROM deteni WHERE deteni_id = $id")[0];

if (isset($_POST["submit"])) {

    if ( ubahdeteni($_POST) > 0 ) {
        echo "
            <script>
                alert('Data deteni berhasil diubah!');
                document.location.href = 'rap.php';
                </script>
                ";
    } else {
        echo "
            <script>
                alert('gagal mengubah data Deteni!');
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
                        <button class="btn btn-primary" type="button" onclick="window.location='rap.php'">DATA DETENI</button>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- end navbar -->

    <!-- dashboard -->
        <section id="form">
            <a name="rap">
                <div class="container">
                    <div class="row text-center mb-5">
                        <div class="col text-white fw-bold">
                            <h2 class="display-4 text-white fw-bold">Ubah data Deteni</h2>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="deteni_id" value="<?= $edit["deteni_id"]; ?>">
                                <input type="hidden" name="fotolama" value="<?= $edit["foto"]; ?>">
                                <div>
                                    <label for="nama" class="form-label"></label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $edit["nama"]; ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="negara" class="form-label"></label>
                                    <input type="text" name="negara" id="negara" class="form-control" value="<?= $edit["negara"]; ?>" />
                                </div>
                                <div class="mb-3">
                                <label for="kelamin" class="form-label text-white">Jenis Kelamin</label>
                                <select name="kelamin" class="form-select">
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                </div>
                                <div class="text-center">
                                    <img src="deteni/<?php echo $edit["foto"]; ?>" width="300" height="300" class="img-thumbnail border-dark mb-2">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label text-white">Upload Foto</label>
                                    <input class="form-control" type="file" name="foto" id="foto">
                                </div>
                                <div class="text-end">
                                    <button type="submit" name="submit" class="btn btn-primary">KIRIM</button>
                                </div>
                                
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
            </a>
        </section>
    <!-- end dashboard -->

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