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
        <title>Data Pelanggan</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

        <!-- jquery -->
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                //Edit Data
                $(".edit").click(function(){
                    var nip=$(this).attr('data-id');
                    $("#formEdit").attr('action',$(this).attr('data-href'));
                    $.ajax({
                        type:"POST",
                        data:"nip="+nip,
                        url :"json.php",
                        dataType:"json",
                        success:function(data){
                            //$("#nip").val(data.nip);
                            $("#nama").val(data.nama);
                            $("#statusPegawai").val(data.status_pegawai);
                            $("#satker").val(data.satker);
                            $("#agama").val(data.agama);
                            $("#tempatLahir").val(data.tempat_lahir);
                            $("#tglLahir").val(data.tempat_lahir);
                            $("#alamat").val(data.alamat);
                            $("#jeniskelamin").val(data.jeniskelamin);
                            $("#statusnikah").val(data.statusnikah);
                            $("#golongandarah").val(data.golongandarah);
                            $("#tinggi").val(data.tinggi);
                            $("#berat").val(data.berat);
                            $("#foto").val(data.foto);
                        }
                    });
                });
                
                //Confirm Delete
                $('.hapus').click(function(){
                    $('.btn-ok').attr('href',$(this).attr('data-href'));
                    $('#record').html("Pelanggan dengan no. "+$(this).attr("id")+" akan dihapus.<br>Pemesanan dari pelanggan tersebut, juga akan dihapus.");
                });
            });
        </script>
    </head>
    <body>
        <!-- container dari bootstrap -->
        <div class="container container-fluid">

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
                        <li role="presentation" class="active"><a href=""><span class="glyphicon glyphicon-briefcase"></span> Data Pelanggan</a></li>
                        <li role="presentation"><a href="../pemesanan"><span class="glyphicon glyphicon-calendar"></span> Data Pemesanan</a></li>
                        <li role="presentation"><a href="../pengguna"><span class="glyphicon glyphicon-user"></span> Data Pengguna</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger" data-toggle='modal' data-target="#confirmLogout">Logout</a>
                </div>
            
            <!-- konten -->
            <!-- Data Pelanggan -->
            <div id="data3" class="row">
                <div class="col-md-12 page-header">
                    <h3>Data Pelanggan</h3>
                </div>
                <table class="table table-striped table-bordered table-hover table-responsive">
                    <tr>
                        <th>Nip</th>
                        <th>Nama Lengkap</th>
                        <th>Status Pegawai</th>
                        <th>Satuan Kerja</th>
                        <th>Agama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Status Nikah</th>
                        <th>Golongan Darah</th>
                        <th>Tinggi</th>
                        <th>Berat</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                        <?php
                            $sql = "SELECT * FROM tbl_pegawai";
                            $no = 1;
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                echo "<tr>
                                        <td>$data[nip]</td>
                                        <td>$data[nama]</td>
                                        <td>$data[id_status_pegawai]</td>
                                        <td>$data[id_satker]</td>
                                        <td>$data[id_agama]</td>
                                        <td>$data[tmp_lahir]</td>
                                        <td>$data[tgl_lahir]</td>
                                        <td>$data[alamat]</td>
                                        <td>$data[jenkel]</td>
                                        <td>$data[status_nikah]</td>
                                        <td>$data[gol_darah]</td>
                                        <td>$data[tinggi]</td>
                                        <td>$data[berat]</td>
                                        <td>$data[foto]</td>
                                        <td>
                                            <a data-id='$data[nip]' class='edit btn btn-default btn-xs btn-success' data-href='../aksi/?edit=pegawai&id=$data[nip]' data-toggle='modal' data-target='#editPegawai'>
                                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit
                                            </a>
                                            <a id='$data[nip]' class='hapus btn btn-default btn-xs btn-danger' href='#' data-href='../aksi/?hapus=pelanggan&id=$data[nip]' data-toggle='modal' data-target='#confirmDelete'>
                                                <span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $no++;
                            }
                        ?>
                    </table>
                    <a class='btn btn-default btn-md btn-primary' data-toggle="modal" data-target="#tambahPelanggan">
                        <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Tambah
                    </a>
                </div>

        <!-- Modal Tambah Pegawai -->
        <div id="tambahPelanggan" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Tambah Pelanggan
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../aksi/?tambah=pelanggan" method="POST">
                            <div class="form-group">
                                <label for="noPelanggan" class="col-sm-2 control-label">No. Pelanggan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_pelanggan" value=<?php
                                        $query = $dbh->query("select count(*) from tbl_pelanggan");
                                        $data = $query->fetch();
                                        echo $data[0]+1;
                                    ?> class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namaPelanggan" class="col-sm-2 control-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_pelanggan" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="alamat_pelanggan" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noTelp" class="col-sm-2 control-label">No. Telp/HP</label>
                                <div class="col-sm-10">
                                    <input type="tel" name="telp_pelanggan" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
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

        <!-- Modal Edit Pelanggan -->
        <div id="editPelanggan" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Pelanggan
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label for="noPelanggan" class="col-sm-2 control-label">No. Pelanggan</label>
                                <div class="col-sm-10">
                                    <input id="no_pelanggan" type="text" name="no_pelanggan" value="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namaPelanggan" class="col-sm-2 control-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input id="nama_pelanggan" type="text" name="nama_pelanggan" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea id="alamat_pelanggan" class="form-control" rows="3" name="alamat_pelanggan" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noTelp" class="col-sm-2 control-label">No. Telp/HP</label>
                                <div class="col-sm-10">
                                    <input id="telp_pelanggan" type="tel" name="telp_pelanggan" value="" class="form-control" required>
                                </div>
                            </div>
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