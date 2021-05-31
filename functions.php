<?php
// connect db
$conn = mysqli_connect("localhost","root","","evisit");

// query data
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc( $result ) ) {
		$rows [] = $row;
	}
	return $rows;
}

function feedback($datafb){
	global $conn;
	$name = htmlspecialchars($datafb["name"]);
    $email = htmlspecialchars($datafb["email"]);
    $pesan = htmlspecialchars($datafb["pesan"]);


    $query = "INSERT INTO Feedback
                VALUES
                ('$name','$email','$pesan')
                ";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}


function tambah($data){
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
    $negara = htmlspecialchars($data["negara"]);
    $kelamin = htmlspecialchars($data["kelamin"]);
    $foto = uploadfoto($data);
    	if (!$foto) {
    		return false;
		}

    $query = "INSERT INTO deteni 
                VALUES
                ('', '$nama', '$negara','$kelamin', '$foto')
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function uploadfoto($namaInput){
	$namaFile = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	//cek upload
	if ($error === 4) {
		echo "<script>
				alert('Upload data!');
				</script>";
		return false;
	}

	//cek tipe data
	$ekstensiValid = ['jpg','jpeg'];
	$ekstensifoto = explode('.', $namaFile);
	$ekstensifoto = strtolower(end($ekstensifoto));
	if (!in_array($ekstensifoto, $ekstensiValid)) {
		echo "<script>
				alert('wrong data!');
				</script>";
		return false;
	}

	//cek ukuran
	if ($ukuranFile > 2000000) {
		echo "<script>
				alert('file size error!');
				</script>";
		return false;
	}

	//ubah nama file
	$namaFileBaru = $namaInput['nama'];
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensifoto;

	//upload
	move_uploaded_file($tmpName, 'deteni/' . $namaFileBaru);

	return $namaFileBaru;
}

function ubahdeteni($data){
	global $conn;

	$id = $data["deteni_id"];
	$nama = $data["nama"];
	$negara = $data["negara"];
	$kelamin = $data["kelamin"];
	$fotolama = $data["fotolama"];

	if($_FILES['foto']['error'] === 4){ 
		$foto = $fotolama;
	}else{
		$foto = uploadfoto($data);
		unlink("deteni/$fotolama");
	}

	$query = "UPDATE deteni SET
					nama = '$nama',
					negara = '$negara',
					kelamin = '$kelamin',
					foto = '$foto'					
				WHERE deteni_id = $id
				";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function depor($data){
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
    $negara = htmlspecialchars($data["negara"]);
    $kelamin = htmlspecialchars($data["kelamin"]);
    $tanggal = $data["tanggal"];
    $keterangan = $data["keterangan"];


    $query = "INSERT INTO deportasi 
                VALUES
                ('', '$nama', '$negara','$kelamin','$tanggal','$keterangan')
            ";

    mysqli_query($conn, $query);

    mysqli_query($conn, "DELETE FROM deteni WHERE deteni_id = $id");

    return mysqli_affected_rows($conn);

}

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM deteni WHERE deteni_id = $id");
	return mysqli_affected_rows($conn);
}

function tambahuser($data){
	global $conn;

	$username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $level = htmlspecialchars($data["level"]);

    $query = "INSERT INTO users 
                VALUES
                ('', '$username', '$password','$level' )
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function visit($pengunjung){
	global $conn;

	$noktp = htmlspecialchars($pengunjung["noktp"]);
	$nama = htmlspecialchars($pengunjung["nama"]);
	$alamat = htmlspecialchars($pengunjung["alamat"]);
	$nohp = htmlspecialchars($pengunjung["nohp"]);
	$email = htmlspecialchars($pengunjung["email"]);
	$deteni = htmlspecialchars($pengunjung["deteni"]);
    $negara = htmlspecialchars($pengunjung["negara"]);
    $tanggal_pengajuan = date("Y-m-d");
    $ktp = upload($pengunjung);
    	if (!$ktp) {
    		return false;
		}
	$kk = upload2($pengunjung);
    	if (!$kk) {
    		return false;
		}

    $query = "INSERT INTO kunjungan 
                VALUES
                ('', '$noktp', '$nama','$alamat','$nohp','$email','$deteni','$negara'
                ,'$tanggal_pengajuan','','$ktp','$kk','Tolak','Belum Ditinjau','' )
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function upload($namaInput){
	$namaFile = $_FILES['ktp']['name'];
	$ukuranFile = $_FILES['ktp']['size'];
	$error = $_FILES['ktp']['error'];
	$tmpName = $_FILES['ktp']['tmp_name'];

	//cek upload
	if ($error === 4) {
		echo "<script>
				alert('Upload data!');
				</script>";
		return false;
	}

	//cek tipe data
	$ekstensiValid = ['jpg','jpeg','png'];
	$ekstensifoto = explode('.', $namaFile);
	$ekstensifoto = strtolower(end($ekstensifoto));
	if (!in_array($ekstensifoto, $ekstensiValid)) {
		echo "<script>
				alert('wrong data!');
				</script>";
		return false;
	}

	//cek ukuran
	if ($ukuranFile > 5000000) {
		echo "<script>
				alert('file size error!');
				</script>";
		return false;
	}

	//ubah nama file
	$namaFileBaru = $namaInput['nama'];
	$namaFileBaru .= ' ktp';
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensifoto;

	//upload
	move_uploaded_file($tmpName, 'admin/dokumen/' . $namaFileBaru);

	return $namaFileBaru;
}

function upload2($namaInput){
	$namaFile = $_FILES['kk']['name'];
	$ukuranFile = $_FILES['kk']['size'];
	$error = $_FILES['kk']['error'];
	$tmpName = $_FILES['kk']['tmp_name'];

	//cek upload
	if ($error === 4) {
		echo "<script>
				alert('Upload data!');
				</script>";
		return false;
	}

	//cek tipe data
	$ekstensiValid = ['jpg','jpeg','png'];
	$ekstensifoto = explode('.', $namaFile);
	$ekstensifoto = strtolower(end($ekstensifoto));
	if (!in_array($ekstensifoto, $ekstensiValid)) {
		echo "<script>
				alert('wrong data!');
				</script>";
		return false;
	}

	//cek ukuran
	if ($ukuranFile > 5000000) {
		echo "<script>
				alert('file size error!');
				</script>";
		return false;
	}

	//ubah nama file
	$namaFileBaru = $namaInput['nama'];
	$namaFileBaru .= ' kk';
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensifoto;

	//upload
	move_uploaded_file($tmpName, 'admin/dokumen/' . $namaFileBaru);

	return $namaFileBaru;
}

function ubah($data) {
	global $conn;
	$id = $data["kun_id"];
	$noktp = htmlspecialchars($data["noktp"]);
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$nohp = htmlspecialchars($data["nohp"]);
	$email = htmlspecialchars($data["email"]);
	$deteni = htmlspecialchars($data["deteni"]);
    $negara = htmlspecialchars($data["negara"]);
    $tanggal_pengajuan = $data["tanggal_pengajuan"];
    $tanggal_berlaku = $data["tanggal_berlaku"];
    $ktp = $data["ktplama"];
    $kk = $data["kklama"];
    $keterangan = $data["keterangan"];
	$status = $data["status"];
    $kupon = kupon();


    $query = "UPDATE kunjungan SET
					noktp = '$noktp',
					nama = '$nama',
					alamat = '$alamat',
					nohp = '$nohp',
					email = '$email',
					deteni = '$deteni',
					negara = '$negara',
					tanggal_pengajuan = '$tanggal_pengajuan',
					tanggal_berlaku = '$tanggal_berlaku',
					ktp = '$ktp',
					kk = '$kk',
					keterangan = '$keterangan',
					status = '$status',
					kupon = '$kupon'
				WHERE kun_id = $id
				";
    mysqli_query($conn, $query);
	
    return mysqli_affected_rows($conn);

}

function kupon($length = 8) {
	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$ret = '';
	for($i = 0; $i < $length; ++$i) {
    $random = str_shuffle($chars);
    $ret .= $random[0];
	}
	return $ret;
}

function kunjung($pengunjung){
	global $conn;

	$tanggal = date("Y-m-d");
	$nama = $pengunjung["nama"];
	$deteni = $pengunjung["deteni"];
    $negara = $pengunjung["negara"];
    $kupon = $pengunjung["kupon"];
    $keterangan = $pengunjung["status"];


    $query = "INSERT INTO kunjung 
                VALUES
                ('', '$tanggal', '$nama','$deteni','$negara'
                ,'$kupon','$keterangan','Proses' )
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function arsip($kunjungan){
	global $conn;

	$id = $kunjungan["jung_id"];
	$tanggal = date("Y-m-d");
	$nama = $kunjungan["nama"];
	$deteni = $kunjungan["deteni"];
    $negara = $kunjungan["negara"];
    $kupon = $kunjungan["kupon"];
    $keterangan = $kunjungan["keterangan"];


    $query = "UPDATE kunjung SET
					tanggal = '$tanggal',
					nama = '$nama',
					deteni = '$deteni',
					negara = '$negara',
					kupon = '$kupon',
					keterangan = '$keterangan',
					status = 'Selesai'
				WHERE jung_id = $id
				";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

?>