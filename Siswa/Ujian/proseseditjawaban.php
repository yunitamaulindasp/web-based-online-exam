<?php
	require ('koneksi.php');
	
	$pilih = $_POST['pilihan'];
	$idjawab = $_POST['idjawab'];
	$halaman = $_POST['halaman'];
	$page = $_POST['page'];
	$no = $_POST['soal'];

	$sql = "UPDATE jawaban SET jawab='$pilih' WHERE kodejawab='$idjawab' ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);

	if($halaman == $page)
	{	header('location:../../?kode=uji&tes='.$page);
	}
	else
	{	header('location:../../?kode=uji&tes='.$no);
	}
?>
