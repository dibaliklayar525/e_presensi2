<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>
<?= var_dump($user); ?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="ti-user"></i> Akun</h5>
                        <!-- <span>Beberapa data berikut tidak dapat diubah kecuali oleh Administrator.</span> -->
                    </div>
                    <div class="card-body">

                        <?php $attributes = ['class' => '', 'id' => 'myform']; ?>
                        <?= form_open('admin/user/update', $attributes) ?>

                        <input type="text" name="id" id="id" class="form-control" required=""
                            value="<?= $user['id_user'] ?>" readonly>

                        <div class="form-group form-default">
                            <label class="">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control">
                                <?php foreach ($jabatan as $value) : ?>
                                <option value="<?= $value['id_jabatan'] ?>"
                                    <?= $user['id_jabatan'] == $value['id_jabatan'] ? 'selected' : '' ?>>
                                    <?= $value['nama_jabatan'] ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group form-default">
                            <label class="">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih akses (role)</option>
                                <?php foreach ($level as $value) : ?>
                                <option value="<?= $value['id_role'] ?>"
                                    <?= $user['role'] == $value['id_role'] ? 'selected' : '' ?>>
                                    <?= $value['role_name'] ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group form-default">
                            <label class="">Status Aktif</label>
                            <select name="is_active" id="is_active" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1" <?= $user['is_active'] == "1" ? 'selected' : '' ?>>
                                    Aktif</option>
                                <option value="0" <?= $user['is_active'] == "1" ? '' : 'selected' ?>>
                                    Tidak Aktif</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary updateJustAdmin" name="updateJustAdmin"
                            id="updateJustAdmin">Submit</button>
                    </div>

                    <?= form_close() ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="ti-user"></i> Profil</h5>
                        <span>Beberapa data berikut dapat diubah melalui menu profil.</span>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6 text-center">
                            <div class="form-group form-default">
                                <img src="<?= base_url('assets/images') . '/' . $user['avatar'] ?>"
                                    alt="<?= $user['avatar'] ?>" class="img-80 img-radius mCS_img_loaded">
                            </div>
                        </div>

                        <div class="form-group form-default">
                            <label class="float-label">Nama</label>
                            <input class="form-control" readonly value="<?= $user['name'] ?>">
                        </div>
                        <div class="form-group form-default">
                            <label class="float-label">Email (exa@gmail.com)</label>
                            <input class="form-control" readonly value="<?= $user['email'] ?>">
                        </div>
                        <div class="form-group form-default">
                            <label class="float-label">Ponsel</label>
                            <input class="form-control" readonly="" value="<?= $user['phone_no'] ?>">
                        </div>
                        <div class="form-group form-default">
                            <label class="float-label">NIP</label>
                            <input class="form-control disabled" readonly="" value="<?= $user['NIP'] ?>">
                        </div>
                        <div class="form-group form-default">
                            <label class="float-label">NIK</label>
                            <input class="form-control" readonly="" value="<?= $user['NIK'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>