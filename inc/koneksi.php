<?php
    try{
        //koneksi ke database
        $dbh = new PDO('mysql:host=localhost;dbname=dbsimpeg',"root","");

        //set error mode
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //hapus koneksi
        //$dbh = null;
    } catch(PDOException $e){
        //jika koneksi gagal
        print "Koneksi ke database tidak berhasil: ".$e->getMessage()."<br>";
        die();
    }
?>