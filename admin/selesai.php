<?php 
session_start();

if(!isset($_SESSION["penjagaan"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$id = $_GET["id"];

$kunjungan = query("SELECT * FROM kunjung WHERE jung_id = $id")[0];

if(arsip($kunjungan) > 0 ) {
  echo "
    <script>
      alert('Berhasil mengarsipkan kunjungan!');
      document.location.href = 'penjagaan.php';
    </script>";
}else {
  echo "
    <script>
      alert('Gagal!');
    </script>";
}

?>