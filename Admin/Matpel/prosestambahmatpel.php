<?php
	$nama = $_POST['nama'];
	$tahun = $_POST['tahun'];
	
	require '../../koneksi.php';
	
	$query = "INSERT INTO matapelajaran (matpel, tahunajaran, aktif) VALUES ('$nama', '$tahun', 'Y')";
	$hasil = $mysqli->query($query);
	if (!$hasil)
	{	echo "Eror: " . $mysqli->error;
	}
	else
	{	echo "<table width='100%' border='0'>";
		echo "<tr><td>Mata Pelajaran:</td><td>$nama</td></tr>";
		echo "<tr><td>Tahun Ajaran:</td><td>$tahun</td></tr>";
		echo "</table>";
	}
	$mysqli->close();
?>
