<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-danger text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Group Soal 
	</h3>
</div>

<div class="row">
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
        <a href="?kode=tambahgrup">
					<button type="button" class="btn btn-outline-danger mr-2">
						Tambah Grup Soal
					</button>
				</a>
        <div>
          <table id="tblgrup" class="table table-hover">
            <thead>
              <tr>
                <th> No </th>
                <th> Kode Grup Soal </th>
                <th> Grup Soal </th>
                <th> Mata Pelajaran </th>
                <th> Action</th>
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
				url: "admin/soal/prosestampilgrup.php",
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
