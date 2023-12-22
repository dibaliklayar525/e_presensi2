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

    <!-- Main content -->
    <div class="content">
        <div class="container">

            <div class="row">

                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            Anda sudah absen hari ini
                        </div>
                        <div class="card-body">

                            <h4 class="text-center"> <?= date('d-m-Y', strtotime($tanggal)) ?></h4>

                            <p class="bg-green text-center">Masuk: <?= $masuk ?></p>
                            <p class="bg-red text-center">Pulang: <?= $pulang ?></p>

                            <!-- audio -->
                            <audio id="notifikasi" autoplay>
                                <source src="<?= base_url('sound/Andasudahabsen.mp3') ?>" type="audio/mpeg">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->

    </div>

    <!-- /.content -->

    <?= $this->endSection(); ?>