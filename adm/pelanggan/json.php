<?php
	require("../../inc/koneksi.php");
	error_reporting(0);
		$query = $dbh->query("SELECT * FROM tbl_pegawai where nip='$_POST[nip]'");
	
	$data = $query->fetch();
    $pegawai['nip'] = $data['nip'];
	$pegawai['nama'] = $data['nama'];
    $pegawai['status_pegawai'] = $data['id_status_pegawai'];
    $pegawai['satker'] = $data['id_satker'];
	$pegawai['agama'] = $data['id_agama'];
	$pegawai['tempat_lahir'] = $data['tmp_lahir'];
	$pegawai['tanggal_lahir'] = $data['tgl_lahir'];
	$pegawai['alamat'] = $data['alamat'];
	$pegawai['jeniskelamin'] = $data['jenkel'];
	$pegawai['statusnikah'] = $data['status_nikah'];
	$pegawai['golongandarah'] = $data['gol_darah'];
	$pegawai['tinggi'] = $data['tinggi'];
	$pegawai['berat'] = $data['berat'];
	$pegawai['foto'] = $data['foto'];
	echo json_encode($pegawai);
?>