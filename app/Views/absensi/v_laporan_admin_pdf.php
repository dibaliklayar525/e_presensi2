<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }

    title {
        padding-top: 10px;
    }

    h1 {
        text-align: center;
        text-transform: uppercase;
    }

    #judul {
        text-align: center;
    }

    #halaman {
        width: auto;
        height: auto;
        position: absolute;
        border: 1px solid;
        padding-top: 30px;
        padding-left: 30px;
        padding-right: 30px;
        padding-bottom: 80px;
    }
    </style>
</head>

<body>
    <!-- 
    <div class="title">
        <h1>Badan Pendapatan Daerah</h1>
        <h1>Kabupaten Seluma</h1>
    </div> -->

    <!-- <h3 id=judul>BADAN PENDAPATAN DAERAH</h3>
    <h3 id=judul>KABUPATEN SELUMA</h3> -->
    <h4 id=judul>LAPORAN ABSENSI KEHADIRAN</h4>

    <table>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?= date("d-m-Y", $tgl_awal) ?> s.d <?= date("d-m-Y", $tgl_akhir) ?></td>
        </tr>
        <tr>
            <td>Hari Kerja</td>
            <td>:</td>
            <td><?= $jumlah_cuti ?> hari</td>
        </tr>
        <tr>
            <td>Total Hari</td>
            <td>:</td>
            <td><?= $abtotal ?> hari</td>
        </tr>
    </table>

    <table id="customers">
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
        <?php $no = 1; ?>
        <?php foreach ($data as $val) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= empty($val['nama_user']) ? '-' : $val['nama_user'] ?></td>
            <td><?= empty($val['jabatan']) ? '-' : $val['jabatan'] ?></td>
            <td><?= empty($val['absen_sore']) ? '-' : $val['absen_sore'] ?></td>
            <td><?= empty($val['izin']) ? '-' : $val['izin'] ?></td>
            <td><?= $val['sisa_tdk_hdr'] - $jumlah_sabtuminggu <=0 ? "0 (".$val['sisa_tdk_hdr'] - $jumlah_sabtuminggu.")" : $val['sisa_tdk_hdr'] - $jumlah_sabtuminggu ?>
            </td>
            <td><?= empty($val['absen_user']) ? '-' : $val['absen_user'] ?></td>
            <td><?= empty($val['absen_sore']) ? '-' : $val['absen_sore']?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>