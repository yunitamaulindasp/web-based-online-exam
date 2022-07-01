<?php
	include ('koneksi.php');
	session_start();
	if (!isset($_SESSION['nama']))
	{	echo "<script>window.location.replace('login.php')</script>";
		die();
	}
	$sql = "SELECT * FROM pengguna WHERE nama='$_SESSION[nama]'";
		$hasil = $mysqli->query($sql) or die("Error: ". $mysqli->error);
		$data = $hasil->fetch_row();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
		<title>Ujian Online</title>
    
		<link rel="stylesheet" href="Web/assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="Web/assets/vendors/css/vendor.bundle.base.css">
		<link href="Web/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="Web/datatables/dataTables.bootstrap4.min.css" />
		
		<link rel="stylesheet" href="Web/assets/css/style.css">
		
		<link rel="shortcut icon" href="Web/assets/images/favicon.png" />
		
		<script src="Web/js/vendor/jquery.min.js"></script>
		<script src="Web/bootstrap/js/bootstrap.bundle.min.js"> </script>
		<script src="web/bootbox/bootbox.min.js"></script>
		<script src="Web/datatables/jquery.dataTables.min.js"> </script>
		<script src="Web/datatables/dataTables.bootstrap4.min.js"> </script>
	</head>
	
	<body>
		<div class="container-scroller">
			<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
				<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
					<a class="navbar-brand brand-logo">
						<span> Ujian Online </span>
					</a>
				</div>
				<div class="navbar-menu-wrapper d-flex align-items-stretch">
					<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
						<span class="mdi mdi-menu"></span>
					</button>
					<ul class="navbar-nav navbar-nav-right">
						<li class="nav-item nav-profile dropdown">
							<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
								<div class="nav-profile-text">
									<p class="mb-1 text-black"><?php echo $_SESSION['nama']; ?></p>
								</div>
							</a>
							<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php">
									<i class="mdi mdi-logout mr-2 text-primary"></i>
									Signout
								</a>
							</div>
						</li>
					</ul>
					<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
						<span class="mdi mdi-menu"></span>
					</button>
				</div>
			</nav>
			<div class="container-fluid page-body-wrapper">
