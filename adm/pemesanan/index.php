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
        <title>Data Pemesanan</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

        <!-- jquery -->
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                //Memanggil data dari json untuk menampilkan data kamar
                $("#noKamar").change(function(){
                    var noKamar=$("#noKamar").val();
                    $.ajax({
                        type:"POST",
                        data:"no_kamar="+noKamar,
                        url :"jsonhitung.php",
                        dataType:"json",
                        success:function(data){
                            $("#harga").val(data.harga);
                            hitung();
                        }
                    });
                    
                });

                //Fungsi untuk menghitung total harga
                function hitung(){
                    var totalHarga = 0;
                    var harga = parseInt($("#harga").val(),10);
                    var lama = parseInt($("#lama").val(),10);
                    
                    totalHarga = lama*harga  ;
                    $("#totalHarga").val(totalHarga);
                }
                $("#lama").on("keyup keypress blur change focus",function(){
                    hitung();
                });
                
            });
        </script>
        <script>
            $(document).ready(function(){
                //Edit Data
                $(".edit").click(function(){
                    $(".no_kamar").html(
                        "<option value = "+$(this).attr('id')+">"+$(this).attr('id')+"</option><option value=''>-- PILIH KAMAR LAIN--</option><?php $query = $dbh->query("select * from tbl_kamar where status='Kosong'"); while($data = $query->fetch()){ echo "<option value='$data[no_kamar]'>$data[no_kamar]</option>"; } ?>"
                    );
                    var noPemesanan=$(this).attr('data-id');
                    $("#formEdit").attr('action',$(this).attr('data-href'));
                    $.ajax({
                        type:"POST",
                        data:"no_pemesanan="+noPemesanan,
                        url :"json.php",
                        dataType:"json",
                        success:function(data){
                            $("#no_pemesanan").val(data.no_pemesanan);
                            $("#no_pelanggan").val(data.no_pelanggan);
                            $("#tgl_pemesanan").val(data.tgl_pemesanan);
                            $(".lama").val(data.lama);
                            $(".total_harga").val(data.total_harga);
                        }
                    });
                });

                //Memanggil data dari json untuk menampilkan data kamar
                $(".no_kamar").change(function(){
                    var noKamar=$(".no_kamar").val();
                    $.ajax({
                        type:"POST",
                        data:"no_kamar="+noKamar,
                        url :"jsonhitung.php",
                        dataType:"json",
                        success:function(data){
                            $(".harga").val(data.harga);
                            hitung2();
                        }
                    });
                    
                });

                //Fungsi untuk menghitung total harga
                function hitung2(){
                    var totalHarga = 0;
                    var harga = parseInt($(".harga").val(),10);
                    var lama = parseInt($(".lama").val(),10);
                    
                    totalHarga = lama*harga  ;
                    $(".total_harga").val(totalHarga);
                }
                $(".lama").on("keyup keypress blur change focus",function(){
                    hitung2();
                });

                //Confirm Delete
                $('.hapus').click(function(){
                    $('.btn-ok').attr('href',$(this).attr('data-href'));
                    $('#record').html("Nomor pemesanan "+$(this).attr("id")+" akan dihapus.");
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
                        <li role="presentation" class="active"><a href=""><span class="glyphicon glyphicon-calendar"></span> Data Pemesanan</a></li>
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
            <!-- Data Pelanggan -->
            <div id="data4" class="row">
                    <div class="col-md-12 page-header">
                        <h3>Data Pemesanan</h3>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <tr>
                            <th>#</th>
                            <th>No. Pemesanan</th>
                            <th>No. Kamar</th>
                            <th>No. Pelanggan</th>
                            <th>Tanggal Checkin</th>
                            <th>Lama</th>
                            <th>Tanggal Checkout</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM tbl_pemesanan";
                            $no = 1;
                            $query = $dbh->query($sql);
                            while($data = $query->fetch()){
                                echo "<tr>
                                        <td>$no</td>
                                        <td>$data[no_pemesanan]</td>
                                        <td>$data[no_kamar]</td>
                                        <td>$data[no_pelanggan]</td>
                                        <td>$data[tgl_pemesanan]</td>
                                        <td>$data[lama]</td>
                                        <td>$data[tgl_checkout]</td>
                                        <td>$data[total_harga]</td>
                                        <td>$data[status]</td>
                                        <td>
                                            <a data-id='$data[no_pemesanan]' id='$data[no_kamar]' class='edit btn btn-default btn-xs btn-success' data-href='../aksi/?edit=pemesanan&id=$data[no_pemesanan]&kamar=$data[no_kamar]' data-toggle='modal' data-target='#editPemesanan'>
                                                <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit
                                            </a>
                                            <a id='$data[no_pemesanan]' class='hapus btn btn-default btn-xs btn-danger' href='#' data-href='../aksi/?hapus=pemesanan&id=$data[no_pemesanan]&kamar=$data[no_kamar]' data-toggle='modal' data-target='#confirmDelete'>
                                                <span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $no++;
                            }
                        ?>
                    </table>
                    <a class='btn btn-default btn-md btn-primary' data-toggle="modal" data-target="#tambahPemesanan">
                        <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span> Tambah
                    </a>
                </div>

        <!-- Modal Tambah Pemesanan -->
        <div id="tambahPemesanan" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Tambah Pemesanan
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../aksi/?tambah=pemesanan" method="POST">
                            <div class="form-group">
                                <label for="noPemesanan" class="col-sm-2 control-label">No. Pemesanan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_pemesanan" value=<?php
                                        $query = $dbh->query("SELECT count(*) FROM tbl_pemesanan");
                                        $data = $query->fetch();
                                        echo $data[0]+1;
                                    ?> class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noKamar" class="col-sm-2 control-label">No. Kamar</label>
                                <div class="col-sm-10">
                                    <select id="noKamar" name="no_kamar" class="form-control" required>
                                        <option value="">-- PILIH NO. KAMAR --</option>
                                        <?php
                                            $query = $dbh->query("select * from tbl_kamar where status='Kosong'");
                                            while($data = $query->fetch()){
                                                echo "<option value='$data[no_kamar]'>$data[no_kamar]</option>";
                                            }
                                        ?>
                                    </select>
                                    <input id="harga" type="hidden" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noPelanggan" class="col-sm-2 control-label">No. Pelanggan</label>
                                <div class="col-sm-10">
                                    <select name="no_pelanggan" class="form-control">
                                        <?php
                                            $query = $dbh->query("select * from tbl_pelanggan");
                                            while($data = $query->fetch()){
                                                echo "<option value='$data[no_pelanggan]'>$data[no_pelanggan]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tglPemesanan" class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="Date" name="tgl_pemesanan" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lamaPemesanan" class="col-sm-2 control-label">Lama</label>
                                <div class="col-sm-10">
                                    <input id="lama" type="number" name="lama" value="0" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="totalHarga" class="col-sm-2 control-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input id="totalHarga" type="number" name="total_harga" value="" class="form-control" readonly>
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

        <!-- Modal Edit Pemesanan -->
        <div id="editPemesanan" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Edit Pemesanan
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" method="POST">
                            <div class="form-group">
                                <label for="noPemesanan" class="col-sm-2 control-label">No. Pemesanan</label>
                                <div class="col-sm-10">
                                    <input id="no_pemesanan" type="text" name="no_pemesanan" value="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noKamar" class="col-sm-2 control-label">No. Kamar</label>
                                <div class="col-sm-10">
                                    <select name="no_kamar" class="no_kamar form-control">
                                        
                                    </select>
                                    <input class="harga" type="hidden" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noPelanggan" class="col-sm-2 control-label">No. Pelanggan</label>
                                <div class="col-sm-10">
                                    <select id="no_pelanggan" name="no_pelanggan" class="form-control">
                                        <?php
                                            $query = $dbh->query("select * from tbl_pelanggan");
                                            while($data = $query->fetch()){
                                                echo "<option value='$data[no_pelanggan]'>$data[no_pelanggan]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tglPemesanan" class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input id="tgl_pemesanan" type="Date" name="tgl_pemesanan" value="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lamaPemesanan" class="col-sm-2 control-label">Lama</label>
                                <div class="col-sm-10">
                                    <input type="number" name="lama" value="0" class="lama form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="totalHarga" class="col-sm-2 control-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" name="total_harga" value="" class="total_harga form-control" readonly>
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