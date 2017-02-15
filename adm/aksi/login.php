<?php
    header("location:../");
?>
<?php
    require("../../inc/koneksi.php");
    @$username = $_POST['username'];
    @$password = $_POST['password'];
    @$_SESSION['login'] = false;

    //$fromTable = $dbh->query("SELECT * FROM tbl_pegawai");

    //while ($data = $fromTable->fetch()){
        if ($username == "admin" & $password == "admin"){
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            header("location:../pelanggan");
        }
    //}
    if ($_SESSION['login'] == false){
        header("location:../");
    }
?>