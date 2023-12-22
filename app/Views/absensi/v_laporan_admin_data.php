<div class="row">
    <div class="col-md-4">
        <!-- pdf -->
        <form action="<?= base_url("admin/absensi/dataLapPegawaiPdf") ?>" method="post">
            <input type="hidden" name="tgl_awal" id="" value="<?= date("d-m-Y",$tgl_awal) ?>">
            <input type="hidden" name="tgl_akhir" id="" value="<?= date("d-m-Y", $tgl_akhir) ?>">
            <button type="submit" name="" class='btn btn-outline-danger btn-block'><i class='fas fa-file-pdf'></i>
                Export
                PDF</button>
        </form>
    </div>
    <div class="col-md-4">
        <!-- excel -->
        <form action="<?= base_url("admin/absensi/dataLapPegawaiExcel") ?>" method="post">
            <input type="hidden" name="tgl_awal_ex" id="" value="<?= date("d-m-Y",$tgl_awal) ?>">
            <input type="hidden" name="tgl_akhir_ex" id="" value="<?= date("d-m-Y",$tgl_akhir) ?>">
            <!-- pdf -->
            <button type="submit" name="btnExport" class='btn btn-outline-success btn-block'><i
                    class='fas fa-file-excel'></i>
                Export Excel
            </button>
        </form>
    </div>
</div>

<hr>

<!-- tabel -->

<table id="dTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th colspan="3">Tanggal: <?= date("d-m-Y", $tgl_awal) ?> s.d <?= date("d-m-Y", $tgl_akhir) ?>, Total:
                <?= $abtotal; ?>
                Hari</th>
            <th coslpan="4">Kehadiran: <span class="badge badge-success"><?= $jumlah_cuti?> hari</span></th>
            <th colspan="6">Hari Sabtu-Minggu: <span class="badge badge-secondary"><?= $jumlah_sabtuminggu?></span></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Kehadiran</th>
            <th>Izin</th>
            <th>Tidak Hadir</th>
            <th>Absen Pagi</th>
            <th>Absen Sore</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($databulanan as $val) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= empty($val['nama_user']) ? '-' : $val['nama_user'] ?></td>
            <td><?= empty($val['jabatan']) ? '-' : $val['jabatan'] ?></td>
            <!-- <td><?= empty($val['absen_user']) ? '-' : $val['absen_user'] ?></td> -->
            <td><?= empty($val['absen_sore']) ? '-' : $val['absen_sore'] ?></td>
            <td><?= empty($val['izin']) ? '-' : $val['izin'] ?></td>
            <td><?= $val['sisa_tdk_hdr'] - $jumlah_sabtuminggu <=0 ? "0 (".$val['sisa_tdk_hdr'] - $jumlah_sabtuminggu.")" : $val['sisa_tdk_hdr'] - $jumlah_sabtuminggu ?>
            </td>
            <td><?= empty($val['absen_user']) ? '-' : $val['absen_user'] ?></td>
            <td><?= empty($val['absen_sore']) ? '-' : $val['absen_sore'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>