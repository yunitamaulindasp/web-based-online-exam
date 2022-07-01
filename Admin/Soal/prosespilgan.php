<?php
	session_start();
	$grup = $_SESSION['idgrup'];
	$soal = $_POST['soal'];
	$a = $_POST['pilihana'];
	$b = $_POST['pilihanb'];
	$c = $_POST['pilihanc'];
	$d = $_POST['pilihand'];
	$jawab = $_POST['jawaban'];
	$pembahasan = $_POST['pembahasan'];
	
	require("koneksi.php");
	$query = "INSERT INTO soal (kodegrup, jenissoal, soal, jawaban, pembahasan, piliha, pilihb, pilihc, pilihd) VALUES ('$grup', 'pilgan', '$soal', '$jawab', '$pembahasan', '$a', '$b', '$c', '$d');";
	$hasil = $mysqli->query($query);
	if (!$hasil)
	{	echo "Eror: " . $mysqli->error;
	}
	else
	{	echo "<script>alert('proses tambah berhasil');</script>";
        header('location:../../?kode=tambahsoal&grupsoal='.$_SESSION['idgrup']);
	}
	$mysqli->close();
?>
