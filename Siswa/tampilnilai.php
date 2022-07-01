<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Nilai Siswa 
	</h3>
</div>

<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div>
				<table id="tblnilai" class="table table-secondary">
					<thead>
						<tr>
							<th> No </th>
							<th> Ujian </th>
							<th> Mata Pelajaran </th>
							<th> Jumlah Peserta </th>
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
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var dataTable = $('#tblnilai').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "prosestampilnilai.php",
				type: "POST",
				error: function(){
					$(".lookup-error").html("");
					$("#tblnilai").append('<tbody class="employee-grid-error"> <tr> <th colspan="5"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
		});
	});
</script>
