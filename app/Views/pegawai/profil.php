<?= $this->extend("layouts/pegawai_layout") ?>

<?= $this->section("content") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<style media="screen">
    .edit_profil {
        display: none;
    }

    /* change profil picture */
    .upload {
        width: 140px;
        position: relative;
        margin: auto;
        text-align: center;
    }

    .upload img {
        border-radius: 50%;
        border: 8px solid #DCDCDC;
        width: 125px;
        height: 125px;
    }

    .upload .right {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #00B4ff;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .upload .left {
        position: absolute;
        bottom: 0;
        left: 0;
        background: red;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .upload input {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    .upload input::-webkit-file-upload-button,
    .upload input[type=submit] {
        cursor: pointer;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <?= $title ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">

            <div class="row">

                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <!-- profil picture -->
                            <form method="post" enctype="multipart/form-data">
                                <div class="upload">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="<?= base_url('img/avatar') . '/' . $ava['avatar'] ?>" alt="User profile" id="image">

                                    </div>
                                    <div class="right" id="upload">
                                        <input type="file" name="fileImg" id="fileImg" class="form-control" accept="image/jpeg, image/png, image/jpg">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                    <div class="left" id="cancel" style="display: none;">
                                        <i class="fa fa-times"></i>
                                    </div>
                                    <div class="right" id="confirm" style="display: none;">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                            </form>

                            <form method="post" accept-charset="utf-8">

                                <h3 class="profile-username text-center"><?= $ava['name'] ?></h3>

                                <div class="form-group form-default">
                                    <label class="float-label">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?= $ava['name'] ?>">
                                    <input type="hidden" name="id_user" id="id_user" class="form-control" value="<?= $ava['id_user'] ?>">
                                </div>
                                <div class="form-group form-default">
                                    <label class="float-label">Ponsel</label>
                                    <input type="text" name="phone_no" id="phone_no" class="form-control" value="<?= $ava['phone_no'] ?>">

                                </div>
                                <div class="form-group form-default">
                                    <label class="float-label">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control disabled" value="<?= $ava['NIP'] ?>">

                                </div>
                                <div class="form-group form-default">
                                    <label class="float-label">NIK</label>
                                    <?php
                                    if (empty($ava['NIK'])) { ?>
                                        <input type="text" name="nik" id="nik" class="form-control">
                                    <?php  } else { ?>
                                        <input type="text" name="nik" id="nik" class="form-control" value="<?= $ava['NIK'] ?>" disabled>
                                    <?php }
                                    ?>
                                </div>

                                <div class="form-group form-default">
                                    <label>Jabatan</label>
                                    <select disabled class="form-control">
                                        <?php foreach ($jabatan as $value) : ?>
                                            <option value="<?= $value['id_jabatan'] ?>" <?= session()->get('id_jabatan') == $value['id_jabatan'] ? 'selected' : '' ?>>
                                                <?= $value['nama_jabatan'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group form-default">
                                    <label class="">Role</label>
                                    <select disabled class="form-control">
                                        <option value="">Role</option>
                                        <?php foreach ($level as $value) : ?>
                                            <option value="<?= $value['id_role'] ?>" <?= session()->get('role') == $value['id_role'] ? 'selected' : '' ?>>
                                                <?= $value['role_name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group form-default">
                                    <label>Dibuat</label>
                                    <input type="text" class="form-control" value="<?= tglIndo(session()->get('created_at')) ?>" disabled="">
                                </div>
                                <div class="form-group form-default">
                                    <label class="">Status Aktif</label>
                                    <select disabled class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="1" <?= session()->get('is_active') == "1" ? 'selected' : '' ?>>
                                            Aktif</option>
                                        <option value="0" <?= session()->get('is_active') == "1" ? '' : 'selected' ?>>
                                            Tidak Aktif</option>
                                    </select>
                                </div>

                                <button type="button" class="btn btn-default" name="edit" id="edit">
                                    Ubah cepat</button>
                                <button type="submit" class="btn btn-primary edit_profil" name="update" id="update">Submit</button>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </div>
    <script>
        // view change picture
        document.getElementById("fileImg").onchange = function() {
            document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]);

            document.getElementById("cancel").style.display = "block";
            document.getElementById("confirm").style.display = "block";
            document.getElementById("upload").style.display = "none";
        }

        let userImage = document.getElementById("image").src;
        document.getElementById("cancel").onclick = function() {
            document.getElementById("image").src = userImage;
            document.getElementById("cancel").style.display = "none";
            document.getElementById("confirm").style.display = "none";
            document.getElementById("upload").style.display = "block";
        }
        // update change picture
        $(document).on("click", "#confirm", function(e) {
            e.preventDefault();
            let id_user = $("#id_user").val();
            let fileImg = $("#fileImg")[0].files[0];

            let fd = new FormData();
            fd.append("id_user", id_user);
            fd.append("fileImg", fileImg);

            $.ajax({
                type: "post",
                url: "<?= base_url('pegawai/profil/updateImg'); ?>",
                data: fd,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.fileImg.fileImg) {
                            $(document).Toasts('create', {
                                class: 'bg-maroon',
                                title: 'Alert!',
                                subtitle: '',
                                body: response.error.fileImg.fileImg
                            })
                        } else {

                        }
                    } else {
                        if (response.responsez == "success") {
                            toastr.success(response.message)
                        } else {
                            toastr.error(response.message);
                        }
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });



        // update profil

        // show button edit
        $(document).on("click", "#edit", function() {
            $(".edit_profil").show();
            $("#edit").hide();
        });

        // update profil
        $(document).on("click", "#update", function(e) {
            e.preventDefault();

            let name = $("#name").val();
            let phone_no = $("#phone_no").val();
            let nik = $("#nik").val();
            let nip = $("#nip").val();

            $.ajax({
                type: "post",
                url: "<?= base_url('pegawai/profil/update'); ?>",
                data: {
                    name: name,
                    phone_no: phone_no,
                    nik: nik,
                    nip: nip
                },
                dataType: "json",
                beforeSend: function() {
                    $('.edit_profil').attr('disable', 'disabled');
                    $('.edit_profil').html('<i class="fa fa-spin fa-spinner text-center"></i>');
                },
                complete: function() {
                    $('.edit_profil').html('submit');

                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.name.name) {
                            $(document).Toasts('create', {
                                class: 'bg-maroon',
                                title: 'Alert!',
                                subtitle: '',
                                body: response.error.name.name
                            })
                        }
                        if (response.error.phone_no.phone_no) {
                            $(document).Toasts('create', {
                                class: 'bg-maroon',
                                title: 'Alert!',
                                subtitle: '',
                                body: response.error.phone_no.phone_no
                            })
                        }
                        if (response.error.nik.nik) {
                            $(document).Toasts('create', {
                                class: 'bg-maroon',
                                title: 'Alert!',
                                subtitle: '',
                                body: response.error.nik.nik
                            })
                        }
                        if (response.error.nip.nip) {
                            $(document).Toasts('create', {
                                class: 'bg-maroon',
                                title: 'Alert!',
                                subtitle: '',
                                body: response.error.nip.nip
                            })
                        }
                    } else {
                        if (response.responsez == "success") {
                            toastr.success(response.message)
                        } else {
                            toastr.error(response.message);
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

        });
    </script>


    <?= $this->endSection() ?>