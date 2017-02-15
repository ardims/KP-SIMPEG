<?php
    require("../../inc/koneksi.php");
	error_reporting(0);
    $query = $dbh->query("SELECT * FROM tbl_kamar inner join tbl_tipe on tbl_kamar.tipe=tbl_tipe.tipe where tbl_kamar.no_kamar='$_POST[no_kamar]'");
	
    $data = $query->fetch();
    $kamar['no_kamar'] = $data['no_kamar'];
    $kamar['harga'] = $data['harga'];
    echo json_encode($kamar);
?>