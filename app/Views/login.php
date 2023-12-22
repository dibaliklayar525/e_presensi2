<?= $this->extend("layouts/auth") ?>

<?= $this->section("login") ?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-dark">
        <div class="card-header text-center">
            <a href="<?= base_url('/') ?>" class="h1"><b><?= CodeIgniter\CodeIgniter::APP_NAME ?></b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg"> <?= CodeIgniter\CodeIgniter::APP_LONG_NAME ?></p>

            <?php echo form_open(base_url('login')) ?>

            <?php if (isset($validation)) : ?>
                <div class="col-12">
                    <div class="alert alert-danger text-center" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="input-group mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-eye" id="eye"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-dark btn-block">Log In</button>
                </div>
                <!-- /.col -->
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<script>
    // password show
    const passwordInput = document.querySelector("#password")
    const eye = document.querySelector("#eye")
    eye.addEventListener("click", function() {
        this.classList.toggle("fa-eye-slash")
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
        passwordInput.setAttribute("type", type)
    })
</script>

<?= $this->endSection() ?>