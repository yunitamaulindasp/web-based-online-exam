<?php
	$nama = $_POST['nama'];
	$gender = $_POST['gender'];
	$tempat = $_POST['tempat'];
	$tgl = $_POST['tgl'];
	$status = $_POST['status'];
	$username = $_POST['username'];
		
	$atgl = explode('-', $tgl);
	$tgl_lahir = "$atgl[2]-$atgl[1]-$atgl[0]";
	
	require '../../koneksi.php';
	
	$fotoLama = $_POST['fotolama'];
	$fotoBaru = $_FILES['fotobaru'];
	$pesan = array(1=>'Ukuran file terlalu besar', 2=>'Ukuran file terlalu besar', 3=>'Proses upload gagal', 4=>'Tidak ada file yang diunggah', 6=>'Folder temporer tidak ada', 7=>'Gagal menulis ke disk');
	if ($fotoBaru["error"] == 4)
	{	$query = "UPDATE pengguna SET status='$status', nama='$nama', tempat='$tempat', tanggallahir='$tgl_lahir', jeniskelamin='$gender' WHERE username='$username'";
		$namaFile = $fotoLama;
	}
	else if ($fotoBaru["error"] == 0)
	{	if (($fotoLama != '') && file_exists("upload/$fotoLama"))
		{	unlink("upload/$fotoLama");
		}
		$ext = pathinfo($fotoBaru['name'], PATHINFO_EXTENSION);
		$namaFile = "$username.$ext";
		$hasil = move_uploaded_file($fotoBaru["tmp_name"], "upload/$namaFile");
		if (!$hasil)
		{	die("Error: Gagal Upload $namaFile ke Server");
		}
		$query = "UPDATE pengguna SET status='$status', nama='$nama', tempat='$tempat', tanggallahir='$tgl_lahir', jeniskelamin='$gender', Foto='$namaFile' WHERE username='$username'";
	}
	else
	{	die("Error: ".$pesan[$fotoBaru["error"]]);
	}
	
	$hasil = $mysqli->query($query);
	if (!$hasil)
	{ echo "Error: " . $mysqli->error;
	}
	else if ($mysqli->affected_rows == 0)
	{	echo "Data tidak berubah";
	}
	else
	{	echo "<table width='100%' border='0'>";
		echo "<tr><td>Nama:</td><td>$nama</td></tr>";
		echo "<tr><td>Jenis Kelamin:</td><td>$gender</td></tr>";
		echo "<tr><td>Tempat Lahir:</td><td>$tempat</td></tr>";
		echo "<tr><td>Tanggal Lahir:</td><td>$tgl_lahir</td></tr>";
		echo "<tr><td>Status:</td><td>$status</td></tr>";
		echo "<tr><td>Username:</td><td>$username</td></tr>";
		echo "<tr><td>Foto:</td><td><img src='admin/user/upload/$namaFile' class='img-thumbnail' /></td></tr>";
		echo "</table>";
	}
	$mysqli->close();
?>
