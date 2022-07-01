<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-info text-white mr-2">
			<i class="mdi mdi-code-equal"></i>
		</span> 
		Tambah Soal Pilihan Ganda 
	</h3>
</div>

<div class="row">
	<form class="forms-sample" name="tambah" id="tambah" action="admin/soal/proseseditpilgan.php" method="POST">
<?php
	$soal = $_GET['soal'];
	$sql = "SELECT * FROM soal WHERE kodesoal=$soal ";
	$hasil = $mysqli->query($sql) or die ("Error :". $mysqli->error);
	$data = $hasil->fetch_array();
?>
		<input type="hidden" name="kode" id="kode" value="<?php echo $soal; ?>">
		<div class="col-12 grid-margin stretch-card">
      <div class="card">
				<div class="card-body">
					 <h4 class="card-title">Soal</h4>
					<textarea id="soal" name="soal" class="ckeditor">
						<?php echo $data['soal']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan a</h4>
					<textarea id="pilihana" name="pilihana"  class="ckeditor">
						<?php echo $data['piliha']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan b</h4>
					<textarea id="pilihanb" name="pilihanb"  class="ckeditor">
						<?php echo $data['pilihb']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan c</h4>
					<textarea id="pilihanc" name="pilihanc"  class="ckeditor">
						<?php echo $data['pilihc']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan d</h4>
					<textarea id="pilihand" name="pilihand"  class="ckeditor">
						<?php echo $data['pilihd']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <div class="form-group">
			<h3 class="page-title"> Pilihan Benar </h3>
			<select class="form-control form-control" name="jawaban" id="jawaban">
				<option <?php if($data['jawaban']=='a'){echo "selected"; } ?> value="a">Pilihan A</option>
				<option <?php if($data['jawaban']=='b'){echo "selected"; } ?> value="b">Pilihan B</option>
				<option <?php if($data['jawaban']=='c'){echo "selected"; } ?> value="c">Pilihan C</option>
				<option <?php if($data['jawaban']=='d'){echo "selected"; } ?> value="d">Pilihan D</option>
			</select>
		</div>
    <div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pembahasan</h4>
					<textarea id="pembahasan" name="pembahasan" class="ckeditor">
						<?php echo $data['pembahasan']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <button type="submit" class="btn btn-gradient-info btn-icon-text col-12">
			<i class="mdi mdi-file-check btn-icon-prepend"></i>
			Edit Soal
		</button>
    </form>
</div>
<script src="Web/js/helpers/ckeditor/ckeditor.js"></script>
