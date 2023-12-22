<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <?= date('d-m-Y', $awal_cuti) ?> s.d <?= date('d-m-Y', $akhir_cuti) ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <h4 class="card-title">Jumlah hari kerja: <span class="badge badge-success"><?= $jumlah_cuti ?>
                        Hari</span> | </h4>
                <h4 class="card-title"> Hari Sabtu - Minggu <span class="badge badge-dark"><?= $jumlah_sabtuminggu ?>
                        Hari</span> | </h4>
                <h4 class="card-title">Total Hari <span class="badge badge-primary"> <?= $abtotal ?> Hari</span></h4>

                <br>
                <h4>Tanggal Hari Kerja</h4>
                <table class="table table-bordered">
                    <tbody>
                        <?php foreach ($haricuti as $value): ?>
                        <tr>
                            <td colspan="5"><?= date('d-m-Y', $value)?></td>
                            <td colspan="3"><?= strftime("%A, %d %B %Y", date($value))?></td>
                        </tr>
                        <?php endforeach ;?>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>