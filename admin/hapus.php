<?php
session_start();

if(!isset($_SESSION["rap"])){
  header("location: ../login.php");
  exit;
}

require '../functions.php';

$id = $_GET["id"];

if (hapus($id) > 0 ) {
	echo "
      <script>
        alert('Deteni berhasil dihapus!');
        document.location.href = 'rap.php';
      </script>";
} else {
    echo "
      <script>
        alert('gagal menghapus Deteni!');
        document.location.href = 'rap.php';
      </script>";
}

?>