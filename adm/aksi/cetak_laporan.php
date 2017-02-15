<!DOCTYPE html>
<html>
    <head>
        <title>Laporan</title>

        <!-- css bootstrap -->
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
        <script type="text/javascript" src="../../js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $("#cetak").click(function(){
                    $("#cetak").hide();
                    print();
                });
            });
        </script>
    </head>
<?php
    require("../../inc/koneksi.php");
    @$tglAwal = $_POST['tglAwal'];
    @$tglAkhir = $_POST['tglAkhir'];
    $no = 1;

    $sql = "select * from tbl_pemesanan where tgl_pemesanan >= '$tglAwal' and tgl_pemesanan <= '$tglAkhir'";
    $query = $dbh->query($sql);
    echo '<div>
            <div class="modal-header">
                    <h4>Cetak Laporan</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered table-striped">
                        <tr>
                            <th>#</th>
                            <th>No. Pemesanan</th>
                            <th>No. Kamar</th>
                            <th>No. Pelanggan</th>
                            <th>Tanggal Checkin</th>
                            <th>Lama</th>
                            <th>Tanggal Checkout</th>
                            <th>Total Harga</th>
                        </tr>';
    $total = 0;
    while ($data = $query->fetch()){
        echo "<tr><td>$no</td>
                <td>$data[no_pemesanan]</td>
                <td>$data[no_kamar]</td>
                <td>$data[no_pelanggan]</td>
                <td>$data[tgl_pemesanan]</td>
                <td>$data[lama]</td>
                <td>$data[tgl_checkout]</td>
                <td>$data[total_harga]</td></tr>";       
        $total += $data['total_harga'];
        $no++;
    }
    $no -= 1;
    echo "
    <tr>
        <th>Jumlah Pemesanan</th>
        <td>$no</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <th>Jumlah</th>
        <td>$total</td>
    </tr>";
        echo '</table>
                </div>
                <div class="modal-footer">
                    <button id="cetak" class="btn btn-primary">Cetak</button>
                </div>
                </div>
            </div>';
?>
</html>