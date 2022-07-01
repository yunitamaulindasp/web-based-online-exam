<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-secondary text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Ujian 
	</h3>
</div>

<div class="row">
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
        <a href="?kode=tambahujian">
					<button type="button" class="btn btn-secondary">
						Tambah Ujian
					</button>
				</a>
        <div>
          <table id="tblgrup" class="table table-secondary">
            <thead>
              <tr>
                <th> No </th>
                <th> Kode Ujian </th>
                <th> Nama Ujian </th>
                <th> Mata Pelajaran </th>
                <th> Token Soal </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var dataTable = $('#tblgrup').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "admin/ujian/prosestampilujian.php",
				type: "POST",
				error: function(){ 
					$(".lookup-error").html("");
					$("#tblgrup").append('<tbody class="employee-grid-error"> <tr> <th colspan="6"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
		});
	});
</script>
