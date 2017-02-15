<?php
	require("../../inc/koneksi.php");
	error_reporting(0);
	$query = $dbh->query("SELECT * FROM tbl_tipe where tipe='$_POST[tipe]'");
	
	$data = $query->fetch();
    $tipe['tipe'] = $data['tipe'];
	$tipe['fasilitas'] = $data['fasilitas'];
    $tipe['harga'] = $data['harga'];
	echo json_encode($tipe);
?>