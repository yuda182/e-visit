<?php
session_start();

if(!isset($_SESSION["fo"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$id = $_GET["id"];

$kunjungan = query("SELECT * FROM kunjungan WHERE kun_id = $id")[0];

if(kunjung($kunjungan) > 0 ) {
  echo "
    <script>
      alert('Berhasil mengirim kunjungan!');
      document.location.href = 'frontoffice.php';
    </script>";
}else {
  echo "
    <script>
      alert('Gagal!');
    </script>";
}

?>