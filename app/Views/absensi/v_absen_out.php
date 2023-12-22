<?= $this->extend("layouts/pegawai_layout") ?>

<?= $this->section("content") ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <?= $title ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- style camera -->
    <style>
    .camera,
    .camera video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }

    .view,
    .view video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }

    #map {
        height: 400px;
    }
    </style>

    <!-- Main content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <label for="">Kamera</label>
                        </div>
                        <div class="card-body">
                            <span class="view" id="view"></span>
                            <div class="camera" id="camera"></div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn bg-red btn-block ambilFoto" id="ambilFoto"
                                name="button">Absen
                                Pulang</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- lokasi tikor -->
                            <label for="">Lokasi</label>
                            <input type="text" readonly class="form-control" name="lokasi" id="lokasi">
                        </div>
                        <div class="card-body">
                            <!-- map -->
                            <div id="map"></div>

                            <!-- audio -->
                            <audio id="notifikasi_in">
                                <source src="<?= base_url('sound/aksesditerimaterimakasih.mp3') ?>" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->

    </div>

    <!-- /.content -->

    <script>
    // sound notification
    let notification = document.getElementById('notifikasi_in');

    // camera initialization
    Webcam.set({
        width: 420,
        height: 340,
        image_format: 'jpeg',
        jpeg_quality: 90,
    });

    // Attach camera here
    Webcam.attach('.camera');

    // lokasi input
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
        let x = document.getElementById("lokasi");
        x.value = position.coords.latitude + "," + position.coords.longitude;

        // validasi radius
        let userLocation = L.latLng(position.coords.latitude, position.coords.longitude);

        // lokasi map
        let map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
        // lokasi user
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <?= CodeIgniter\CodeIgniter::APP_NAME ?>'
        }).addTo(map);
        L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
        // bandaran kantor
        // L.circle([position.coords.latitude, position.coords.longitude], {
        //             radius: 100
        //         }).addTo(map)
        //         .bindPopup('<?= session()->get('name') ?>')
        //         .openPopup();
        //     L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)

        // lokasi kantor
        let circle = L.circle([-3.8373216813884943, 102.30175938983412], {
            color: 'red',
            radius: 100
        }).addTo(map)
        L.marker([-3.8373216813884943, 102.30175938983412]).bindPopup('<?= $maps_office['nama'] ?>')
            .openPopup().addTo(map)

        // validasi kantor
        let distance = userLocation.distanceTo(circle.getLatLng());
        if (distance > circle.getRadius()) {
            Swal.fire({
                icon: 'error',
                title: 'Tidak berada di <?= $maps_office['nama'] ?>!',
                text: 'Lokasi anda terlalu jauh untuk absen di <?= $maps_office['nama'] ?>, pastikan anda berada dalam radius kantor.',
                footer: '<a href="<?= base_url('pegawai/absensi'); ?>">Kembali</a>'
            })
            $("#ambilFoto").hide();
            setTimeout(function() {
                window.location.href = "<?= base_url('pegawai/absensi'); ?>";
            }, 5000);
        }
    }

    // Pengambilan Absen
    $('#ambilFoto').click(function(e) {
        e.preventDefault();
        Webcam.snap(function(data_uri) {
            image = data_uri;
            view = document.getElementById('view').innerHTML =
                '<img src="' + data_uri + '"/>';
        });

        let lokasi = $('#lokasi').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url('pegawai/absensi/insertOut') ?>",
            data: {
                image: image,
                lokasi: lokasi
            },
            dataType: "json",
            beforeSend: function() {
                $('.ambilFoto').attr('disable', 'disabled');
                $('.ambilFoto').html('<i class="fa fa-spin fa-spinner text-center"></i>');
            },
            complete: function() {
                $('.ambilFoto').html('Absen');
            },
            success: function(response) {
                if (response.error) {
                    // lokasi tidak ditemukan
                    if (response.error.lokasi.lokasi) {
                        $(document).Toasts('create', {
                            class: 'bg-maroon',
                            title: 'Gagal!',
                            subtitle: '',
                            body: response.error.lokasi.lokasi
                        })
                        // reload halaman
                        setTimeout(function() {
                            window.location.href = "<?= base_url('pegawai/absensi'); ?>";
                        }, 5000);
                    }
                } else {
                    if (response.responsez == "success") {

                        // notification
                        notification.play();

                        // alert sukses
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            text: 'Akses Diterima, Terimakasih',
                            showConfirmButton: false,
                            footer: '<a href="<?= base_url('pegawai/absensi') ?>" class="btn btn-success">Oke</a>'
                        })

                        // reload halaman
                        setTimeout(function() {
                            window.location.href = "<?= base_url('pegawai/absensi'); ?>";
                        }, 3000);
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    });
    </script>

    <?= $this->endSection(); ?>