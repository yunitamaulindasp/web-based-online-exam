<?php
	session_start();
	$idsoal = $_POST['kode'];
	$soal = $_POST['soal'];
	$jawab = $_POST['jawaban'];
	$pembahasan = $_POST['pembahasan'];
	
	require '../../koneksi.php';
	$query = "UPDATE soal SET 
            soal='$soal',
            jawaban='$jawab',
            pembahasan='$pembahasan'
            WHERE kodesoal='$idsoal' ";
	$hasil = $mysqli->query($query);
	if (!$hasil)
	{	echo "Eror: " . $mysqli->error;
	}
	else
	{	echo "<script>alert('proses edit berhasil');</script>";
        header('location:../../?kode=tambahsoal&grupsoal='.$_SESSION['idgrup']);
	}
	$mysqli->close();
?>
