<?php
	require ('../../koneksi.php');
	$ujian = $_POST['kode'];
	session_start();
	$user = $_SESSION['iduser'];
	$_SESSION['idujian'] = $ujian;
	
	$sql = "SELECT * FROM nilai WHERE kodeuser=$user AND kodeujian=$_SESSION[idujian]";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);

	$nilai = $hasil->num_rows;
	if ($nilai > 0)
	{	header("location:../../?kode=nilai");
	}
	else if (!empty($_SESSION['ujian']))
	{	header("location:../../?kode=uji&tes=1");
	}
	else if ($nilai == 0)
	{	$token = $_POST['token'];
		
		$sql1 = "SELECT * FROM setujian WHERE kodeujian='$_SESSION[idujian]' AND Token='$token'";
		$base = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);
		
		if ($base->num_rows > 0)
		{	$data = $base->fetch_row();
			$grupsoal = $data[2];
			$banyak = $data[5];
			$_SESSION['id'] = $grupsoal;
			
			$sql2 = "SELECT * FROM soal INNER JOIN grup ON grup.kodegrup=soal.kodegrup INNER JOIN setujian ON setujian.grupsoal=grup.kodegrup
					 WHERE soal.kodegrup=$grupsoal 
					 ORDER BY RAND() LIMIT $banyak ";
			$hsl = $mysqli->query($sql2) or die ("Error: ". $mysqli->error);
			$jumlah_soal = $banyak;
			
			for ($i=1; $i<=$jumlah_soal; $i++)
			{	$soal = $hsl->fetch_array();
				
				$sql3 = "INSERT INTO jawaban (kodeuser, kodeujian, kodesoal) VALUE ('$user', '$_SESSION[idujian]', '$soal[kodesoal]') ";
				$hsl3 = $mysqli->query($sql3) or die ("Error: ". $mysqli->error);
			}
			
			header("location:../../?kode=uji&tes=1");
		}
		else
		{	echo "<script>alert('Token Yang Kamu Masukkan Salah !!');window.history.go(-1);</script>";
		}
	}
	else
	{	echo "<script>alert('Kamu Tidak Boleh Mengakses Halaman Ini !!');window.history.go(-1);</script>";
	}
?>
