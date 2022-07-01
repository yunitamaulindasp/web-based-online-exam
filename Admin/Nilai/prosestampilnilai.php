<?php
	require '../../koneksi.php';
	
	$requestData = $_REQUEST;
	$sql = "SELECT count(*) FROM setujian";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	
	if (empty($parameter))
	{	$sql = "SELECT Kodeujian, Nama, Grupsoal, Token ";
		$sql .= " FROM setujian ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else 
	{	$sql = "SELECT Kodeujian, Nama, Grupsoal, Token ";
		$sql .= " FROM setujian ";
		$sql .= " WHERE Nama LIKE '%$parameter%' ";
		$sql .= " OR Kodeujian LIKE '%$parameter%' ";
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
		$nestedData[] = $row[1];
		
		$add = "SELECT * FROM grup WHERE kodegrup=$row[2]";
		$hsl = $mysqli->query($add);
		$arData = $hsl->fetch_array();
		$idmat = $arData['matpel'];
		
		$add1 = "SELECT * FROM matapelajaran WHERE kodematpel=$idmat";
		$hsl1 = $mysqli->query($add1);
		$arData1 = $hsl1->fetch_array();
		
		$nestedData[] = $arData1['matpel'];

		$nestedData[] = '<a href="?kode=dnilai&ujian='.$row[0].'"><button type="button" class="btn btn-outline-info btn-icon-text">Lihat</button></a>';
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
