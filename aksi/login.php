<?php
    require("../inc/koneksi.php");
    @$username = $_POST['username'];
    @$password = $_POST['password'];
    @$_SESSION['login'] = false;

    $fromTable = $dbh->query("SELECT * FROM tbl_pelanggan");

    while ($data = $fromTable->fetch()){
        if ($username == $data['username'] & md5($password) == $data['password']){
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            header("location:../");
        }else{
            echo "fuck!";
        }
    }
?>