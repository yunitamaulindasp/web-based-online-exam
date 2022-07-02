<?php
	if (!isset ($_GET['username']))
	{	die("<script>alert('Tentukan dulu data yang akan diubah!');
		window.location.href = '?kode=tampiluser'</script>");
	}
	
	$iduser = $_GET['username'];
	$sql = "SELECT * FROM pengguna WHERE username='$iduser'";
	$hasil = $mysqli->query($sql) or die("Error: ". $mysqli->error);
	if ($hasil->num_rows == 0)
	{	die("Username $iduser tidak ditemukan!");
	}
	$data = $hasil->fetch_row();
	$aTgl = explode('-', $data[7]);
	$tgl_lahir = "$aTgl[2]-$aTgl[1]-$aTgl[0]";
	$mysqli->close();
?>
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form class="forms-sample" name="formedit" id="formedit" >
					<h4 class="card-title"> Edit User </h4>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Username</label>
						<div class="col-sm-10"> 
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text">@</div>
								</div>
								<input type="text" class="form-control" name="username" id="username" value="<?php echo $data[1] ?>" readonly>
							</div>
						</div>
					</div>
					<p class="card-description"> Profil </p>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama</label>
            					<div class="col-sm-10">
							<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data[4] ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
						<div class="col-md-5">
							<div class="form-group">
								<div class="form-check-primary">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="gender" id="gender1" value="L" <?php echo ($data[5] == "L" ? "checked" : "") ?>>
										Laki-laki
									</label>
								</div>
              						</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">						
								<div class="form-check-primary">
									<label class="form-check-label">
										<input type="radio" class="form-check-input" name="gender" id="gender2" value="P" <?php echo ($data[5] == "P" ? "checked" : "") ?>>
										Perempuan
									</label>							
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Tempat Lahir</label>
            					<div class="col-sm-10">
							<input type="text" class="form-control" name="tempat" id="tempat" value="<?php echo $data[6] ?>" >
						</div>
					</div>
					<div class="form-group row">
                        			<label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        			<div class="col-sm-5">
                            				<input type="date" class="form-control" name="tgl" id="tgl" value="<?php echo $data[7] ?>"/>
                        			</div>
                    			</div>
                    			<div class="form-group row">
                        			<label class="col-sm-2 col-form-label">Status</label>
                        			<div class="col-sm-10">
							<select class="form-control" name="status" id="status">
								<option value="admin" <?php echo ($data[3] == "admin" ? "selected" : "") ?>>Admin</option>
								<option value="siswa" <?php echo ($data[3] == "siswa" ? "selected" : "") ?>>Siswa</option>
							</select>
                        			</div>
                    			</div>
                    			<div class="form-group row">
						<label class="col-sm-2 col-form-label">Foto Lama</label>
						<div class="col-sm-10">
							<img src='admin/user/upload/<?php echo $data[8] ?>' class="img-thumbnail">
							<input type="hidden" name="fotolama" id="fotolama" value="<?php echo $data[7] ?>" />
                        			</div>
                    			</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Foto Baru</label>
						<div class="col-sm-10">
							<input type="file" class="form-control-file" name="fotobaru" id="fotobaru">
							<p class="card-description">File yang bisa diunggah hanya bertipe {jpg, jpeg, png, gif}, dengan ukuran maksimum 1MB.</p>
                        			</div>
                    			</div>
					<button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    			<button class="btn btn-light">Cancel</button>
				</form>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function()
	{	$("#formedit").submit(function(e){
		e.preventDefault();
		var namafile = $("#fotobaru").val().toLowerCase();
		if (namafile != '' )
		{	var ext = namafile.substring(namafile.lastIndexOf('.')+1);
			var aExt = ['jpg','jpeg','gif','png'];
			if (aExt.indexOf(ext) == -1) 
			{	bootbox.alert({
					title: "Error",
					message: namafile + ' bukan file image!'
				});
				return false;
			}
			var ukuran = $("#fotobaru")[0].files[0].size;
			if (ukuran > 1048576)
			{	bootbox.alert({
					title: "Error",
					message: 'Ukuran file lebih dari 1 MB!'
				});
				return false;
			}
		}
		
			var formdata = new FormData($('#formedit')[0]);
			$.ajax({
				url: "admin/user/simpanedituser.php",
				type: "POST",
				data : formdata,
				enctype: "multipart/form-data",
				processData: false,
				contentType: false
			})
			.done(function(hasil){
				bootbox.alert({
					title: "Edit Pengguna Berhasil",
					message: hasil,
					callback: function(result){
					window.location.href = "?kode=tampiluser";
				}
				});
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
