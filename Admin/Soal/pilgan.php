<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-info text-white mr-2">
			<i class="mdi mdi-code-equal"></i>
		</span> 
		Tambah Soal Pilihan Ganda 
	</h3>
</div>

<div class="row">
	<form class="forms-sample" name="tambah" id="tambah" action="admin/soal/prosespilgan.php" method="POST">
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					 <h4 class="card-title">Soal</h4>
					<textarea id="soal" name="soal" class="ckeditor"></textarea>
				</div>
			</div>
		</div>
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan a</h4>
					<textarea id="pilihana" name="pilihana"  class="ckeditor"></textarea>
				</div>
			</div>
		</div>
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan b</h4>
					<textarea id="pilihanb" name="pilihanb"  class="ckeditor"></textarea>
				</div>
			</div>
		</div>
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan c</h4>
					<textarea id="pilihanc" name="pilihanc"  class="ckeditor"></textarea>
				</div>
			</div>
		</div>
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pilihan d</h4>
					<textarea id="pilihand" name="pilihand"  class="ckeditor"></textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<h3 class="page-title"> Pilihan Benar </h3>
			<select class="form-control form-control" name="jawaban" id="jawaban">
				<option value="a">Pilihan A</option>
				<option value="b">Pilihan B</option>
				<option value="c">Pilihan C</option>
				<option value="d">Pilihan D</option>
			</select>
		</div>
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Pembahasan</h4>
					<textarea id="pembahasan" name="pembahasan" class="ckeditor"></textarea>
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
