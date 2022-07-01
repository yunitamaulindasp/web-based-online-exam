<?php 
	require ('koneksi.php');
	$id = $_SESSION['id'];
	$_SESSION['ujian'] = true;
?>

<div class="page-header">
	<h3 class="page-title">
		<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-book-plus"></i>
		</span> 
		Ujian
	</h3>
</div>

<?php
	if(isset($_SESSION['mulai']))
	{	$telah_berlalu = time() - $_SESSION['mulai'];
	}
	else
	{	$_SESSION['mulai'] = time();
		$telah_berlalu = 0;
	}

	$sql = "SELECT * FROM setujian WHERE kodeujian=".$_SESSION['idujian'];
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_array();

	$temp_waktu = ($data[4]*60)-$telah_berlalu;
	$temp_menit = (int)($temp_waktu/60);

	$temp_detik = $temp_waktu%60;

	if ($temp_menit < 60)
	{	$jam    = 0; 
		$menit  = $temp_menit; 
		$detik  = $temp_detik; 
	}
	else
	{	$jam    = (int)($temp_menit/60); 
		$menit  = $temp_menit%60;
		$detik  = $temp_detik;
	} 
?>

<?php 
	$tes = 1;

	$page = (isset($_GET['tes'])) ? $_GET['tes'] : 1;

	$mulai = ($page > 1) ? ($page * $tes) - $tes : 0;

	if(($page < 1) && (empty($page)))
	{	$page = 1;
	}

	$sql1 = "SELECT * FROM jawaban INNER JOIN soal ON jawaban.kodesoal=soal.kodesoal
			 WHERE jawaban.kodeuser='$_SESSION[iduser]' AND jawaban.kodeujian='$_SESSION[idujian]' ";
	$hasil1 = $mysqli->query($sql1) or die ("Error: ". $mysqli->error);

	$jumlah_data = $hasil1->num_rows;

	$jumlah_halaman = ceil($jumlah_data/$tes);

	$no = $mulai + 1;
	
	$sql2 = "SELECT * FROM jawaban INNER JOIN soal ON jawaban.kodesoal=soal.kodesoal
			 WHERE jawaban.kodeuser='$_SESSION[iduser]' AND jawaban.kodeujian='$_SESSION[idujian]' LIMIT ".$mulai." , ".$tes;

	$hasil2 = $mysqli->query($sql2) or die ("Error: ". $mysqli->error);
	
	while ($data2 = $hasil2->fetch_array())
	{	
?>
<div class="col-lg-12 grid-margin stretch-card">
	Siswa Waktu
	<div id='timer'>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<form action="Siswa/Ujian/prosesnilai.php" id="frmSoal" method="POST">
				</form>
	
				<h4 class="card-title">Soal ke <?php echo $no++; ?> dari <?php echo $jumlah_halaman?></h4>

				<form action="Siswa/Ujian/proseseditjawaban.php" method="POST">
					<input type="hidden" name="idjawab" value="<?php echo $data2['kodejawab']; ?>">
					<input type="hidden" name="soal" value="<?php echo $no; ?>">
					<input type="hidden" name="page" value="<?php echo $page; ?>">
					<input type="hidden" name="halaman" value="<?php echo $jumlah_halaman; ?>">
		

<?php
		if($data2['jenissoal']=='pilgan')
		{
?>

					<table>
						<tr>
							<td colspan="2"><p><?php echo $data2['soal']; ?></p></td>
						</tr>
						<tr>
							<td valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"MS Mincho"'>
										<input id="piliha" name="pilihan" <?php if($data2['jawab'] == "a"){echo "checked"; }?> value="a" type="radio">
									</span>
								</p>
							</td> 

							<td valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"Times New Roman","serif"'>
										<?php echo $data2['piliha'];?>
									</span>
								</p>
							</td>
						</tr>
						<tr>
							<td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"MS Mincho"'>
										<input id="pilihb" name="pilihan" <?php if($data2['jawab'] == "b"){echo "checked"; }?> value="b" type="radio">
									</span>
								</p>
							</td>   
            
							<td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"Times New Roman","serif"'>
										<?php echo $data2['pilihb'];?>
									</span>
								</p>
							</td>
						</tr>
						<tr>
							<td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"MS Mincho"'>
										<input id="pilihc" name="pilihan" <?php if($data2['jawab'] == "c"){echo "checked"; }?> value="c" type="radio">
									</span>
								</p>
							</td>   
            
							<td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"Times New Roman","serif"'>
										<?php echo $data2['pilihc'];?>
									</span>
								</p>
							</td>
						</tr>
						<tr>
							<td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"MS Mincho"'>
										<input id="pilihd" name="pilihan" <?php if($data2['jawab'] == "d"){echo "checked"; }?> value="d" type="radio">
									</span>
								</p>
							</td>   
            
							<td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"Times New Roman","serif"'>
										<?php echo $data2['pilihd'];?>
									</span>
								</p>
							</td> 
						</tr>
					</table>
					<br>
					<br>
		
<?php
		}
		else if($data2['jenissoal']=='bensal')
		{
?>

					<table cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="2"><p><?php echo $data2['soal']; ?></p></td>
						</tr>
						<tr>
							<td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"MS Mincho"'>
										<input id="pilihanb" name="pilihan" <?php if($data2['jawab'] == "benar"){echo "checked"; }?> value="benar" type="radio">
									</span>
								</p>
							</td>   
            
							<td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span>Benar</span>
								</p>
							</td>
						</tr>
						<tr>
							<td width=36 valign=top style='width:27.15pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span style='font-family:"MS Mincho"'>
										<input id="pilihans" name="pilihan" <?php if($data2['jawab'] == "salah"){echo "checked"; }?> value="salah" type="radio">
									</span>
								</p>
							</td>   
            
							<td width=554 valign=top style='width:415.25pt;padding:0cm 5.4pt 0cm 5.4pt'>
								<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:150%'>
									<span>Salah</span>
								</p>
							</td>
						</tr>
					</table>
					<br>
					<br>
		
<?php
		}
?>
					<button type="submit" name="submit" class="btn btn-info" id="btn-test">Jawab</button> 
            
<?php
	}
	if($jumlah_halaman == $page)
	{
?>

					<a onclick="$('#modal-user-settingsx').modal('show');" title="Selesai" class="btn btn-success">Selesai</a>
				</form>
				<div class="modal fade" id="modal-user-settingsx" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="card">
								<div class="card-body">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
									<h4 class="card-title"></i>Rekap Soal Ujian Online</h3>
									<div class="modal-body">
										<form action="Siswa/Ujian/prosesnilai.php" method="POST">
											<input type="hidden" name="iduser" value="<?php echo $_SESSION['iduser']; ?>">
											<input type="hidden" name="idgroup" value="<?php echo $_SESSION['id']; ?>">
											<input type="hidden" name="idujian" value="<?php echo $_SESSION['idujian']; ?>">
											<table class="table table-bordered">
												<tr>
													<td>No</td>
													<td>Jawaban</td>
													<td>Edit</td>
												</tr>
<?php 
		$no = 1;
		$x = 1;
	
		$sql3 = "SELECT * FROM jawaban INNER JOIN soal ON jawaban.kodesoal=soal.kodesoal
				 WHERE jawaban.kodeujian='$_SESSION[idujian]' AND jawaban.kodeuser='$_SESSION[iduser]' ";
		$hasil3 = $mysqli->query($sql3) or die ("Error: ". $mysqli->error);

		while ($jawaban = $hasil3->fetch_array())
		{
?>
												<tr>
													<td><?php echo $no++; ?></td>
													<td><?php echo $jawaban['jawab']; ?></td>
													<td>
														<a href="http://localhost/Tugas%20Besar/default.php?kode=uji&tes=<?php echo $no-$x; ?>">
															Edit Jawaban
														<a>
													</td>
												</tr>
												
<?php
		}
?>

												<tr>
												</tr>
											</table>
											<button type="submit" name="selesai" class="btn btn-primary col-12">Selesai</button>
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

				<br>
                		<ul class="pagination">
<?php
	if($page == 1)
	{
?>
					<li class="disabled">
						<a href="#">FIRST</a>
					</li>
					<li class="disabled">
						<a href="#">
							<i class="fa fa-angle-left"></i>
						</a>
					</li> 

<?php
	}
	else if($page > 1)
	{	$link_prev = ($page > 1)? $page - 1 : 1;
?>
                    			<li>
						<a href="default.php?kode=uji&tes=1">FIRST</a>
					</li>
                    			<li>
						<a href="default.php?kode=uji&tes=<?php echo $link_prev; ?>">
							<i class="fa fa-angle-left"></i>
						</a>
					</li> 
					
<?php
	}
	$sql4 = "SELECT COUNT(*) FROM soal WHERE kodegrup='$id' ";
	$hasil4 = $mysqli->query($sql4) or die ("Error: ". $mysqli->error);
	$get_jumlah = $hasil4->fetch_row();

	$jumlah_number = 2;
	$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
	$end_number = ($page < ($jumlah_halaman - $jumlah_number))? $page + $jumlah_number : $jumlah_halaman;
	for($i = $start_number; $i <= $end_number; $i++)
	{	$link_active = ($page == $i)? ' class="active"' : '';
?>
					<li <?php echo $link_active; ?>>
						<a href="default.php?kode=uji&tes=<?php echo $i; ?>">
							<?php echo $i; ?>
						</a>
					</li>
<?php
	}
	if($page == $jumlah_halaman)
	{
?>

					<li class="disabled">
						<a href="#">
							<i class="fa fa-angle-right"></i>
						</a>
					</li>
					<li class="disabled">
						<a href="#">LAST</a>
					</li>
					
<?php
	}
	else
	{	$link_next = ($page < $jumlah_halaman)? $page + 1 : $jumlah_halaman;
?>
					<li>
						<a href="default.php?kode=uji&tes=<?php echo $link_next; ?>">
							<i class="fa fa-angle-right"></i>
						</a>
					</li>
					<li>
						<a href="default.php?kode=uji&tes=<?php echo $jumlah_halaman; ?>">LAST</a>
					</li>

<?php
	}
?>

				</ul>
            		</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var detik   = <?= $detik; ?>;
		var menit   = <?= $menit; ?>;
		var jam     = <?= $jam; ?>;
                
		function hitung() {
			setTimeout(hitung,1000);

			if(menit < 10 && jam == 0){
				var peringatan = 'style="color:red"';
			};

			$('#timer').html(
				jam + ':' + menit + ':' + detik
			);

			detik --;

			if(detik < 0) {
				detik = 59;
				menit --;

				if(menit < 0) {
					menit = 59;
					jam --;

					if(jam < 0) { 
						clearInterval(hitung); 
						var $frmSoal = document.getElementById("frmSoal"); 
							alert('Waktu Anda telah habis');

								window.location.href = "../../prosesnilai.php"; 

					} 
				} 
			} 
		}           
		hitung();
	});
</script>
