<?php
	require '../../koneksi.php';
	$requestData = $_REQUEST;
	$sql = "SELECT count(*) FROM matapelajaran";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;
	
	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
	if (empty($parameter))
	{	$sql = "SELECT kodematpel, matpel, tahunajaran, aktif ";
		$sql .= " FROM matapelajaran ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else
	{	$sql = "SELECT kodematpel, matpel, tahunajaran, aktif ";
		$sql .= " FROM matapelajaran ";
		$sql .= " WHERE matpel LIKE '%$parameter%' ";
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
		if ($row[3] == 'Y')
		{	$hsl= 'Aktif';
			$nestedData[] = $hsl;
			$nestedData[] = '<a href="?kode=non&matpel='.$row[0].'"><button type="button" class="btn btn-outline-primary btn-icon-text">Non Aktif</button></a>';
		}
		else
		{	$hsl= 'Tidak Aktif';
			$nestedData[] = $hsl;
			$nestedData[] = '<a href="?kode=aktif&matpel='.$row[0].'"><button type="button" class="btn btn-outline-primary btn-icon-text">Aktif</button></a>';
		}
		
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
