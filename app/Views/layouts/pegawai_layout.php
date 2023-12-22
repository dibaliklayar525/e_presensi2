<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="shorcut icon" href="<?= base_url('img') ?>/logo/codeigniter-logo.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- toastr -->
    <link href="<?= base_url('adminLTE3') ?>/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
    <!-- jquery -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- toastr js -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/toastr/toastr.min.js"></script>
    <!-- data-tables css -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <!-- data-tables js -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <!-- Datepicker doc: https://gijgo.com/datepicker/configuration/maxDate -->
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert 2 -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/plugins/sweetalert2/dist/sweetalert2.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/dist/css/adminlte.min.css">
    <!-- Webcam -->
    <script src="<?= base_url('adminLTE3/plugins/webcamjs/1.0.26-webcam-js.js') ?>"></script>
    <!-- leaflet -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3/plugins/leaflet/leaflet.css') ?>" />
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" /> -->
    <script src="<?= base_url('adminLTE3/plugins/leaflet/leaflet.js') ?>"></script>
    <!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> -->
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md" id="dark-nav">
            <div class="container">
                <a href="<?= base_url('/') ?>" class="navbar-brand">
                    <?= CodeIgniter\CodeIgniter::APP_NAME ?>
                    <span class="brand-text font-weight-light"></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">

                        <?php
                        if (session()->get('id_user') == 1) { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('admin') ?>" class="nav-link">Dashboard</a>
                            </li>
                        <?php    } else { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('pegawai') ?>" class="nav-link">Dashboard</a>
                            </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a href="<?= base_url('pegawai/absensi') ?>" class="nav-link"><b><?= m1() ?></b></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-cog"></i> </a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                                <!-- Dark Mode -->
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <label for="">
                                            <input type="checkbox" name="ChangeTheme" id="ChangeTheme"> Dark Mode
                                        </label>
                                    </a>
                                </li>

                                <li class="dropdown-divider"></li>

                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Pengaturan</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li class="nav-item">
                                            <a href="<?= base_url('pegawai/profil') ?>" class="nav-link">Profil</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                    <!-- Notifications Dropdown Menu -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li> -->

                    <!-- user menu -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_url('/img/avatar/' . session()->get('avatar') . '') ?>" class="user-image img-circle elevation-2" alt=" <?php echo session()->get('avatar'); ?>">
                            <span class="d-none d-md-inline"><?php session()->get('name'); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-dark">
                                <img src="<?= base_url('img/avatar') ?>/<?php echo session()->get('avatar'); ?>" class="img-circle elevation-2" alt=" <?php echo session()->get('avatar'); ?>">

                                <p>
                                    <?php echo session()->get('name'); ?>
                                    <small>bergabung pada <?= tglIndo(session()->get('created_at')) ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="#"> <?= session()->get('nama_jabatan'); ?></a>
                                    </div>
                                    <div class="col-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                </div>
                            </li>

                            <li class="user-footer">
                                <a href="<?= base_url('pegawai/profil') ?>" class="btn btn-default btn-flat">Profile</a>
                                <a href="<?= base_url('logout') ?>" class="btn btn-default btn-flat float-right">Sign
                                    out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- CONTENT DISINI -->
        <?= $this->renderSection('content'); ?>

        <!-- Main Footer -->
        <footer class="ayout-footer-fixed main-footer">
            <div class="float-right d-none d-sm-inline">
                Version: <?= CodeIgniter\CodeIgniter::APP_VERSION ?> <?= ENVIRONMENT ?> | Codeigniter
                <?= CodeIgniter\CodeIgniter::CI_VERSION ?> | PHP Version <?= PHP_VERSION; ?>
            </div>
            <strong>Copyright &copy; 2023 - <?= date('Y') ?> <a href="<?= base_url() ?>"><?= CodeIgniter\CodeIgniter::APP_NAME ?></a>.
                <span><?= CodeIgniter\CodeIgniter::APP_LONG_NAME ?></span></strong>
            Development by
            <?= CodeIgniter\CodeIgniter::DEV_BY ?>

        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('adminLTE3') ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('adminLTE3') ?>/dist/js/demo.js"></script>
    <script>
        // check internet aktif
        window.addEventListener('load', function() {

            function updateOnlineStatus(event) {
                let condition;
                let status = navigator.onLine ? "online" : "offline";
                if (condition = navigator.onLine) {
                    Swal.fire(
                        `${status} `,
                        `Kembali online`,
                        'success'
                    )
                } else {
                    Swal.fire(
                        `${status} `,
                        `Tidak ada jaringan internet`,
                        'question'
                    )
                }

            }

            window.addEventListener('online', updateOnlineStatus);
            window.addEventListener('offline', updateOnlineStatus);
        });

        // dark mode
        let checkbox = document.getElementById("ChangeTheme");
        if (sessionStorage.getItem("mode") == "dark") {
            darkmode();
        } else {
            nodark();
        }
        checkbox.addEventListener("change", function() {
            if (checkbox.checked) {
                darkmode();
            } else {
                nodark();
            }
        });

        function darkmode() {
            document.body.classList.add("dark-mode");
            document.getElementById("dark-nav").classList.add("navbar-dark");
            checkbox.checked = true;
            sessionStorage.setItem("mode", "dark");
        }

        function nodark() {
            document.body.classList.remove("dark-mode");
            document.getElementById("dark-nav").classList.add("navbar-light");
            document.getElementById("dark-nav").classList.remove("navbar-dark");
            checkbox.checked = false;
            sessionStorage.setItem("mode",
                "light");
        }
    </script>
</body>

</html>