<?php
	$server = "#";
	$user = "root";
	$password = "";
	$database = "ujian";
	// Buat koneksi
	$mysqli = new mysqli($server, $user, $password, $database);
	// Periksa koneksi
	if ($mysqli->connect_error)
	{ die("Koneksi gagal: " . $mysqli->connect_error);
	}
?>