<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Daftar Ujian 
	</h3>
</div>

<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				
				<h4 class="card-title">Daftar Ujian</h4>
				
				<table id="tblujian" class="table table-hover">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Ujian</th>
							<th class="text-center">Mata Pelajaran</th>
							<th class="text-center">Waktu</th>
							<th class="text-center">Jumlah Soal</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
<?php
	$sql = "SELECT * FROM setujian INNER JOIN grup ON setujian.Grupsoal=grup.kodegrup INNER JOIN matapelajaran ON matapelajaran.kodematpel=grup.matpel ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);

	$no =  1;
	while ($tampil = $hasil->fetch_array())
	{	
?>
						<tr>
							<td class="text-center"><?php echo $no++; ?></td>  
							<td class="text-center"><?php echo $tampil['Nama'];?></td>
							<td class="text-center"><?php echo $tampil['matpel']; ?></td>
							<td class="text-center"><?php echo $tampil['Waktu'].' menit';?></td>
							<td class="text-center"><?php echo $tampil['Banyaksoal']; ?> Soal</td>
							<td class="text-center">
								<a onclick="$('#modal-user-settings<?php echo $tampil['kodeujian']; ?>').modal('show');">
									<div class="template-demo d-flex justify-content-between flex-nowrap">
										<button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" title="masuk">
											<i class="mdi mdi-pen"></i>
										</button>
									</div>
								</a>
							</td>
						</tr>
						<div class="modal fade" id="modal-user-settings<?php echo $tampil['kodeujian']; ?>" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="card">
										<div class="card-body">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
											<h4 class="card-title"></i>Masukan Token Soal</h3>
											<div class="modal-body">
												<form action="Siswa/Ujian/cektoken.php" method="POST" >
													<input type="hidden" name="kode" id="kode" value="<?php echo $tampil['kodeujian']; ?>">
													<div class="form-group">
														<label>Token Soal</label>
														<input class="form-control" id="token" name="token" placeholder="Masukkan Token Ujian Kamu">
													</div>
													<button type="submit" class="btn btn-primary col-12">Mulai Ujian!</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
<?php 
	} 
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
