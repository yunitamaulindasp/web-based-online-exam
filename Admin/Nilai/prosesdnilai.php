<?php
	require 'koneksi.php';
	
	session_start();
	$requestData = $_REQUEST;
	$sql = "SELECT count(*) FROM nilai WHERE kodeujian='$_SESSION[kd]' ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	
  	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
  	if (empty($parameter))
	{	$sql = "SELECT kodeujian, kodeuser, nilai, tanggal ";
		$sql .= " FROM nilai WHERE kodeujian='$_SESSION[kd]' ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else	
	{	$sql = "SELECT kodeujian, kodeuser, nilai, tanggal ";
		$sql .= " FROM nilai WHERE kodeujian='$_SESSION[kd]' ";
		$sql .= " WHERE kodeuser LIKE '%$parameter%' ";
		$sql .= " OR kodeujian LIKE '%$parameter%' ";
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
		
		$add = "SELECT * FROM pengguna INNER JOIN nilai ON pengguna.iduser=nilai.kodeuser WHERE nilai.kodeujian='$_SESSION[kd]' AND pengguna.iduser='$row[1]' ";
		$hsl = $mysqli->query($add);
		$arData = $hsl->fetch_array();
		$nestedData[] = $arData['nama'];
		
		$nestedData[] = $row[2];
		$arTgl = explode ('-', $row[3]);
		$nestedData[] = $arTgl[2].'-'.$arTgl[1].'-'.$arTgl[0];
		
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
