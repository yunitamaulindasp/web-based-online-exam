	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Data Pengguna</h4>
				<p class="card-description">
					Admin dan Siswa
				</p>
				<table id="tbluser" class="table table-striped">
					<thead>
						<tr>
							<th> No </th>
							<th> Username </th>
							<th> Nama </th>
							<th> Status </th>
							<th> Jenis Kelamin </th>
							<th> Tempat, Tanggal Lahir </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
		var dataTable = $('#tbluser').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "admin/user/prosestampiluser.php",
				type: "POST",
				error: function(){
					$(".lookup-error").html("");
					$("#tbluser").append('<tbody class="employee-grid-error"> <tr> <th colspan="7"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
		});
	});
</script>
