<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Phone</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
                                        <th>Avatar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($user as $value) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?php echo session()->get('name') == $value['name'] ? "<span style='color:green;'>Ini anda</span>" : $value['name'] ?>
                                            </td>
                                            <td><?= $value['phone_no'] ?></td>
                                            <td><?= $value['NIP'] ?></td>
                                            <td><?= $value['nama_jabatan'] ?></td>
                                            <td><img src="<?= base_url('assets/images') ?>/<?= $value['avatar'] ?>" class="img-radius" alt="<?= $value['avatar'] ?>" width="50">
                                            </td>

                                            <td><?= $value['is_active'] ?></td>
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
</section>

<?= $this->endSection() ?>