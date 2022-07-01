<?php
	require ('../../koneksi.php');
	session_start();
	$iduser = $_SESSION['iduser']; 
	$idgrup = $_SESSION['id'];
	$idujian = $_SESSION['idujian'];

	$sql = "SELECT * FROM jawaban INNER JOIN soal ON jawaban.kodesoal=soal.kodesoal
			WHERE jawaban.kodeuser=$iduser AND jawaban.kodeujian='$idujian' AND jawaban.jawab=soal.jawaban ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$jumlah_benar = $hasil->num_rows;
	
	$sql1 = "SELECT * FROM setujian WHERE kodeujian='$idujian'";
	$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
	$row = $hasil1->fetch_row();
	$soal = $row[5];

	$nilai = $jumlah_benar*100/$soal;
	
	$sql2 = "INSERT INTO nilai (kodeuser, kodeujian, nilai, tanggal) VALUE ('$iduser', '$idujian', '$nilai', now()) ";
	$hasil2 = $mysqli->query($sql2) or die ("Error: ". $mysqli->error);

	unset($_SESSION['ujian']);
	unset($_SESSION['mulai']);
	header("location:../../?kode=nilai");
?>
