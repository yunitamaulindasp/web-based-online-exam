<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form class="forms-sample" name="formisi" id="formisi" >
        <h4 class="card-title"> Tambah User </h4>
        <p class="card-description"> Profil </p>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Name">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
          <div class="col-md-5">
            <div class="form-group">
              <div class="form-check-primary">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="gender" id="gender1" value="L" checked>
                  Laki-laki
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <div class="form-check-primary">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="gender" id="gender2" value="P">
                  Perempuan
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tempat Lahir</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="tempat" id="tempat" placeholder="Tempat Lahir">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
          <div class="col-sm-5">
            <input type="date" class="form-control" name="tgl" id="tgl" placeholder="dd/mm/yyyy"/>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <select class="form-control" name="status" id="status">
              <option value="admin">Admin</option>
              <option value="siswa">Siswa</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">File upload</label>
          <input type="file" name="foto" id="foto" class="file-upload-default">
          <div class="input-group col-sm-10">
            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
            <span class="input-group-append">
              <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
            </span>
          </div>
        </div>
        <p class="card-description"> Akun </p>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Username</label>
          <div class="col-sm-10">
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">@</div>
              </div>
              <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="text" class="form-control mb-2 mr-sm-2" name="password" id="password" placeholder="Password">
          </div>
        </div> 
        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{	$("#formisi").submit(function(e)
		{	e.preventDefault();
			var namafile = $("#foto").val().toLowerCase();
			if (namafile.length == 0)
			{	bootbox.alert({
					title: "Error",
					message: 'Tidak ada file yang diupload!'
				});
				return false;
			}
			var ext = namafile.substring(namafile.lastIndexOf('.')+1);
			var aExt = ['jpg','jpeg','gif','png'];
			if (aExt.indexOf(ext) == -1)
			{	bootbox.alert({
					title: "Error",
					message: namafile + ' bukan file image!'
				});
				return false;
			}
			var ukuran = $("#foto")[0].files[0].size;
			if (ukuran > 1048576)
			{	bootbox.alert({
					title: "Error",
					message: 'Ukuran file lebih dari 1 MB!'
				});
				return false;
			}
		
			var formdata = new FormData($('#formisi')[0]);
			$.ajax({
				url: "admin/user/simpanuser.php",
				type: "POST",
				data : formdata,
				enctype: "multipart/form-data",
				processData: false,
				contentType: false
			})
			.done(function(hasil){
				bootbox.alert({
					title: "Tambah Pengguna Berhasil",
					message: hasil,
					callback: function(result){
					window.location.href = "default.php?kode=tampiluser";
				}
				});
			})
			.fail(function(q, textStatus){
				alert(textStatus);
			})
		});
	});
</script>
