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
                    var tipe=$(this).attr('data-id');
                    $("#formEdit").attr('action',$(this).attr('data-href'));
                    $.ajax({
                        type:"POST",
                        data:"tipe="+tipe,
                        url :"json.php",
                        dataType:"json",
                        success:function(data){
                            $("#tipe").val(data.tipe);
                            var fasilitas = (data.fasilitas).split(",");
                            $("#fasilitas1").val(fasilitas[0]);
                            $("#fasilitas2").val(fasilitas[1]);
                            $("#fasilitas3").val(fasilitas[2]);
                            $("#fasilitas4").val(fasilitas[3]);
                            $("#fasilitas5").val(fasilitas[4]);
                            $("#harga").val(data.harga);
                        }
                    });
                });

                //Confirm Delete
                $('.hapus').click(function(){
                    $('.btn-ok').attr('href',$(this).attr('data-href'));
                    $('#record').html("Tipe kamar "+$(this).attr("id")+" akan dihapus.<br>Kamar bertipe tersebut, juga akan dihapus.");
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
                        <li role="presentation" class="active"><a href=""><span class="glyphicon glyphicon-bed"></span> Data Tipe Kamar</a></li>
                        <li role="presentation"><a href="../kamar"><span class="glyphicon glyphicon-lamp"></span> Data Kamar</a></li>
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
            <!-- Data Tipe Kamar -->
            <div class="row">
                    <div class="col-md-12 page-header">
                        <h3>Data Tipe Kamar</h3>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <tr>
                            <th>#</th>
                            <th>Tipe</th>
                            <th>Fasilitas</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM tbl_tipe";
                            $no = 1;
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                echo "<tr>
                                        <td>$no</td>
                                        <td>$data[tipe]</td>
                                        <td>$data[fasilitas]</td>
                                        <td>$data[harga]</td>
                                        <td>
                                            <a data-id='$data[tipe]' class='edit btn btn-default btn-xs btn-success' data-href='../aksi/?edit=tipe&id=$data[tipe]' data-toggle='modal' data-target='#editTipe'>
                                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit
                                            </a>
                                            <a id='$data[tipe]' class='hapus btn btn-default btn-xs btn-danger' href='#' data-href='../aksi/?hapus=tipe&id=$data[tipe]' data-toggle='modal' data-target='#confirmDelete'>
                                                <span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $no++;
                            }
                        ?>
                    </table>
                    <a id="tambah" class='btn btn-default btn-md btn-primary' data-toggle="modal" data-target="#tambahTipe">
                        <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Tambah
                    </a>
                </div>
        </div>

        <!-- Modal Tambah Tipe -->
        <div id="tambahTipe" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Tambah Tipe Kamar
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../aksi/?tambah=tipe" method="POST">
                            <div class="form-group">
                                <label for="tipe" class="col-sm-2 control-label">Tipe</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tipe" value=<?php
                                        $query = $dbh->query("SELECT count(*) FROM tbl_tipe");
                                        $data = $query->fetch();
                                        echo $data[0]+1;
                                    ?> class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fasilitas" class="col-sm-2 control-label">Fasilitas</label>
                                <div class="col-sm-10">
                                    <input type="text" name="fasilitas1" value="" class="form-control" required><br>
                                    <input type="text" name="fasilitas2" value="" class="form-control"><br>
                                    <input type="text" name="fasilitas3" value="" class="form-control"><br>
                                    <input type="text" name="fasilitas4" value="" class="form-control"><br>
                                    <input type="text" name="fasilitas5" value="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga" class="col-sm-2 control-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga" value="" class="form-control" required>
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

        <!-- Modal Edit Tipe -->
        <div id="editTipe" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Tipe Kamar
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label for="tipe" class="col-sm-2 control-label">Tipe</label>
                                <div class="col-sm-10">
                                    <input id="tipe" type="text" name="tipe" value="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fasilitas" class="col-sm-2 control-label">Fasilitas</label>
                                <div class="col-sm-10">
                                    <input id="fasilitas1" type="text" name="fasilitas1" value="" class="form-control" required><br>
                                    <input id="fasilitas2" type="text" name="fasilitas2" value="" class="form-control"><br>
                                    <input id="fasilitas3" type="text" name="fasilitas3" value="" class="form-control"><br>
                                    <input id="fasilitas4" type="text" name="fasilitas4" value="" class="form-control"><br>
                                    <input id="fasilitas5" type="text" name="fasilitas5" value="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga" class="col-sm-2 control-label">Harga</label>
                                <div class="col-sm-10">
                                    <input id="harga" type="number" name="harga" value="" class="form-control" required>
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