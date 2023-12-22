<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="ti-user"></i> Tambah User</h5>
                        <!-- <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
                    </div>
                    <div class="card-body">

                        <?php
                                $errors = session()->getFlashdata('errors');
                                if (!empty($errors)) {
                                    foreach ($errors as $key => $value) {
                                        echo $output = '
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>' . esc($value) . '
                                    </div>
                                    ';
                                    }
                                } ?>
                        <?php
                                if (session()->getFlashdata('pesan')) {
                                    echo $output =
                                        '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    ' . session()->getFlashdata('pesan') . '
                                    </div>
                                    ';
                                }
                                ?>
                        <?php $attributes = ['class' => 'form-material', 'id' => 'myform']; ?>
                        <?= form_open('admin/user/insert', $attributes) ?>
                        <div class="form-group form-default">
                            <input type="text" name="name" id="name" class="form-control" required="">
                            <span class="form-bar"></span>
                            <label class="float-label">Nama</label>
                        </div>
                        <div class="form-group form-default">
                            <input type="email" name="email" id="email" class="form-control" required="">
                            <span class="form-bar"></span>
                            <label class="float-label">Email (exa@gmail.com)</label>
                        </div>
                        <div class="form-group form-default">
                            <input type="password" name="password" id="password" class="form-control" required="">
                            <span class="form-bar"></span>
                            <label class="float-label">Password</label>
                        </div>
                        <div class="form-group form-default">
                            <input type="password" name="ulangi_password" id="ulangi_password" class="form-control"
                                required="">
                            <span class="form-bar"></span>
                            <label class="float-label">Ulangi Password</label>
                        </div>
                        <div class="form-group form-default">
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih akses (role)</option>
                                <?php foreach ($level as $value) : ?>
                                <option value="<?= $value['id_role'] ?>"><?= $value['role_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>