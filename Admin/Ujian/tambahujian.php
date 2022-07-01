<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-dark text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Tambah Ujian 
	</h3>
</div>

<form class="forms-sample" name="tambahujian" id="tambahujian">
	<div class="row">	
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"> Tambah Ujian </h4>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama Ujian</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Ujian">
						</div>
					</div>
					<div class="form-group row">
            					<label class="col-sm-2 col-form-label">Kode Grup</label>
            					<div class="col-sm-10">
              						<select class="form-control" name="grup" id="grup">
								<?php
									$sql= "SELECT kodegrup, nama, matpel FROM grup";
									$hasil= $mysqli->query($sql) or die("Error: ". $mysli->error);
									While ($arData = $hasil->fetch_array())
									{
								?>
								<option value="<?php echo $arData['kodegrup']; ?>">
								<?php 
									$add = "SELECT matpel FROM matapelajaran WHERE kodematpel=".$arData['matpel'];
									$hsl = $mysqli->query($add);
									$data = $hsl->fetch_array();
									echo '<td>'.$arData['nama'].', '.$data['matpel']. '</td>';
								?>
								</option>
								<?php 
									}
								?>
              						</select>
            					</div>
          				</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Token</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="token" id="token" placeholder="Token Ujian">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Batas Waktu Ujian</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="waktu" id="waktu" placeholder="Waktu Pengerjaan Soal">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Banyak Soal Ujian</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="banyaksoal" id="banyaksoal" placeholder="Banyak Soal Ujian">
						</div>
					</div>
					<button type="submit" class="btn btn-dark col-12">SET UJIAN</button>
				</div>
			</div>
		</div>
	</div>	
</form>

<script type="text/javascript">
	$(document).ready(function()
	{	$("#tambahujian").submit(function(e)
		{	e.preventDefault();
			$.ajax({
				url: "admin/ujian/prosestambahujian.php",
				type: "POST",
				data: $("#tambahujian").serialize()
			})
			.done(function(hasil){
				bootbox.alert({
					title: "Tambah Ujian Berhasil",
					message: hasil,
					callback: function(result){
						window.location.href = "?kode=buatujian";
					}
				});
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
