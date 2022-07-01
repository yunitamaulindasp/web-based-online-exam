<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-danger text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Tambah Grup Soal 
	</h3>
</div>

<form class="forms-sample" name="tambahgrup" id="tambahgrup">
	<div class="row">	
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
          				<h4 class="card-title"> Tambah Grup Soal </h4>
          				<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Grup Soal</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Grup Soal">
						</div>
					</div>
          				<div class="form-group row">
            					<label class="col-sm-2 col-form-label">Mata Pelajaran</label>
            					<div class="col-sm-10">
							<select class="form-control" name="pelajaran" id="pelajaran">
								<?php
									$sql= "SELECT kodematpel, matpel FROM matapelajaran WHERE aktif='Y'";
									$hasil= $mysqli->query($sql) or die("Error: ". $mysli->error);
									While ($arData = $hasil->fetch_array())
									{
								?>
								<option value="<?php echo $arData['kodematpel']; ?>"><?php echo '<td>'.$arData['matpel']. '</td>'; ?></option>
								<?php 
									}
								?>
							</select>
            					</div>
          				</div>
        			</div>
			</div>
		</div>
    		<button type="submit" class="btn btn-danger col-12">Tambah Grup Soal</button>
	</div>	
</form>

<script type="text/javascript">
	$(document).ready(function()
	{	$("#tambahgrup").submit(function(e)
		{	e.preventDefault();
			$.ajax({
				url: "admin/soal/prosesgrup.php",
				type: "POST",
				data: $("#tambahgrup").serialize()
			})
			.done(function(hasil){
				bootbox.alert({
					title: "Tambah Grup Soal Berhasil",
					message: hasil,
					callback: function(result){
						window.location.href = "?kode=buatsoal";
					}
				});
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
