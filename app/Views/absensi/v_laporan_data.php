<a href='<?= base_url("pegawai/absensi/pdf-laporan") ?>' class='btn btn-default'><i class='fas fa-file-pdf'></i> Export
    PDF</a>

<hr>
<span></span>
<table class="table">
    <tr>
        <th>Tanggal</th>
        <th>:</th>
        <th><?= date("d-m-Y", $tgl_awal) ?> s.d <?= date("d-m-Y", $tgl_akhir) ?>, Total
            <?= $abtotal; ?> hari</th>
    </tr>
    <tr>
        <th>Wajib Hadir</th>
        <th>:</th>
        <th><span class="badge badge-success"><?= $jumlah_cuti ?> hari</span></th>
    </tr>
    <tr>
        <th>Sabtu-Minggu</th>
        <th>:</th>
        <th><span class="badge badge-secondary"><?= $jumlah_sabtuminggu ?> hari</span></th>
    </tr>
    <tr>
        <th>Nama</th>
        <th>:</th>
        <th><?= $check_user_absensi['name'] ?></th>
    </tr>
    <tr>
        <th>Jabatan</th>
        <th>:</th>
        <th><?= $check_user_absensi['nama_jabatan'] ?></th>
    </tr>
    <tr>
        <th>Lokasi Absen</th>
        <th>:</th>
        <th><?= $check_user_absensi['nama'] ?></th>
    </tr>
</table>
<table id="dTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <td colspan="5">Absensi</td>
            <td colspan="3">Izin</td>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Ket. Absen</th>
            <th>Tanggal</th>
            <th>Menyetujui</th>
            <th>Ket. Izin</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 1; ?>
        <?php foreach ($databulanan as $val) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= empty($val['tgl_absensi']) ? '-' : tglIndo($val['tgl_absensi']) ?></td>
            <td><?= empty($val['absen_in']) ? '-' : $val['absen_in']; ?></td>
            <td><?= empty($val['absen_out']) ? '-' : $val['absen_out'] ?></td>
            <td><?= empty($val['kode_ket']) ? '-' : $val['kode_ket'] ?>
                (<?= empty($val['name_ket']) ? '-' : $val['name_ket'] ?>)</td>
            <td><?= empty($val['tgl_izin']) ? '-' : tglIndo($val['tgl_izin']) ?></td>
            <td><?= empty($val['approve']) ? '-' : $val['approve'] ?></td>
            <td><?= empty($val['name_ket_izin']) ? '-' : $val['name_ket_izin'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
let table = new DataTable('#dTable', {
    'responsive': true,
});
table();
</script>