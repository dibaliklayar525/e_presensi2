<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>

<style>
    /* style map */
    .leaflet-container {
        height: 400px;
        width: 600px;
        max-width: 100%;
        max-height: 100%;
    }
</style>

<?php ?>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <!-- alamat Kantor Absen -->
                <span class="text-muted"><i class="fa fa-map"></i> Alamat Absensi</span>
                <div class="form-group">
                    <label for="exampleInputBorder"><?= $dataa['nama'] ?>,</label>
                    <label class="text-justify"><?= $dataa['alamat'] ?></label>
                </div>

                <hr>

                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3"><?= tglIndo($dataa['tgl_absensi']) ?></h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Masuk</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Pulang</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!-- absen masuk -->

                            <div class="tab-pane active" id="tab_1">
                                <span class="text-muted"><i class="fa fa-clock"></i> Absen Pukul</span>
                                <div class="form-group">
                                    <label for="exampleInputBorder"><?= $dataa['absen_in'] ?></label>
                                </div>
                                <span class="text-muted"><i class="fa fa-info"></i> Keterangan</span>
                                <div class="form-group">
                                    <label for="exampleInputBorder"><?= $dataa['name'] ?>, (<?= $dataa['kd_ket'] ?>)</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-muted"><i class="fa fa-map-marker"></i> Koordinat <?= $dataa['lokasi_in'] ?></p>

                                        <!-- map masuk -->
                                        <div id="map" style=" border-radius:15px;"></div>

                                    </div>
                                    <div class="col-md-6">

                                        <p class="text-muted"><i class="fa fa-image"></i> Foto <?= $dataa['foto_in'] ?></p>

                                        <img src="<?= base_url('img/absen/in') . '/' . $dataa['foto_in'] ?>" alt="tidak ada foto absen" width="100%" style="border-radius: 15px;" class="img-responsive">
                                    </div>
                                </div>
                            </div>

                            <!-- absen pulang -->

                            <div class="tab-pane" id="tab_2">
                                <span class="text-muted"><i class="fa fa-clock"></i> Absen Pukul</span>
                                <div class="form-group">
                                    <label for="exampleInputBorder"><?= $dataa['absen_out'] ?></label>
                                </div>
                                <span class="text-muted"><i class="fa fa-info"></i> Keterangan</span>
                                <div class="form-group">
                                    <label for="exampleInputBorder"><?= $dataa['name'] ?>, (<?= $dataa['kd_ket'] ?>)</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-muted"><i class="fa fa-map-marker"></i> Koordinat <?= $dataa['lokasi_out'] ?></p>

                                        <!-- map pulang -->
                                        <div id="map_out" style=" border-radius:15px;"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-muted"><i class="fa fa-image"></i> Foto <?= $dataa['foto_out'] ?></p>

                                        <hr>
                                        <img src="<?= base_url('img/absen/out') . '/' . $dataa['foto_out'] ?>" alt="tidak ada foto absen" width="100%" style="border-radius: 15px;" class="img-responsive">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- leaflet -->
<link rel="stylesheet" href="<?= base_url('adminLTE3/plugins/leaflet/leaflet.css') ?>" />
<script src="<?= base_url('adminLTE3/plugins/leaflet/leaflet.js') ?>"></script>

<script>
    function mapping(maps, location, officeLocation, nameOffice) {
        // lokasi map
        let map = L.map(maps).setView(location, 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <?= CodeIgniter\CodeIgniter::APP_NAME ?>'
        }).addTo(map);
        // user marker
        L.marker(location).addTo(map);
        // lokasi kantor
        let circle = L.circle(officeLocation, {
            color: 'red',
            radius: 100
        }).addTo(map)
        L.circleMarker(officeLocation).bindPopup(nameOffice).openPopup().addTo(map);
    }

    // absen in
    mapping('map', [<?= $dataa['lokasi_in'] ?>], [<?= $dataa['lokasi_kantor'] ?>], '<?= $dataa['nama'] ?>');
    // absen out
    mapping('map_out', [<?= $dataa['lokasi_out'] ?>], [<?= $dataa['lokasi_kantor'] ?>], '<?= $dataa['nama'] ?>');
</script>

<?= $this->endSection() ?>