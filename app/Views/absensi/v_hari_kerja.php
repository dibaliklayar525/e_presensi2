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
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <label for=""><?= $title; ?></label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">tanggal mulai</label>
                                            <input type="text" class="form-control tgl_awall" id="tgl_awall"
                                                name="tgl_awal">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">tanggal akhir</label>
                                            <input type="text" class="form-control tgl_akhirr" id="tgl_akhirr"
                                                name="tgl_akhir">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" onclick="viewLaporan()" id="lihat"> <i
                                    class="fas fa-eye"></i> Lihat</button>
                        </div>
                    </div>
                    <div class="laporan" id="laporan"></div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content -->

    <script>
    // date picker
    $('.tgl_awall').datepicker({
        format: 'dd-mm-yyyy',
        // maxDate: new Date()
        // minDate: new Date()
    });
    // date picker
    $('.tgl_akhirr').datepicker({
        format: 'dd-mm-yyyy',
        // maxDate: new Date()
        // minDate: new Date()
    });

    function viewLaporan() {
        let tgl_awal = $("#tgl_awall").val();
        let tgl_akhir = $("#tgl_akhirr").val();
        if (tgl_awal == "") {
            alertLap('Pilih bulan?', 'bulan belum dipilih.');
        } else if (tgl_akhir == "") {
            alertLap('Pilih tahun?', 'tahun belum dipilih.');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('pegawai/absensi/dataHariKerja') ?>",
                data: {
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir
                },
                dataType: "json",
                beforeSend: function() {
                    $('.spinner').attr('disable', 'disabled');
                    $('.spinner').html('<i class="fa fa-spin fa-spinner text-center"></i>');
                },
                complete: function() {
                    $('.spinner').html('<i class="fa fa-search mr-1"></i> Lihat');
                },
                success: function(response) {
                    if (response.data) {
                        $('.laporan').html(response.data);
                    } else {
                        $('.laporan').html('<span class="text-center">Data tidak ditemukan</span>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }
    }
    </script>

    <?= $this->endSection(); ?>