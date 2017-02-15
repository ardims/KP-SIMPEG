<?php
	require("../../inc/koneksi.php");
	error_reporting(0);
	$query = $dbh->query("SELECT * FROM tbl_galeri where id_galeri='$_POST[id_galeri]'");
	
	$data = $query->fetch();
    $kamar['id_galeri'] = $data['id_galeri'];
	$kamar['no_kamar'] = $data['no_kamar'];
    $kamar['url_gambar'] = $data['url_gambar'];
	echo json_encode($kamar);
?>