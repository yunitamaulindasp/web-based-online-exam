<?php
	$server = "#";
	$user = "root";
	$password = "";
	$database = "ujian";
	$mysqli = new mysqli($server, $user, $password, $database);
	if ($mysqli->connect_error)
	{ die("Koneksi gagal: " . $mysqli->connect_error);
	}
?>
