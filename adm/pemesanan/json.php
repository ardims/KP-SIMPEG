<?php
	require("../../inc/koneksi.php");
	error_reporting(0);
	$query = $dbh->query("SELECT * FROM tbl_pemesanan where no_pemesanan='$_POST[no_pemesanan]'");

	$data = $query->fetch();
	$pemesanan['no_pemesanan'] = $data['no_pemesanan'];
	$pemesanan['no_kamar'] = $data['no_kamar'];
	$pemesanan['no_pelanggan'] = $data['no_pelanggan'];
	$pemesanan['tgl_pemesanan'] = $data['tgl_pemesanan'];
	$pemesanan['lama'] = $data['lama'];
	$pemesanan['total_harga'] = $data['total_harga'];
	echo json_encode($pemesanan);
?>