<?php
	$iduser = $_GET['username'];
	$sql = "SELECT * FROM pengguna WHERE Username='$iduser'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	if ($hasil->num_rows == 0)
	{	die("Username $iduser tidak ditemukan!");
	}
	$arData = $hasil->fetch_row();
	$namaFile = $arData[8];
	if (file_exists("upload/$namaFile"))
	{	unlink("upload/$namaFile");
	}
	$sql = "DELETE FROM pengguna WHERE Username='$iduser'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	if ($mysqli->affected_rows > 0)
	{	echo "<script> alert('Username $iduser berhasil dihapus');
		window.location.href = '?kode=tampiluser'</script>";
	}
	else
	{	echo "<script> alert('Username $iduser gagal dihapus');
		window.location.href = '?kode=tampiluser'</script>";
	}
	$mysqli->close();
?>
