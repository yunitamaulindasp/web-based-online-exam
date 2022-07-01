<?php
	$_SESSION['idgrup'] = $_GET['grupsoal'];
?>
<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
          <h4 class="card-title"> Soal Kode <?php echo $_SESSION['idgrup']; ?></h4>
          <div class="template-demo">
						<div class="btn-group" role="group" aria-label="Basic example">
							<a href="?kode=pilgan&grupsoal=<?php echo $_SESSION['idgrup']; ?>">
								<button type="button" class="btn btn-outline-danger">
									Pilihan Ganda
								</button>
							</a>
							<a href="?kode=bensal&grupsoal=<?php echo $_SESSION['idgrup']; ?>">
								<button type="button" class="btn btn-outline-danger">
									Benar Salah
								</button>
							</a>
						</div>
					</div>
          <table id="tblsoal" class="table table-danger">						
						<thead>
							<tr>
								<th> No </th>
								<th> Jenis Soal </th>
								<th> Kode Soal </th>
								<th> Jawaban Benar </th>
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
<script type="text/javascript">
	$(document).ready(function(){
		var dataTable = $('#tblsoal').DataTable( {
			"processing": true,
			"serverSide": true,
			"bSort": false,
			"ajax": {
				url: "admin/soal/prosestampilsoal.php",
				type: "POST",
				error: function(){
					$(".lookup-error").html("");
					$("#tblsoal").append('<tbody class="employee-grid-error"> <tr> <th colspan="5"> Data Tidak Ditemukan </th> </tr> </tbody>');
					$("#lookup_processing").css("display", "none");
				}
			}
		});
	});
</script>
