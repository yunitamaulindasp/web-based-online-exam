<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-info text-white mr-2">
			<i class="mdi mdi-code-equal"></i>
		</span> 
		Tambah Soal Benar-Salah 
	</h3>
</div>

<div class="row">
	<form class="forms-sample" name="tambah" id="tambah" action="admin/soal/proseseditbensal.php" method="POST" >
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
					<textarea id="soal" name="soal"  class="ckeditor">
						<?php echo $data['soal']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <div class="form-group">
			<h3 class="page-title"> Jawaban </h3>
			<select class="form-control form-control" name="jawaban" id="jawaban">
				<option <?php if($data['jawaban']=='benar'){echo "checked"; } ?> value="benar">Benar</option>
				<option <?php if($data['jawaban']=='salah'){echo "checked"; } ?> value="salah">Salah</option>
			</select>
		</div>
    <div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pembahasan</h4>
					<textarea id="pembahasan" rows="2" name="pembahasan"  class="ckeditor">
						<?php echo $data['pembahasan']; ?>
					</textarea>
				</div>
			</div>
		</div>
    <button type="submit" class="btn btn-gradient-info btn-icon-text col-12">
			<i class="mdi mdi-file-check btn-icon-prepend"></i>
			Tambah Soal
		</button>
    </form>
</div>
<script src="Web/js/helpers/ckeditor/ckeditor.js"></script>
