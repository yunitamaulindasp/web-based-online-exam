<?php
	session_start();
	$grup = $_SESSION['idgrup'];
	$soal = $_POST['soal'];
	$jawab = $_POST['jawaban'];
	$pembahasan = $_POST['pembahasan'];
	
	require("koneksi.php");
	$query = "INSERT INTO soal (kodegrup, jenissoal, soal, jawaban, pembahasan) VALUES ('$grup', 'bensal', '$soal', '$jawab', '$pembahasan') ";
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
