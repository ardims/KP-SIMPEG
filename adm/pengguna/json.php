<?php
	require("../../inc/koneksi.php");
	error_reporting(0);
	$query = $dbh->query("SELECT * FROM tbl_pengguna where username='$_POST[username]'");
	
	$data = $query->fetch();
    $pengguna['username'] = $data['username'];
	$pengguna['password'] = $data['password'];
	echo json_encode($pengguna);
?>