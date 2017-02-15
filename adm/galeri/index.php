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
        <title>Data Tipe Kamar</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

        <!-- jquery -->
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                //Edit Data
                $(".edit").click(function(){
                    var idGaleri=$(this).attr('data-id');
                    $("#formEdit").attr('action',$(this).attr('data-href'));
                    $.ajax({
                        type:"POST",
                        data:"id_galeri="+idGaleri,
                        url :"json.php",
                        dataType:"json",
                        success:function(data){
                            $("#gambar").attr('src',('../../'+data.url_gambar));
                            $("#gambar").attr('alt',data.no_kamar);
                        }
                    });
                });

                //Confirm Delete
                $('.hapus').click(function(){
                    $('.btn-ok').attr('href',$(this).attr('data-href'));
                    $('#record').html("Gambar <img src='../../"+$(this).attr("id")+"' style='width:150px'> akan dihapus.<br>");
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
                        <li role="presentation" class="active"><a href=""><span class="glyphicon glyphicon-picture"></span> Galeri Kamar</a></li>
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
            <!-- Data Tipe Kamar -->
            <div class="row">
                    <div class="col-md-12 page-header">
                        <h3>Data Galeri Kamar</h3>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <tr>
                            <th>#</th>
                            <th>ID Gambar</th>
                            <th>No. Kamar</th>
                            <th>Gambar</th>
                            <th>URL</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM tbl_galeri";
                            $no = 1;
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                echo "<tr>
                                        <td>$no</td>
                                        <td>$data[id_galeri]</td>
                                        <td>$data[no_kamar]</td>
                                        <td><img alt='Kamar $data[no_kamar]' src='../../$data[url_gambar]' style='width:100px'></td>
                                        <td>$data[url_gambar]</td>
                                        <td>
                                            <a data-id='$data[id_galeri]' class='edit btn btn-default btn-xs btn-success' data-href='../aksi/?edit=gambar&id=$data[id_galeri]&url=$data[url_gambar]' data-toggle='modal' data-target='#editGambar'>
                                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit
                                            </a>
                                            <a id='$data[url_gambar]' class='hapus btn btn-default btn-xs btn-danger' href='#' data-href='../aksi/?hapus=gambar&id=$data[id_galeri]&url=$data[url_gambar]' data-toggle='modal' data-target='#confirmDelete'>
                                                <span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $no++;
                            }
                        ?>
                    </table>
                    <a id="tambah" class='btn btn-default btn-md btn-primary' data-toggle="modal" data-target="#upload">
                        <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Tambah
                    </a>
                </div>
        </div>

        <!-- Modal Upload Gambar -->
        <div id="upload" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Tambah Gambar
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formUpload" class="form-horizontal" action="../aksi/?do=upload" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                            <label for="noKamar" class="col-sm-2 control-label">No. Kamar</label>
                                <div class="col-sm-10">
                                    <select id="noKamar" name="no_kamar" class="form-control" required>
                                        <option value="">-- PILIH NO. KAMAR --</option>
                                        <?php
                                            $query = $dbh->query("select * from tbl_kamar");
                                            while($data = $query->fetch()){
                                                echo "<option value='$data[no_kamar]'>$data[no_kamar]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-sm-2 control-label">Pilih Gambar</label>
                                <div class="col-sm-10">
                                    <input id="file" type="file" name="file" class="form-control" required>
                                    <input type="hidden" name="MAX_FILE_SIZE" size="30000">
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

       <!-- Modal Edit Gambar -->
        <div id="editGambar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Gambar
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                            <label for="ganti" class="col-sm-2 control-label">Ganti Gambar</label>
                                <div class="col-sm-10">
                                    <img id="gambar" alt='' src='' style='width:150px;'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-sm-2 control-label">Pilih Gambar</label>
                                <div class="col-sm-10">
                                    <input id="file" type="file" name="file" class="form-control" required>
                                    <input type="hidden" name="MAX_FILE_SIZE" size="30000">
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
            <div class="modal-dialog">
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