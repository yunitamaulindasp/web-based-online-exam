<?php
	require '../../koneksi.php';
	$requestData = $_REQUEST;
  	$sql = "SELECT count(*) FROM grup";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;

	$parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
  	if (empty($parameter))
	{	$sql = "SELECT kodegrup, nama, matpel ";
		$sql .= " FROM grup ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else
	{	$sql = "SELECT kodegrup, nama, matpel ";
		$sql .= " FROM grup ";
		$sql .= " WHERE nama LIKE '%$parameter%' ";
		$sql .= " OR matpel LIKE '%$parameter%' ";
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
		
		$add = "SELECT matpel FROM matapelajaran WHERE kodematpel=$row[2]";
		$hsl = $mysqli->query($add);
		$arData = $hsl->fetch_array();
		$nestedData[] = $arData['matpel'];
		
		$nestedData[] = '<a href="?kode=tambahsoal&grupsoal='.$row[0].'">
                      <div class="template-demo d-flex justify-content-between flex-nowrap">
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon">
                          <i class="mdi mdi-pen"></i>
                        </button>
                      </div>
                     </a>';
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
