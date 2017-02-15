<?php
    header("location:../");
?>
<?php
    require("../../inc/koneksi.php");
    @$tambah = $_GET['tambah'];
    @$hapus = $_GET['hapus'];
    @$edit = $_GET['edit'];
    @$id = $_GET['nip'];
    @$nip = $_POST['nip'];
    @$nama = $_POST['nama'];
    @$id_status_peg = $_POST['idStatusPegawai'];
    @$id_satker = $_POST['idSatker'];
    @$id_agama = $_POST['idAgama'];
    @$tmp_lahir = $_POST['tmpLahir'];
    @$tgl_lahir = $_POST['tglLahir'];
    @$alamat = $_POST['alamat'];
    @$jenkel = $_POST['jenkel'];
    @$status_nikah = $_POST['statusNikah'];
    @$gol_darah = $_POST['golDarah'];
    @$tinggi = $_POST['tinggi'];
    @$berat = $_POST['berat'];
    @$foto = $_POST['URLFoto'];
    @$password = md5($_POST['password']);
    @$kamar = $_GET['kamar'];
    @$do = $_GET['do'];
    @$uploadFile = $_FILES['file'];
    @$gambar = $_GET['url'];

    //tambah data
    if ($tambah != ""){
        if ($tambah == "pegawai"){
            $dbh->query("insert into tbl_pegawai values('', '$nip', '$nama','$id_status_peg', '$id_satker', '$id_agama', '$tmp_lahir', '$tgl_lahir', '$alamat', '$jenkel', '$status_nikah', '$gol_darah', '$tinggi', '$berat', '')");
            header("location:../pelanggan");
        } else {
            header("location:./");
        }
    }

    //hapus data
    if ($hapus != ""){
        if ($hapus == "pegawai"){
            $dbh->query("delete from tbl_pegawai where nip='$id'");
            header("location:../pelanggan");
        } else {
            header("location:../");
        }
    }

    //edit data
    if ($edit != ""){
        if ($edit == "pegawai"){
            $dbh->query("update tbl_tipe set nama = '$nama', id_status_pegawai = '$id_status_peg', id_satker = '$id_satker', id_agama = '$id_agama', tmp_lahir = '$tmp_lahir', tgl_lahir = '$tgl_lahir', alamat = '$alamat',jenkel = '$jenkel', status_nikah = '$status_nikah', gol_darah = '$gol_darah', tinggi = '$tinggi', berat = '$berat', foto = '$foto'  where nip='$nip'");
            header("location:../pelanggan");
        }else {
            header("location:../");
        }
    }

    //upload file
    if ($do != ""){
        if ($do == "upload"){
            $uploadDir = "/img/kamar/";
            $ext = substr($uploadFile['name'],strlen($uploadFile['name'])-4,4);
            $query = $dbh->query("select count(*) from tbl_galeri where no_kamar='$noKamar'");
            $data = $query->fetch();
            $url = $uploadDir.$noKamar."-".($data[0]+1).$ext;
            $dbh->query("insert into tbl_galeri values('','$noKamar','$url')");
            move_uploaded_file($uploadFile['tmp_name'],"../../".$url);
            header("location:../galeri");
        }
    }
?>