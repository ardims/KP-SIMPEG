<?php
    session_start();
    if (@$_SESSION['login'] != true){
        header("location:../");
    }
?>
<?php
    //koneksi database
    require("../../inc/koneksi.php");
      //laporan
    include("../../inc/laporan.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Pengguna</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

        <!-- jquery -->
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                //Edit Data
                $(".edit").click(function(){
                    var username=$(this).attr('data-id');
                    $("#formEdit").attr('action',$(this).attr('data-href'));
                    $.ajax({
                        type:"POST",
                        data:"username="+username,
                        url :"json.php",
                        dataType:"json",
                        success:function(data){
                            $("#username").val(data.username);
                            $("#password").val(data.password);
                        }
                    });
                });
                
                //Confirm Delete
                $('.hapus').click(function(){
                    $('.btn-ok').attr('href',$(this).attr('data-href'));
                    $('#record').html("Pengguna dengan username '"+$(this).attr("id")+"' akan dihapus.<br>Pengguna tersebut tidak akan dapat login kembali.");
                });
            });
        </script>
    </head>
    <body>
        <!-- container dari bootstrap -->
        <div class="container">

        <!-- header -->
            <div class="row">
                <div class="col-md-12 page-header">
                    <h1>Halaman Admin Tri Star Hotel</h1>
                </div>
            </div>

        <!-- navigasi -->
            <div class="row">
                <div class="col-md-10">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="../tipe-kamar"><span class="glyphicon glyphicon-bed"></span> Data Tipe Kamar</a></li>
                        <li role="presentation"><a href="../kamar"><span class="glyphicon glyphicon-lamp"></span> Data Kamar</a></li>
                        <li role="presentation"><a href="../galeri"><span class="glyphicon glyphicon-picture"></span> Galeri Kamar</a></li>
                        <li role="presentation"><a href="../pelanggan"><span class="glyphicon glyphicon-briefcase"></span> Data Pelanggan</a></li>
                        <li role="presentation"><a href="../pemesanan"><span class="glyphicon glyphicon-calendar"></span> Data Pemesanan</a></li>
                        <li role="presentation" class="active"><a href=""><span class="glyphicon glyphicon-user"></span> Data Pengguna</a></li>
                    </ul>
                </div>
                <div class="col-md-1">
                    <a href="#" class="btn btn-warning" data-toggle='modal' data-target="#laporan">Laporan</a>
                </div>
                <div class="col-md-1">
                    <a href="#" class="btn btn-danger" data-toggle='modal' data-target="#confirmLogout">Logout</a>
                </div>
            
            <!-- konten -->
                <!-- Data Pengguna -->
                <div id="data5" class="row">
                    <div class="col-md-12 page-header">
                        <h3>Data Pengguna</h3>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM tbl_pengguna";
                            $no = 1;
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                echo "<tr>
                                        <td>$no</td>
                                        <td>$data[username]</td>
                                        <td>$data[password]</td>
                                        <td>
                                            <a data-id='$data[username]' class='edit btn btn-default btn-xs btn-success' data-href='../aksi/?edit=pengguna&id=$data[username]' data-toggle='modal' data-target='#editPengguna'>
                                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit
                                            </a>
                                            <a id='$data[username]' class='hapus btn btn-default btn-xs btn-danger' href='#' data-href='../aksi/?hapus=pengguna&id=$data[username]' data-toggle='modal' data-target='#confirmDelete'>
                                                <span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $no++;
                            }
                        ?>
                    </table>
                    <a class='btn btn-default btn-md btn-primary' data-toggle="modal" data-target="#tambahPengguna">
                        <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Tambah
                    </a>
                </div>
        </div>

        <!-- Modal Tambah Pengguna -->
        <div id="tambahPengguna" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Tambah Pengguna
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../aksi/?tambah=pengguna" method="post">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pasword" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value="" class="form-control" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Pengguna -->
        <div id="editPengguna" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Pengguna
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input id="username" type="text" name="username" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input id="password" type="password" name="password" value="" class="form-control" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Confirm Delete -->
        <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Yakin akan menghapus data ?</h4>
                    </div>
                    <div class="modal-body">
                        <p id="record" class="alert alert-danger"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-danger btn-ok">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Confirm Logout -->
        <div class="modal fade" id="confirmLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Yakin akan keluar ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a href="../aksi/logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    </body>
</html>