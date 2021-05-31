<?php

require_once __DIR__ . '/vendor/autoload.php';

require '../functions.php';

$id = $_GET["id"];

$kun = query("SELECT * FROM kunjungan WHERE kun_id = $id")[0];



	//ambil kupon berdasarkan id
	$a = query("SELECT kupon FROM kunjungan WHERE kun_id = $id")[0];
	$qr_kupon = $a["kupon"];

	//QR CODE
	//library phpqrcode
	include "qrcode-image/phpqrcode/qrlib.php";

	//direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
	$tempdir = "qrcode-image/temp/"; 
	if (!file_exists($tempdir))
    mkdir($tempdir);
	
	//isi QRCode saat discan
    $isi_teks = "DOKUMEN ASLI RUDENIM DENPASAR [E-VISIT $qr_kupon]";
    //direktori dan nama logo
    $logopath = 'qrcode-image/imi.png';
    //namafile setelah jadi qrcode
    $namafile = "$qr_kupon.png";
    //kualitas dan ukuran qrcode
    $quality = 'H'; 
    $ukuran = 8; 
    $padding = 0;

    QRCode::png($isi_teks,$tempdir.$namafile,QR_ECLEVEL_H,$ukuran,$padding);
    $filepath = $tempdir.$namafile;
    $QR = imagecreatefrompng($filepath);

    $logo = imagecreatefromstring(file_get_contents($logopath));
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    //besar logo
    $logo_qr_width = $QR_width/2.5;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;

    //posisi logo
    imagecopyresampled($QR, $logo, $QR_width/3.3, $QR_height/3.3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    imagepng($QR,$filepath);


$mpdf = new \Mpdf\Mpdf();

$halaman1 = '

<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		@media print {
			div.break {page-break-after: always;}
		}
		h1 {
			padding-top: 30px;
			text-align: center;
			text-transform: uppercase;
			font-family: Arial, Helvetica, sans-serif;
			font-size:15px;
		}
		h2 {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			text-indent: 30px;
			text-align: left;
			line-height: 1.8;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
			font-weight: normal;
		}
		p {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			text-align: left;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
		}
		strong {
			text-transform: uppercase;
			font-size:15px;
		}
		div {
			padding-top: 15px;
			text-align: center;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
		}
		table {
			width: 90%;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
		}
		.center {
			margin-left: auto;
			margin-right: auto;
		}
		th.judul {
			font-family: Arial, Helvetica, sans-serif;
			font-size:15px;
			text-transform: uppercase;
		}
		th.isi {
			font-family: Arial, Helvetica, sans-serif;
			font-weight: normal;
			font-size:12px;
		}
		div.ket {
			padding-bottom: 15px;
			text-align: center;
		}
		div.absolute {
			padding-top: 15px;
			padding-right: 40px;
			position: absolute;
			right: 0;
			width: 285px;
			height: 185px;
		}
		div.qrcode {
			padding-top: 45px;
			padding-left: 130px;
			position: absolute;
			left: 0;
			width: 100px;
			height: 100px;
		}
	</style>
	<meta charset="UTF-8">
	<title>Dokumen Kunjungan Deteni</title>
</head>
<body>
	<img src="img/header.JPG">
	<h1>Surat Kunjungan Deteni</h1>
	<h2>Pengajuan kunjungan deteni pada Rumah Detensi Imigrasi Denpasar yang telah ditinjau dengan rincian data sebagai berikut : </h2>
	<table border="1" cellpadding="10" cellspacing="0" class="center">
        <tr>
            <th class="judul">Nama</th>
            <th class="judul">Alamat</th>
            <th class="judul">Nama Deteni</th>
            <th class="judul">Negara Asal</th>
        </tr>
        <tr>
            <th class="isi">'. $kun["nama"] .'</th>
            <th class="isi">'. $kun["alamat"] .'</th>
            <th class="isi">'. $kun["deteni"] .'</th>
            <th class="isi">'. $kun["negara"] .'</th>
        </tr>
    </table>
    <div class="ket">
	<span> Pengajuan dengan data tersebut diatas <strong>'.$kun["keterangan"].'</strong> dengan :</span>
	</div>
    <table border="1" cellpadding="10" cellspacing="0" class="center">
		<tr>
            <th> <img style="width: 200px"  src="dokumen/'. $kun["ktp"] .'"> </th>
        </tr>
		<tr>
            <th class="judul">Keterangan</th>
        </tr>
        <tr>
            <th class="isi">'. $kun["status"] .'</th>
        </tr>
    </table>
	<div class="ket">
	<span> Formulir kunjungan ini berlaku sampai dengan (Tahun/Bulan/Tanggal) : <strong>'.$kun["tanggal_berlaku"].'.</strong></span>
	</div>
    <h2> Demikian surat kunjungan ini dibuat untuk dipergunakan sebagaimana mestinya, atas perhatiannya diucapkan terimakasih. </h2>
    <div class="qrcode">
		<img src="qrcode-image/temp/'. $kun["kupon"] .'.png">
    </div>
	<div class="absolute">
    	<img src="img/footer.JPG">
    </div>
</body>
<div class="break"></div>
</html>
<pagebreak />
';
$mpdf->WriteHTML($halaman1);
$mpdf->AddPage();
$halaman2 = '

<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		h1 {
			padding-top: 30px;
			text-align: center;
			text-transform: uppercase;
			font-family: Arial, Helvetica, sans-serif;
			font-size:15px;
		}
		h2 {
			width: 90%;
			padding-top: 30px;
			text-align: left;
			text-transform: uppercase;
			font-family: Arial, Helvetica, sans-serif;
			font-size:15px;
			font-weight: bold;
		}
		h3 {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			text-indent: 30px;
			text-align: left;
			line-height: 1.8;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
			font-weight: normal;
		}
		h4 {
			width: 70%;
			margin-left: auto;
			margin-right: auto;
			padding-top: 30px;
			text-align: center;
			font-family: Arial, Helvetica, sans-serif;
			font-size:15px;
			font-weight: normal;
		}
		span {
			font-size:15px;
			font-weight: bold;
		}
		p {
			width: 80%;
			margin-left: auto;
			margin-right: auto;
			text-align: left;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
			line-height: 1.8;
		}
		strong {
			text-transform: uppercase;
			font-size:12px;
		}
		div {
			padding-top: 15px;
			text-align: center;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
		}
		table {
			width: 90%;
			font-family: Arial, Helvetica, sans-serif;
			font-size:12px;
		}
		.center {
			margin-left: auto;
			margin-right: auto;
		}
		th.judul {
			font-family: Arial, Helvetica, sans-serif;
			font-size:15px;
			text-transform: uppercase;
		}
		th.isi {
			font-family: Arial, Helvetica, sans-serif;
			font-weight: normal;
			font-size:12px;
		}
		div.ket {
			padding-bottom: 15px;
			text-align: center;
		}
		div.absolute {
			padding-top: 15px;
			padding-right: 40px;
			position: absolute;
			right: 0;
			width: 285px;
			height: 185px;
		}
		div.qrcode {
			padding-top: 45px;
			padding-left: 130px;
			position: absolute;
			left: 0;
			width: 100px;
			height: 100px;
		}
	</style>
	<meta charset="UTF-8">
	<title>Dokumen Kunjungan Deteni</title>
</head>
<body>
	<img src="img/header.JPG">
	<h1>Jadwal Kunjungan Deteni</h1>
	<h3>Jadwal kunjungan deteni pada Rumah Detensi Imigrasi Denpasar yang telah ditetapkan sebagai berikut : </h3>
	<table border="1" cellpadding="10" cellspacing="0" class="center">
        <tr>
            <th class="judul">Hari</th>
            <th class="judul">Jam Kunjungan</th>
        </tr>
        <tr>
            <th class="isi">Selasa</th>
            <th class="isi"><strong>09.00 WITA</strong> s.d. <strong>11.00 WITA</strong> & <strong>13.00 WITA</strong> s.d. <strong>15.00 WITA</strong></th>
        </tr>
		<tr>
            <th class="isi">Kamis</th>
            <th class="isi"><strong>09.00 WITA</strong> s.d. <strong>11.00 WITA</strong> & <strong>13.00 WITA</strong> s.d. <strong>15.00 WITA</strong></th>
        </tr>
    </table>
    <h2>Tata Tertib Pengunjung :</h2>
	<p>1. Berkunjung pada jadwal Kunjungan;</p>
	<p>2. Pengunjung wajib berpakaian rapi dan sopan;</p>
	<p>3. Pengunjung wajib membawa kartu identitas yang asli dan masih berlaku, untuk Warga Negara Indonesia dan Penduduk Tetap (KTP,SIM,KITAS/KITAP,Kartu Diplomatik) atau paspor bagi Warga Negara Asing;</p>
	<p>4. Tidak membawa barang-barang yang berbahaya seperti senjata tajam, senjata api, bahan peledak dan narkoba.</p>
	<h4>Segala kegiatan kunjungan pada Rumah Detensi Imigrasi Denpasar <span>TIDAK DIPUNGUT BIAYA!!</span></h4>
</body>
</html>

';
$mpdf->WriteHTML($halaman2);
$mpdf->Output('Surat Kunjungan_'. $kun["nama"] .'.pdf', 'D');
?>