<?php
	if ($_SESSION['status'] == 'admin')
	{
?>
				<nav class="sidebar sidebar-offcanvas" id="sidebar">
					<ul class="nav">
						<li class="nav-item nav-profile">
							<a class="nav-link">
								<div class="nav-profile-image">
									<img src="admin/user/upload/<?php echo $data[8] ?>" alt="profile">
									<span class="login-status online"></span>
								</div>
								<div class="nav-profile-text d-flex flex-column">
									<span class="font-weight-bold mb-2"> <?php echo $_SESSION['nama']; ?> </span>
									<span class="text-secondary text-small">Admin </span>
								</div>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?kode=dashboard">
								<span class="menu-title">Dashboard</span>
								<i class="mdi mdi-home menu-icon"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
								<span class="menu-title">Pelajaran</span>
								<i class="menu-arrow"></i>
								<i class="mdi mdi-cloud-print menu-icon"></i>
							</a>
							<div class="collapse" id="ui-basic">
								<ul class="nav flex-column sub-menu">
									<li class="nav-item"> <a class="nav-link" href="?kode=matpel">Mata Pelajaran</a></li>
									<li class="nav-item"> <a class="nav-link" href="?kode=buatsoal">Buat Soal</a></li>
									<li class="nav-item"> <a class="nav-link" href="?kode=buatujian">Buat Ujian</a></li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?kode=tampilnilai">
								<span class="menu-title">Nilai</span>
								<i class="mdi mdi mdi-file-document menu-icon"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
								<span class="menu-title">Akun</span>
								<i class="menu-arrow"></i>
								<i class="mdi mdi-medical-bag menu-icon"></i>
							</a>
							<div class="collapse" id="general-pages">
								<ul class="nav flex-column sub-menu">
									<li class="nav-item"> <a class="nav-link" href="?kode=tambahuser">Tambah Pengguna</a></li>
									<li class="nav-item"> <a class="nav-link" href="?kode=tampiluser">Data Pengguna</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
       
				<div class="main-panel">
					<div class="content-wrapper">
					  <?php
					      if (isset($_GET['kode']))
					      {	$kode = $_GET['kode'];
					       if ($kode == 'dashboard')
						{	include('admin/homeadmin.php');
						}
						else if ($kode == 'matpel')
						{	include('admin/matpel/tampilmatpel.php');
						}
						else if ($kode == 'tambahmatpel')
						{	include('admin/matpel/tambahmatpel.php');
						}
						else if ($kode == 'non')
						{	include('admin/matpel/nonaktif.php');
						}
						else if ($kode == 'aktif')
						{	include('admin/matpel/aktifkan.php');
						}
						else if ($kode == 'buatsoal')
						{	include('admin/Soal/grupsoal.php');
						}
						else if ($kode == 'tambahgrup')
						{	include('admin/Soal/tambahgrupsoal.php');
						}
						else if ($kode == 'tambahsoal')
						{	include('admin/Soal/tambahsoal.php');
						}
						else if ($kode == 'pilgan')
						{	include('admin/Soal/pilgan.php');
						}
						else if ($kode == 'bensal')
						{	include('admin/Soal/bensal.php');
						}
						else if ($kode == 'editpilgan')
						{	include('admin/Soal/editpilgan.php');
						}
						else if ($kode == 'editbensal')
						{	include('admin/Soal/editbensal.php');
						}
						else if ($kode == 'buatujian')
						{	include('admin/ujian/ujian.php');
						}
						else if ($kode == 'tambahujian')
						{	include('admin/ujian/tambahujian.php');
						}
						else if ($kode == 'tampilnilai')
						{	include('admin/nilai/tampilnilai.php');
						}
						else if ($kode == 'dnilai')
						{	include('admin/nilai/detailnilai.php');
						}
						else if ($kode == 'tambahuser')
						{	include('admin/user/tambahuser.php');
						}
						else if ($kode == 'tampiluser')
						{	include('admin/user/tampilkanuser.php');
						}
						else if ($kode == 'edit')
						{	include('admin/user/edituser.php');
						}
						else if ($kode == 'hapus')
						{	include('admin/user/hapususer.php');
						}
					      }
					  ?>	
					</div>
				</div>
<?php
	}
	else
	{
?>			
				<nav class="sidebar sidebar-offcanvas" id="sidebar">
					<ul class="nav">
						<li class="nav-item nav-profile">
							<a class="nav-link">
								<div class="nav-profile-image">
									<img src="admin/user/upload/<?php echo $data[8] ?>" alt="profile">
									<span class="login-status online"></span>
								</div>
								<div class="nav-profile-text d-flex flex-column">
									<span class="font-weight-bold mb-2"><?php echo $_SESSION['nama']; ?></span>
									<span class="text-secondary text-small">Siswa</span>
								</div>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?kode=dashboard">
								<span class="menu-title">Dashboard</span>
								<i class="mdi mdi-home menu-icon"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?kode=daftar">
								<span class="menu-title">Daftar Ujian</span>
								<i class="mdi mdi-clipboard-text menu-icon"></i>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?kode=tampilanilai">
								<span class="menu-title">Nilai</span>
								<i class="mdi mdi-book menu-icon"></i>
							</a>
						</li>
					</ul>
				</nav>
       
				<div class="main-panel">
					<div class="content-wrapper">
						<?php
	 						if (isset($_GET['kode']))
						      	{	$kode = $_GET['kode'];
							if ($kode == 'dashboard')
							{	include('siswa/homesiswa.php');
							}
							else if ($kode == 'daftar')
							{	include('siswa/ujian/tampildaftarujian.php');
							}
							else if ($kode == 'uji')
							{	include('siswa/ujian/tampilujian.php');
							}
							else if ($kode == 'ujian')
							{	include('siswa/ujian/tampilujian.php');
							}
							else if ($kode == 'nilai')
							{	include('siswa/ujian/nilai.php');
							}
							else if ($kode == 'tampilanilai')
							{	include('siswa/nilai/tampilnilai.php');
							}
						      }
						?>
					</div>
				</div>
<?php
	}
?>
			</div>
		</div>
		
		<footer class="footer">
			<div class="d-sm-flex justify-content-center justify-content-sm-between">
				<span class="text-muted text-sm-left d-block d-sm-inline-block">
					Copyright © Tugas Besar Pemrograman Web 2020
				</span>
			</div>
		</footer>
		
		<script src="Web/assets/js/off-canvas.js"></script>
		<script src="Web/assets/js/hoverable-collapse.js"></script>
		<script src="Web/jquery/jquery-easing/jquery.easing.min.js"></script>
		<script src="Web/assets/js/todolist.js"></script>
		<script src="Web/assets/js/file-upload.js"></script>
		<script src="Web/bootstrap/js/bootstrap.min.js"> </script>
		<script src="Web/bootbox/bootbox.min.js"> </script>
	</body>
</html>
