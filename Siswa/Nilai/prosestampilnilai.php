<?php
	require ('../../koneksi.php');
	session_start();
	$requestData = $_REQUEST;
	$iduser = $_SESSION['iduser'];
	
	$sql = "SELECT count(*) FROM nilai INNER JOIN setujian ON nilai.kodeujian=setujian.kodeujian 
			INNER JOIN grup ON setujian.Grupsoal=grup.kodegrup INNER JOIN matapelajaran ON grup.matpel=matapelajaran.kodematpel
			WHERE nilai.kodeuser=$iduser";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	
	if (empty($parameter))
	{	$sql = "SELECT * FROM nilai INNER JOIN setujian ON nilai.kodeujian=setujian.kodeujian 
				INNER JOIN grup ON setujian.Grupsoal=grup.kodegrup INNER JOIN matapelajaran ON grup.matpel=matapelajaran.kodematpel
				WHERE nilai.kodeuser=$iduser ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else 	
	{	$sql = "SELECT * FROM nilai INNER JOIN setujian ON nilai.kodeujian=setujian.kodeujian 
				INNER JOIN grup ON setujian.Grupsoal=grup.kodegrup INNER JOIN matapelajaran ON grup.matpel=matapelajaran.kodematpel
				WHERE nilai.kodeuser=$iduser ";
		$sql .= " AND matapelajaran.matpel LIKE '%$parameter%' ";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
		$totalFilter = $hasil->num_rows;
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	
	$data = array(); 
	$counter = $start + 1;
	while ($row = $hasil->fetch_array())
	{	$nestedData = array();
		$nestedData[] = $counter;
		$nestedData[] = $row['Nama'];
		$nestedData[] = $row['matpel'];
		
		$arTgl = explode ('-', $row['tanggal']);
		$nestedData[] =  $arTgl[2].'-'.$arTgl[1].'-'.$arTgl[0];
		
		$nestedData[] = $row['nilai'];
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
