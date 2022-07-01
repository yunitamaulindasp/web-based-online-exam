<?php
	$nama = $_POST['nama'];
	$gender = $_POST['gender'];
	$tempat = $_POST['tempat'];
	$tgl = $_POST['tgl'];
	$status = $_POST['status'];
	$username = $_POST['username'];
	$passw = $_POST['password'];
	$pass = md5($passw);
		
	$atgl = explode('-', $tgl);
	$tgl_lahir = "$atgl[2]-$atgl[1]-$atgl[0]";
	
	require("koneksi.php");
	
	$foto = $_FILES['foto'];
	$pesan = array(1=>'Ukuran file terlalu besar', 2=>'Ukuran file terlalu besar', 3=>'Proses upload gagal', 4=>'Tidak ada file yang diunggah', 6=>'Folder temporer tidak ada', 7=>'Gagal menulis ke disk');
	if ($foto["error"] > 0)
	{	die("Error: ".$pesan[$foto["error"]]);
	}
	$ext = pathinfo($foto['name'], PATHINFO_EXTENSION);
	$fileBaru = "$username.$ext";
	$hasil = move_uploaded_file($foto["tmp_name"], "upload/$fileBaru");
	if (!$hasil)
	{	die("Error: Gagal Upload $fileBaru ke Server");
	}
	
	$query = "INSERT INTO pengguna (Nama, JenisKelamin, Tempat, TanggalLahir, Status, Username, Password, Foto)
			VALUES ('$nama', '$gender', '$tempat', '$tgl', '$status', '$username', '$pass', '$fileBaru')";
	$hasil = $mysqli->query($query);
	if (!$hasil)
	{	echo "Eror: " . $mysqli->error;
	}
	else
	{	echo "<table width='100%' border='0'>";
		echo "<tr><td>Nama:</td><td>$nama</td></tr>";
		echo "<tr><td>Jenis Kelamin:</td><td>$gender</td></tr>";
		echo "<tr><td>Tempat Lahir:</td><td>$tempat</td></tr>";
		echo "<tr><td>Tanggal Lahir:</td><td>$tgl_lahir</td></tr>";
		echo "<tr><td>Status:</td><td>$status</td></tr>";
		echo "<tr><td>Username:</td><td>$username</td></tr>";
		echo "<tr><td>Password:</td><td>$passw</td></tr>";
		echo "<tr><td>Foto:</td><td><img src='admin/user/upload/$fileBaru' class='img-thumbnail'/></td></tr>";
		echo "</table>";
	}
	$mysqli->close();
?>
