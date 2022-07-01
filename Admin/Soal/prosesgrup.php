<?php
	$nama = $_POST['nama'];
	$matpel = $_POST['pelajaran'];
	
	require '../../koneksi.php';
	$query = "INSERT INTO grup (nama, matpel) VALUES ('$nama', '$matpel')";
	$hasil = $mysqli->query($query);
	if (!$hasil)
	{	echo "Eror: " . $mysqli->error;
	}
	else
	{	$add = "SELECT matpel FROM matapelajaran WHERE kodematpel=$matpel";
		$hsl = $mysqli->query($add);
		$arData = $hsl->fetch_array();
		$mapel = $arData['matpel'];
		echo "<table width='100%' border='0'>";
		echo "<tr><td>Grup Soal:</td><td>$nama</td></tr>";
		echo "<tr><td>Mata Pelajaran:</td><td>$mapel</td></tr>";
		echo "</table>";
	}
	$mysqli->close();
?>
