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
                        <a href="<?= base_url('admin/user/add') ?>"
                            class="btn btn-primary btn-round btn-sm waves-effect waves-light"><i class="ti-user"></i>
                            Tambah User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>Avatar</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($user as $value) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++ ?></th>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['role_name'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><img src="<?= base_url('assets/images') ?>/<?= $value['avatar'] ?>"
                                                class="img-radius" alt="<?= $value['avatar'] ?>" width="50">
                                        </td>
                                        <td><a href="<?= base_url('admin/user/edit') ?>/<?= encrypt_url($value['id_user']) ?>"
                                                target="_blank" rel="noopener noreferrer"
                                                class="btn btn-warning btn-round btn-sm">Edit</a>

                                            <a href="#" class="btn btn-danger btn-round btn-sm">Hapus</a>
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
</section>


<?= $this->endSection() ?>