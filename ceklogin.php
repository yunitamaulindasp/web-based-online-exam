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
		$iduser = $data[0]; //ambil id user
		$status = $data[3]; //ambil status
		$nama = $data[4]; //ambil nama
		$foto = $data[8]; //ambil foto
		
		session_start(); //memulai session
		$_SESSION['nama'] = $nama; //menyimpan variabel session
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
