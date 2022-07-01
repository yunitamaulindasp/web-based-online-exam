<?php
	require 'koneksi.php';
	$requestData = $_REQUEST;
	$sql = "SELECT count(*) FROM pengguna";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	if (empty($parameter))
	{	$sql = "SELECT Username, Nama, Status, JenisKelamin, Tempat, TanggalLahir ";
		$sql .= " FROM pengguna ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else
	{	$sql = "SELECT Username, Nama, Status, JenisKelamin, Tempat, TanggalLahir ";
		$sql .= " FROM pengguna ";
		$sql .= " WHERE Nama LIKE '%$parameter%' ";
		$sql .= " OR Username LIKE '%$parameter%' ";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$totalFilter = $hasil->num_rows;
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	
	$data = array();
	$counter = $start + 1;
	while ($row = $hasil->fetch_row())
	{	$nestedData = array();
		$nestedData[] = $counter;
		$nestedData[] = $row[0];
		$nestedData[] = $row[1];
		$nestedData[] = $row[2];
		if ($row[3] == 'L')
		{	$hsl = 'Laki-laki';
		}
		else
		{	$hsl = 'Perempuan';
		}
		$nestedData[] = $hsl;
		$arTgl = explode ('-', $row[5]);
		$nestedData[] = $row[4].', '. $arTgl[2].'-'.$arTgl[1].'-'.$arTgl[0];
		$nestedData[] = '<a href="?kode=edit&username='.$row[0].'"><button type="button" class="btn btn-outline-info btn-icon-text">Edit</button></a>
						         <a href="?kode=hapus&username='.$row[0].'"><button type="button" class="btn btn-outline-success btn-icon-text">Hapus</button></a>';
		$data[] = $nestedData;
		$counter++;
	}
	
	$jsonData = array(
		"draw" => intval($requestData['draw']),
		"recordsTotal" => intval($totalData),
		"recordsFiltered" => intval($totalFilter),
		"data" => $data
	);
	echo json_encode($jsonData);
?>
