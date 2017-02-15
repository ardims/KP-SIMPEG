<?php
    header("location:../");
?>
<?php
    require("../../inc/koneksi.php");
    @$tambah = $_GET['tambah'];
    @$hapus = $_GET['hapus'];
    @$edit = $_GET['edit'];
    @$id = $_GET['id'];
    @$tipe = $_POST['tipe'];
    @$fasilitas = "$_POST[fasilitas1],$_POST[fasilitas2],$_POST[fasilitas3],$_POST[fasilitas4],$_POST[fasilitas5]";
    @$harga = $_POST['harga'];
    @$noKamar = $_POST['no_kamar'];
    @$status = $_POST['status'];
    @$noPelanggan = $_POST['no_pelanggan'];
    @$namaPelanggan = $_POST['nama_pelanggan'];
    @$alamatPelanggan = $_POST['alamat_pelanggan'];
    @$telpPelanggan = $_POST['telp_pelanggan'];
    @$noPemesanan = $_POST['no_pemesanan'];
    @$tglPemesanan = $_POST['tgl_pemesanan'];
    @$lama = $_POST['lama'];
    @$totalHarga = $_POST['total_harga'];
    @$username = $_POST['username'];
    @$password = md5($_POST['password']);
    @$kamar = $_GET['kamar'];
    @$do = $_GET['do'];
    @$uploadFile = $_FILES['file'];
    @$gambar = $_GET['url'];

    //tambah data
    if ($tambah != ""){
        if ($tambah == "pelanggan"){
            $dbh->query("insert into tbl_pelanggan values('$noPelanggan','$namaPelanggan','$alamatPelanggan','$telpPelanggan','$username','$password')");
            header("location: kamar.php");
        } elseif ($tambah == "pemesanan"){
            $date = date_create("$tglPemesanan");
            date_add($date,date_interval_create_from_date_string("$lama days"));
            $checkout = date_format($date,"Y-m-d");
            $date = date("Y-m-d");
            if ($date >= $checkout){
                $status = "Selesai";
            } else {
                $status = "Belum Selesai";
            }
            $dbh->query("insert into tbl_pemesanan values('$noPemesanan','$noKamar','$noPelanggan','$tglPemesanan','$lama','$checkout','$status','$totalHarga')");
            $dbh->query("update tbl_kamar set status = 'Terisi' where no_kamar='$noKamar'");
            header("location:../pemesanan");
        } elseif($tambah == "pengguna"){
            $dbh->query("insert into tbl_pengguna values('$username','$password')");
            header("location:../pengguna");
        } else {
            header("location:./");
        }
    }

    //edit data
    if ($edit != ""){
        if ($edit == "tipe"){
            $dbh->query("update tbl_tipe set fasilitas='$fasilitas', harga='$harga' where tipe='$id'");
            header("location:../tipe-kamar");
        } elseif ($edit == "kamar"){
            $dbh->query("update tbl_kamar set no_kamar='$noKamar', tipe='$tipe', status='$status' where no_kamar='$id'");
            header("location:../kamar");
        } elseif ($edit == "pelanggan"){
            $dbh->query("update tbl_pelanggan set nama_pelanggan='$namaPelanggan', alamat_pelanggan='$alamatPelanggan', telp_pelanggan='$telpPelanggan', username='$username', password='$password' where no_pelanggan='$id'");
            header("location:../pelanggan");
        } elseif ($edit == "pemesanan"){
            $dbh->query("update tbl_pemesanan set no_kamar='$noKamar', no_pelanggan='$noPelanggan', tgl_pemesanan='$tglPemesanan', lama='$lama', total_harga='$totalHarga' where no_pemesanan='$id'");
            $dbh->query("update tbl_kamar set status = 'Terisi' where no_kamar='$noKamar'");
            $dbh->query("update tbl_kamar set status = 'Kosong' where no_kamar='$kamar'");
            header("location:../pemesanan");
        } elseif ($edit == "pengguna"){
            $dbh->query("update tbl_pengguna set username='$username', password='$password' where username='$id'");
            header("location:../pengguna");
        } elseif ($edit == "gambar"){
            move_uploaded_file($uploadFile['tmp_name'],"../../".$gambar);
            header("location:../galeri");
        } else {
            header("location:../");
        }
    }

?>