<?php
	session_start();
	$idsoal = $_POST['kode'];
	$soal = $_POST['soal'];
	$a = $_POST['pilihana'];
	$b = $_POST['pilihanb'];
	$c = $_POST['pilihanc'];
	$d = $_POST['pilihand'];
	$jawab = $_POST['jawaban'];
	$pembahasan = $_POST['pembahasan'];
	
	require '../../koneksi.php';
	$query = "UPDATE soal SET 
			  soal='$soal',
			  jawaban='$jawab',
			  pembahasan='$pembahasan',
			  piliha='$a',
			  pilihb='$b',
			  pilihc='$c',
			  pilihd='$d' 
			  WHERE kodesoal='$idsoal' ";
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
