<?php
    echo '<div id="laporan" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cetak Laporan</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" action="../aksi/cetak_laporan.php" method="POST">
                            <div class="form-group">
                                <label for="tglAwal" class="col-sm-2 control-label">Dari Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggalAwal" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tglAkhir" class="col-sm-2 control-label">Sampai Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tglAkhir" value="" class="form-control" required>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                    </form>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>';
?>