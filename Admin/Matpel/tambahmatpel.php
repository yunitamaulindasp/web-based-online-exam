<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Tambah Mata Pelajaran
	</h3>
</div>

<form class="forms-sample" name="tambahmatpel" id="tambahmatpel">
	<div class="row">	
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"> Tambah Mata Pelajaran </h4>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Mata Pelajaran">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun Ajaran">
						</div>
					</div>
				</div>
			</div>
		</div>
    <button type="submit" class="btn btn-primary col-12">Tambah Mata Pelajaran</button>
	</div>	
</form>

<script type="text/javascript">
	$(document).ready(function()
	{	$("#tambahmatpel").submit(function(e)
		{	e.preventDefault();
			$.ajax({
				url: "admin/matpel/prosestambahmatpel.php",
				type: "POST",
				data: $("#tambahmatpel").serialize()
			})
			.done(function(hasil){
				bootbox.alert({
					title: "Tambah Mata Pelajaran Berhasil",
					message: hasil,
					callback: function(result){
						window.location.href = "?kode=matpel";
					}
				});
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
