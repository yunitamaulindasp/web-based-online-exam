<?php
	$nama = $_POST['nama'];
	$grup = $_POST['grup'];
	$token = $_POST['token'];
	$waktu = $_POST['waktu'];
	$banyak = $_POST['banyaksoal'];
	
	require '../../koneksi.php';
	$query = "INSERT INTO setujian (Nama, Grupsoal, Token, Waktu, Banyaksoal) VALUES ('$nama', '$grup', '$token', '$waktu', '$banyak')";
	$hasil = $mysqli->query($query);	
	
	if (!$hasil)
	{	echo "Eror: " . $mysqli->error;
	}
	else
	{
		echo "<table width='100%' border='0'>";
		echo "<tr><td>Ujian:</td><td>$nama</td></tr>";
		echo "<tr><td>Token:</td><td>$token</td></tr>";
		echo "<tr><td>Waktu Pengerjaan Ujian:</td><td>$waktu menit</td></tr>";
		echo "</table>";
	}
	$mysqli->close();
?>
