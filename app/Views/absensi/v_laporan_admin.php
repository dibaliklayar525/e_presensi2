<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <div class="form-group">
                        <label for="">tanggal mulai</label>
                        <input type="text" class="form-control tgl_awal" id="tgl_awal" name="tgl_awal">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label for="">tanggal akhir</label>
                        <input type="text" class="form-control tgl_akhir" id="tgl_akhir" name="tgl_akhir">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-outline-secondary bg-pink spinner" onclick="viewLaporan()" id="lihat"><i
                            class="fa fa-search mr-1"></i>Lihat</button>
                </div>
            </div>
        </div>
        <hr>

        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Laporan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="laporan" id="laporan"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// date picker
$('.tgl_awal').datepicker({
    // format: 'yyyy-mm-dd',
    format: 'dd-mm-yyyy',
    maxDate: new Date()
    // minDate: new Date()
});
// date picker
$('.tgl_akhir').datepicker({
    // format: 'yyyy-mm-dd',
    format: 'dd-mm-yyyy',
    // maxDate: new Date()
    // minDate: new Date()
});

function alertLap(title, derscription) {
    Swal.fire(
        title,
        derscription,
        'question'
    )
}

function viewLaporan() {
    let tgl_awal = $("#tgl_awal").val();
    let tgl_akhir = $("#tgl_akhir").val();
    if (tgl_awal == "") {
        alertLap('Pilih bulan?', 'bulan belum dipilih.');
    } else if (tgl_akhir == "") {
        alertLap('Pilih tahun?', 'tahun belum dipilih.');
    } else {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/absensi/dataLapPegawai') ?>",
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

<?= $this->endSection() ?>