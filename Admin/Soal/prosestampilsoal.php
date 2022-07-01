<?php
	require 'koneksi.php';
	session_start();
	$requestData = $_REQUEST;
  $sql = "SELECT count(*) FROM soal WHERE kodegrup='$_SESSION[idgrup]' ";
	$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	$data = $hasil->fetch_row();
	$totalData = $data[0];
	$totalFilter = $totalData;

  $parameter = $requestData['search']['value'];
	$start = $requestData['start'];
	$length = $requestData['length'];
  if (empty($parameter))
	{	$sql = "SELECT jenissoal, kodesoal, jawaban ";
		$sql .= " FROM soal WHERE kodegrup='$_SESSION[idgrup]' ";
		$sql .= " LIMIT $start, $length";
		$hasil = $mysqli->query($sql) or die ("Error: ". $mysqli->error);
	}
	else 
	{	$sql = "SELECT jenissoal, kodesoal, jawaban ";
		$sql .= " FROM soal WHERE kodegrup='$_SESSION[idgrup]' ";
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
		$nestedData[] = $row[2];
		$nestedData[] = '<a href="?kode=edit'.$row[0].'&soal='.$row[1].'">
                      <div class="template-demo d-flex justify-content-between flex-nowrap">
                        <button type="button" class="btn btn-inverse-primary btn-rounded btn-icon" title="edit">
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
