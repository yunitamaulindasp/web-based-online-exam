<?php
	$kode = $_GET['matpel'];
	require 'koneksi.php';
  $sql = "SELECT * FROM matapelajaran WHERE kodematpel='$kode'";
	$hasil = $mysqli->query($sql) or die("Error: " . $mysqli->error);
	if ($hasil->num_rows == 0)
	{	die("Mata pelajaran tidak ditemukan!");
	}
  $sql = "UPDATE matapelajaran SET aktif='T' WHERE kodematpel='$kode' ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	if ($mysqli->affected_rows > 0)
	{	echo "<script> alert('Mata pelajaran berhasil dinonaktifkan.');
		window.location.href = '?kode=matpel'</script>";
	}
	else
	{	echo "<script> alert('Mata pelajaran tidak berhasil dinonaktifkan!');
		window.location.href = '?kode=matpel'</script>";
	}
	$mysqli->close();
?>
