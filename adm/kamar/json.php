<?php
	require("../../inc/koneksi.php");
	error_reporting(0);
	$query = $dbh->query("SELECT * FROM tbl_kamar where no_kamar='$_POST[no_kamar]'");
	
	$data = $query->fetch();
    $kamar['no_kamar'] = $data['no_kamar'];
	$kamar['tipe'] = $data['tipe'];
    $kamar['status'] = $data['status'];
	echo json_encode($kamar);
?>