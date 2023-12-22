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
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <!-- tombol absen dan selesai izin -->
                    <?= $btn_absen_and_izin; ?>
                    <?= $btn_izin; ?>

                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-default">Lainnya</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="<?= base_url('pegawai/absensi/lembar-absensi') ?>" class="dropdown-item">Lembar
                                Absensi</a>
                            <a href="<?= base_url('pegawai/absensi/hari-kerja') ?>" class="dropdown-item">Hari Kerja
                            </a>
                            <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Laporan</a> -->
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Box -->

            <div class="row">
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Absen</span>
                            <span class="info-box-number pull-right"><?= $dcount ?> </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Izin</span>
                            <span class="info-box-number pull-right"> <?= $dcount_izin; ?> </span>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-3 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-orange"><i class="fas fa-allergies"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sakit</span>
                            <span class="info-box-number">0 </span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-md-3 col-sm-3 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-dark"><i class="fas fa-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Terlambat</span>
                            <span class="info-box-number">0 </span>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="row">
                <div class="col-lg-6 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Masuk</h3>
                            <p><?= $masuk ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Pulang</h3>
                            <p><?= $pulang ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock-o"></i>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mt-4 mb-2">Absen</h5>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3"><?= session()->get('nama_user'); ?></h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Bulan
                                        ini</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Peringkat</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Masuk</th>
                                                        <th style="width: 40px">Pulang</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($history as $k) : ?>
                                                        <tr>
                                                            <td><?= tglIndo($k['tgl_absensi']) ?></td>
                                                            <td><span class="badge bg-success"><?= $k['absen_in'] ?></span>
                                                            <td><span class="badge bg-success">foto</span>
                                                            </td>
                                                            <td><span class="badge bg-danger"><?= $k['absen_out'] ? $k['absen_out'] : '--:--' ?></span>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_2">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>Absen</th>
                                                <th>Masuk</th>
                                                <th style="width: 40px">Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($karyawan as $k) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="post clearfix">
                                                            <div class="user-block">
                                                                <img class="img-circle img-bordered-sm" src="<?= base_url('img/avatar') ?>/<?= $k['avatar'] ?>" alt="<?= $k['avatar'] ?>">
                                                                <span class="username">
                                                                    <a href="#"><span> <?= $k['name'] ?></a>
                                                                </span>
                                                                <span class="description"><?= $k['name'] ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?= tglIndo($k['tgl_absensi']) ?></td>
                                                    <td>
                                                        <span class="badge bg-success"><?= $k['absen_in'] ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-danger"><?= $k['absen_out'] ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- data izin -->

            <h5 class="mt-4 mb-2">Izin</h5>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3"></h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_3" data-toggle="tab">Bulan
                                        ini</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Peringkat</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_3">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Keterangan</th>
                                                        <th style="width: 40px">permintaan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($izin as $k) : ?>
                                                        <tr>
                                                            <td><?= tglIndo($k['tgl_izin']) ?></td>
                                                            <td><span class="badge bg-success"><?= $k['name'] ?></span>
                                                            <td>
                                                                <?php $bgcolor = ''; // (a ? b : c) ? d : e` or `a ? b : (c ? d : e)
                                                                $k['id_acc'] == 1 ? $bgcolor = 'bg-warning' : ($k['id_acc'] == 2 ? $bgcolor = 'bg-success' : ($k['id_acc'] == 3 ? $bgcolor = '' : 'bg-danger')); ?>
                                                                <span class="badge <?= $bgcolor ?>"><?= $k['name_acc']; ?></span>
                                                            </td>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_4">
                                    Oke
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->

        <!-- Modal  -->
        <div class="modal fade" id="izin">
            <div class="modal-dialog modal-md">
                <div class="modal-content bg-warning">
                    <form action="">
                        <div class="modal-header">
                            <h5 class="modal-title">Izin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">User Id</label>
                                    <input type="text" class="form-control" name="id" id="id" value="<?= encrypt_url(session()->get('id_user')) ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" value="<?= session()->get('name') ?>" readonly>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Izin</label>
                                            <input type="text" class="form-control" id="tgl_izin" name="tgl_izin" width="270" value="<?= date('Y-m-d') ?>" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">s.d tanggal</label>
                                            <input type="text" class="form-control" id="tgls" name="tgls" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <select name="status_izin" id="status_izin" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php foreach ($status_izin as $val) : ?>
                                            <option value="<?= $val->id ?>" name_alert="<?= $val->name ?>"><?= $val->name ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="10" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-outline-light" name="insert" id="insert">ajukan
                                    izin</button>
                            </div>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <div id="" class="" id_u="<?= encrypt_url(session()->get('id_user')); ?>"></div>

    <script>
        // date picker
        $('#tgls').datepicker({
            format: 'yyyy-mm-dd',
            minDate: new Date()
        });

        // add izin
        $(document).ready(function() {
            $(document).on("click", "#insert", function(e) {
                e.preventDefault();

                let tgl_izin = $("#tgl_izin").val();
                let sd_tgl_izin = $("#tgls").val();
                let status_izin = $("option:selected", "#status_izin").val();
                let deskripsi = $("#deskripsi").val();
                let name_alert = $("option:selected", "#status_izin").attr("name_alert");

                Swal.fire({
                    title: "Pengajuan Izin" + " " + name_alert,
                    text: "anda mengajukan Izin " + name_alert + " " +
                        " ,Klik ok untuk segera diproses.",
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "<?= base_url('pegawai/izin/add'); ?>",
                            data: {
                                tgl_izin: tgl_izin,
                                sd_tgl_izin: sd_tgl_izin,
                                status_izin: status_izin,
                                deskripsi: deskripsi,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.error) {
                                    // lokasi tidak ditemukan
                                    if (data.error.tgl_izin.tgl_izin) {
                                        $(document).Toasts('create', {
                                            class: 'bg-maroon',
                                            title: 'Gagal!',
                                            subtitle: '',
                                            body: data.error.tgl_izin.tgl_izin
                                        })
                                    }
                                } else {
                                    if (data.response == "success") {
                                        Swal.fire(
                                            "Success",
                                            "Berhasil mengajukan " + name_alert,
                                            "success"
                                        );
                                    }
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }

                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                                    thrownError);
                            }
                        });
                    }
                });
            });
        });


        // update izin (masuk kembali);
        $(document).on("click", "#upd", function(e) {
            e.preventDefault();

            let id_u = $(this).attr("id_u");

            Swal.fire({
                title: "<?= session()->get('nama_user') ?> anda masuk hari ini?",
                text: "klik masuk kembali untuk melanjutkan",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, masuk kembali!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('pegawai/izin/upd'); ?>",
                        data: {
                            id_u: id_u,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.response == "success") {
                                Swal.fire(
                                    "Success",
                                    "Data telah diperbarui. ",
                                    "success"
                                );
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        });
    </script>


    <?= $this->endSection(); ?>