<?php
	if (!isset($_POST["username"]) || !isset($_POST["password"]))
	{	die("");
	}
	$username = $_POST["username"];
	$pass = md5($_POST["password"]);
	
	require("koneksi.php");
	$query = "SELECT * FROM pengguna WHERE username='$username' AND password='$pass'";
	$hasil = $mysqli->query($query) or die ("Error: ". $mysqli->error);
	if ($hasil->num_rows > 0)
	{	$data = $hasil->fetch_row();
		$iduser = $data[0];
		$status = $data[3];
		$nama = $data[4];
		$foto = $data[8];
		
		session_start();
		$_SESSION['nama'] = $nama;
		$_SESSION['iduser'] = $iduser;
		$_SESSION['status'] = $status;
		$_SESSION['foto'] = $foto;
		echo $nama;

	}
	else
	{	echo '';
	}
	$mysqli->close();
?>
