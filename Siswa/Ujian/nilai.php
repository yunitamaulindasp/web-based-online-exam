<?php
	$iduser = $_SESSION['iduser'];
	$idujian = $_SESSION['idujian'];
	$sql = "SELECT * FROM nilai WHERE kodeuser='$iduser' AND kodeujian='$idujian' ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_array();
?>

<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">				
				<center>
					<font size="6">Hasil Ujian Online Anda</font>
					<h1 style="font-size:175px;"><b><?php echo $data['nilai']; ?></b></h1>
				</center>
			</div>
		</div>
	</div>
</div>
