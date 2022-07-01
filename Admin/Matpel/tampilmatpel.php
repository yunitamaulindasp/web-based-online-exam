<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Mata Pelajaran 
	</h3>
</div>

<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Mata Pelajaran</h4>
				<a href="?kode=tambahmatpel">
					<button type="button" class="btn btn-outline-primary mr-2">
						Tambah Mata Pelajaran
					</button>
				</a>
				<table id="tblmatpel" class="table table-hover">
					<thead>
						<tr>
							<th> No </th>
							<th> Kode Mata Pelajaran </th>
							<th> Mata Pelajaran </th>
							<th> Tahun Ajaran </th>
							<th> Status </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var dataTable = $('#tblmatpel').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "admin/matpel/prosestampilmatpel.php",
				type: "POST",
				error: function(){
					$(".lookup-error").html("");
					$("#tblmatpel").append('<tbody class="employee-grid-error"> <tr> <th colspan="6"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
		});
	});
</script>
