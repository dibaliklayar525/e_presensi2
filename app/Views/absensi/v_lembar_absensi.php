<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    .leaflet-container {
        height: 400px;
        width: 600px;
        max-width: 100%;
        max-height: 100%;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="month">Bulan</label>
                    <select class="form-control" name="month" id="month">
                        <option value="">pilih bulan</option>
                        <?php foreach ($month as $k => $val) : ?>
                            <option value="<?= $val->bulan ?>" name_alert="<?= $val->bulan ?>"><?= $val->bulan ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="years">Tahun</label>
                    <select class="form-control" name="years" id="years">
                        <option value="">pilih tahun</option>
                        <?php foreach ($years as $k => $val) : ?>
                            <option value="<?= $val->tahun ?>" name_alert="<?= $val->tahun ?>"><?= $val->tahun ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lembaran Absensi</h3>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- modal detail -->

<div class="modal fade" id="showDetailAbsensi">
    <div class="modal-dialog modal-md">
        <div class="modal-content bg-indigo">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <span id="tglShow" class="form-control bg-indigo"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Absen Masuk</label>
                                    <span id="innShow" class="form-control bg-indigo"></span>
                                    <hr>
                                    <img src="" id="fotoShow" style="width:100px; align:center; border-radius: 5px;" class="card-img-top" alt="tidak_ada">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Absen Pulang</label>
                                    <span id="outShow" class="form-control bg-indigo"></span>
                                    <hr>
                                    <img src="" id="fotooutShow" style="width:100px; align:center; border-radius: 5px;" class="card-img-top" alt="tidak_ada">
                                </div>
                            </div>
                        </div>
                        <hr>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />

<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

<script>
    // detail
    $(document).ready(function() {
        $(document).on("click", "#btn-detail", function() {
            let id1 = $(this).attr("id1");
            let tgl = $(this).attr("tgl");
            let inn = $(this).attr("inn");
            let out = $(this).attr("out");
            let foto = $(this).data("foto");
            let fotoout = $(this).data("fotoout");

            $("#fotoShow").attr("src", `${foto}`);
            $("#fotooutShow").attr("src", `${fotoout}`);
            $("#id1Show").text(id1);
            $("#tglShow").text(tgl);
            $("#innShow").text(inn);
            $("#outShow").text(out);
        });

    });

    let dTable;
    dTable = $('#dTable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "lengthChange": true,
        "ordering": true,
        "searching": true,
        "autoWidth": false,
        "info": true,
        "order": [],

        "ajax": {
            "url": "<?= base_url('pegawai/absensi/dataTables'); ?>",
            "type": "POST",
            "data": function(data) {
                data.tahun = $("#years").val();
                data.bulan = $("#month").val();
                // data.id_kategori = $("option:selected", "#kategori").attr("idd");
            }
        },

        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }],

        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4],
            "className": 'text-center',
        }],

        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        "bPaginate": true,
        "sPaginationType": "full_numbers",

        "dom": 'Blfrtip',
        "language": {
            "url": 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
        }
    });

    function tahun() {
        $('#years').change(function() {
            dTable.draw();
        });
    }
    tahun();

    function bulan() {
        $('#month').change(function() {
            dTable.draw();
        });
    }
    bulan();
</script>

<?= $this->endSection() ?>