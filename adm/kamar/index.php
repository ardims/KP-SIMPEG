<?php
    session_start();
    if (@$_SESSION['login'] != true){
        header("location:../");
    }
?>
<?php
    //koneksi database
    require("../../inc/koneksi.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Kamar</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

        <!-- jquery -->
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                //Edit Data
                $(".edit").click(function(){
                    var noKamar=$(this).attr('data-id');
                    $("#formEdit").attr('action',$(this).attr('data-href'));
                    $.ajax({
                        type:"POST",
                        data:"no_kamar="+noKamar,
                        url :"json.php",
                        dataType:"json",
                        success:function(data){
                            $("#no_kamar").val(data.no_kamar);
                            $("#tipe").val(data.tipe);
                            $("#status").val(data.status);
                        }
                    });
                });
                
                //Confirm Delete
                $('.hapus').click(function(){
                    $('.btn-ok').attr('href',$(this).attr('data-href'));
                    $('#record').html("Kamar "+$(this).attr("id")+" akan dihapus.<br>Pemesanan dan galeri kamar tersebut, juga akan dihapus.");
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
                        <li role="presentation" class="active"><a href=""><span class="glyphicon glyphicon-lamp"></span> Data Kamar</a></li>
                        <li role="presentation"><a href="../galeri"><span class="glyphicon glyphicon-picture"></span> Galeri Kamar</a></li>
                        <li role="presentation"><a href="../pelanggan"><span class="glyphicon glyphicon-briefcase"></span> Data Pelanggan</a></li>
                        <li role="presentation"><a href="../pemesanan"><span class="glyphicon glyphicon-calendar"></span> Data Pemesanan</a></li>
                        <li role="presentation"><a href="../pengguna"><span class="glyphicon glyphicon-user"></span> Data Pengguna</a></li>
                    </ul>
                </div>
                <div class="col-md-1">
                    <a href="#" class="btn btn-warning" data-toggle='modal' data-target="#laporan">Laporan</a>
                </div>
                <div class="col-md-1">
                    <a href="#" class="btn btn-danger" data-toggle='modal' data-target="#confirmLogout">Logout</a>
                </div>
            
            <!-- konten -->
            <!-- Data Kamar -->
            <div id="data2" class="row">
                    <div class="col-md-12 page-header">
                        <h3>Data Kamar</h3>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <tr>
                            <th>#</th>
                            <th>No. Kamar</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql = "select *,tbl_pemesanan.status as status_pemesanan,tbl_kamar.no_kamar as no_kam from tbl_kamar inner join tbl_pemesanan on tbl_kamar.no_kamar = tbl_pemesanan.no_kamar";
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                if (($data['status_pemesanan'] == "Selesai")){
                                    $dbh->query("update tbl_kamar set status='Kosong' where no_kamar='$data[no_kam]'");
                                }
                            }
                            $sql = "SELECT * FROM tbl_kamar";
                            $no = 1;
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                echo "<tr>
                                        <td>$no</td>
                                        <td>$data[no_kamar]</td>
                                        <td>$data[tipe]</td>
                                        <td>$data[status]</td>
                                        <td>
                                            <a data-id='$data[no_kamar]' class='edit btn btn-default btn-xs btn-success' data-href='../aksi/?edit=kamar&id=$data[no_kamar]' data-toggle='modal' data-target='#editKamar'>
                                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit
                                            </a>
                                            <a id='$data[no_kamar]' class='hapus btn btn-default btn-xs btn-danger' href='#' data-href='../aksi/?hapus=kamar&id=$data[no_kamar]' data-toggle='modal' data-target='#confirmDelete'>
                                                <span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $no++;
                            }
                        ?>
                    </table>
                    <a class='btn btn-default btn-md btn-primary' data-toggle="modal" data-target="#tambahKamar">
                        <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Tambah
                    </a>
                </div>
        </div>

        <!-- Modal Tambah Kamar -->
        <div id="tambahKamar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Tambah Kamar
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../aksi/?tambah=kamar" method="POST">
                            <div class="form-group">
                                <label for="noKamar" class="col-sm-2 control-label">No. Kamar</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_kamar" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tipe" class="col-sm-2 control-label">Tipe</label>
                                <div class="col-sm-10">
                                   <select name="tipe" class="form-control">
                                       <?php
                                       $query = $dbh->query("SELECT * FROM tbl_tipe");
                                       while($data = $query->fetch()){
                                           echo "<option value='$data[tipe]'>$data[tipe]</option>";
                                       }
                                       ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status">
                                        <option value="Kosong">Kosong</option>
                                        <option value="Terisi">Terisi</option>
                                    </select>
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

        <!-- Modal Edit Kamar -->
        <div id="editKamar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Kamar
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label for="noKamar" class="col-sm-2 control-label">No. Kamar</label>
                                <div class="col-sm-10">
                                    <input id="no_kamar" type="text" name="no_kamar" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tipe" class="col-sm-2 control-label">Tipe</label>
                                <div class="col-sm-10">
                                   <select id="tipe" name="tipe" class="form-control">
                                       <?php
                                       $query = $dbh->query("SELECT * FROM tbl_tipe");
                                       while($data = $query->fetch()){
                                           echo "<option value='$data[tipe]'>$data[tipe]</option>";
                                       }
                                       ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status">
                                        <option value="Kosong">Kosong</option>
                                        <option value="Terisi">Terisi</option>
                                    </select>
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