<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= $title; ?></title>

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
    </script>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE3') ?>/dist/css/adminlte.min.css">

    <style>
        /* style dark mode */
        @supports (-webkit-appearance: none) or (-moz-appearance: none) {
            .checkbox-wrapper-14 input[type=checkbox] {
                --active: #275EFE;
                --active-inner: #fff;
                --focus: 2px rgba(39, 94, 254, .3);
                --border: #BBC1E1;
                --border-hover: #275EFE;
                --background: #fff;
                --disabled: #F6F8FF;
                --disabled-inner: #E1E6F9;
                -webkit-appearance: none;
                -moz-appearance: none;
                height: 21px;
                outline: none;
                display: inline-block;
                vertical-align: top;
                position: relative;
                margin: 0;
                cursor: pointer;
                border: 1px solid var(--bc, var(--border));
                background: var(--b, var(--background));
                transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
            }

            .checkbox-wrapper-14 input[type=checkbox]:after {
                content: "";
                display: block;
                left: 0;
                top: 0;
                position: absolute;
                transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
            }

            .checkbox-wrapper-14 input[type=checkbox]:checked {
                --b: var(--active);
                --bc: var(--active);
                --d-o: .3s;
                --d-t: .6s;
                --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
            }

            .checkbox-wrapper-14 input[type=checkbox]:disabled {
                --b: var(--disabled);
                cursor: not-allowed;
                opacity: 0.9;
            }

            .checkbox-wrapper-14 input[type=checkbox]:disabled:checked {
                --b: var(--disabled-inner);
                --bc: var(--border);
            }

            .checkbox-wrapper-14 input[type=checkbox]:disabled+label {
                cursor: not-allowed;
            }

            .checkbox-wrapper-14 input[type=checkbox]:hover:not(:checked):not(:disabled) {
                --bc: var(--border-hover);
            }

            .checkbox-wrapper-14 input[type=checkbox]:focus {
                box-shadow: 0 0 0 var(--focus);
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch) {
                width: 21px;
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):after {
                opacity: var(--o, 0);
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):checked {
                --o: 1;
            }

            .checkbox-wrapper-14 input[type=checkbox]+label {
                display: inline-block;
                vertical-align: middle;
                cursor: pointer;
                margin-left: 4px;
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch) {
                border-radius: 7px;
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):after {
                width: 5px;
                height: 9px;
                border: 2px solid var(--active-inner);
                border-top: 0;
                border-left: 0;
                left: 7px;
                top: 4px;
                transform: rotate(var(--r, 20deg));
            }

            .checkbox-wrapper-14 input[type=checkbox]:not(.switch):checked {
                --r: 43deg;
            }

            .checkbox-wrapper-14 input[type=checkbox].switch {
                width: 38px;
                border-radius: 11px;
            }

            .checkbox-wrapper-14 input[type=checkbox].switch:after {
                left: 2px;
                top: 2px;
                border-radius: 50%;
                width: 17px;
                height: 17px;
                background: var(--ab, var(--border));
                transform: translateX(var(--x, 0));
            }

            .checkbox-wrapper-14 input[type=checkbox].switch:checked {
                --ab: var(--active-inner);
                --x: 17px;
            }

            .checkbox-wrapper-14 input[type=checkbox].switch:disabled:not(:checked):after {
                opacity: 0.6;
            }
        }

        .checkbox-wrapper-14 * {
            box-sizing: inherit;
        }

        .checkbox-wrapper-14 *:before,
        .checkbox-wrapper-14 *:after {
            box-sizing: inherit;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" id="dark-body">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url() ?>/img/logo/codeigniter-logo.png" alt="<?= CodeIgniter\CodeIgniter::APP_NAME ?>" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" id="navbar-atas">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('pegawai/absensi') ?>" class="nav-link"><?= m1() ?></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">
                            <div class="checkbox-wrapper-14">
                                <input type="checkbox" class="switch" name="ChangeTheme" id="ChangeTheme">
                                <label for="s1-14">Dark Mode</label>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('logout') ?>" class="dropdown-item dropdown-footer">
                            <i class="fas fa-sign-out-alt"></i> sign-out</a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-dark" id="navbar-kiri">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= base_url() ?>/img/logo/codeigniter-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= CodeIgniter\CodeIgniter::APP_NAME ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('img/avatar') . '/' . session()->get('avatar') ?>" class="img-circle elevation-2" alt="<?= session()->get('avatar') ?>">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('name') ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <?php
                            if (session()->get('role') == '2') { ?>
                                <a href="<?= base_url('pegawai') ?>" class="nav-link ' . <?= $menu ==  'dashboard' ? 'active' : ''  ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            <?php } else { ?>
                                <a href="<?= base_url('admin') ?>" class="nav-link <?= $menu ==  'dashboard' ? 'active' : ''  ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>

                            <?php  } ?>

                            <!-- Dashboard -->
                        </li>

                        <!-- presensi -->

                        <li class="nav-item <?= $menu == m1() ? 'menu-is-opening menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?= $menu == m1() ? 'active' : ''; ?>">
                                <i class="nav-icon 	far fa-calendar"></i>
                                <p>
                                    <?= m1() ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <?php if (session()->get('role') == '1') { ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url('admin/kinerja-pegawai'); ?>" class="nav-link  <?= $submenu == 'kinerja-pegawai' ? 'active' : ''; ?>">
                                            <i class="fas fa-chart-pie nav-icon"></i>
                                            <p>Kinerja</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('admin/laporan-pegawai'); ?>" class="nav-link  <?= $submenu == 'laporan-pegawai' ? 'active' : ''; ?>">
                                            <i class="fas fa-book nav-icon"></i>
                                            <p>Laporan Pegawai</p>
                                        </a>
                                    </li>
                                <?php } else {
                                    echo '';
                                } ?>

                                <li class="nav-item">
                                    <a href="<?= base_url('pegawai/absensi') ?>" class="nav-link">
                                        <i class="fas fa-bell nav-icon"></i>
                                        <p>Absensi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('pegawai/absensi/hari-kerja') ?>" class="nav-link">
                                        <i class="fas fa-calendar nav-icon"></i>
                                        <p>Hari Kerja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('pegawai/absensi/lembar-absensi') ?>" class="nav-link <?= $submenu == 'lembar-absensi' ? 'active' : ''; ?>">
                                        <i class="far fa-file-alt nav-icon"></i>
                                        <p>Lembar Absensi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('pegawai/absensi/laporan') ?>" class="nav-link <?= $submenu == 'laporan' ? 'active' : ''; ?>">
                                        <i class="far fa-file nav-icon"></i>
                                        <p>Laporan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- lainnya -->

                        <li class="nav-item <?= $menu == 'pegawai' ? 'menu-is-opening menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?= $menu == 'pegawai' ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-user-circle"></i>
                                <p>
                                    lainnya
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <?php if (session()->get('role') == '1') { ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url('admin/user'); ?>" class="nav-link  <?= $submenu == 'user' ? 'active' : ''; ?>">
                                            <i class="fas fa-user-friends nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                <?php } else {
                                    echo '';
                                } ?>

                                <li class="nav-item <?= $menu == 'pegawai' ? 'menu-is-opening menu-open' : ''; ?>">
                                    <a href="<?= base_url('pegawai/daftarp') ?>" class="nav-link <?= $submenu == 'daftar-pegawai' ? 'active' : ''; ?>">
                                        <i class="far fa-id-card nav-icon"></i>
                                        <p>Daftar Pegawai</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('pegawai/profil') ?>" class="nav-link <?= $submenu == 'profil' ? 'active' : ''; ?>">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                        <p>Profil</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('logout') ?>" class="nav-link">
                                        <i class="fas fa-circle nav-icon"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- update -->

                        <li class="nav-item">
                            <a href="<?= base_url('pegawai/info') ?>" class="nav-link <?= $menu ==  'info' ? 'active' : ''  ?>">
                                <i class="nav-icon fas fa-code"></i>
                                <p>
                                    Info
                                </p>
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <?= $this->renderSection("body") ?>

        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 - <?= date('Y') ?> <a href="<?= base_url() ?>"><?= CodeIgniter\CodeIgniter::APP_NAME ?></a>.</strong>
            <?= CodeIgniter\CodeIgniter::APP_LONG_NAME ?>.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version <?= CodeIgniter\CodeIgniter::APP_VERSION ?> | Development by
                    <?= CodeIgniter\CodeIgniter::DEV_BY ?></b>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('adminLTE3') ?>/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= base_url('adminLTE3') ?>/plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url('adminLTE3') ?>/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?= base_url('adminLTE3') ?>/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url('adminLTE3') ?>/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('adminLTE3') ?>/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url('adminLTE3') ?>/dist/js/pages/dashboard2.js"></script>

    <script>
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
            document.getElementById("dark-body").classList.add("dark-mode");
            document.getElementById("navbar-atas").classList.add("navbar-dark");
            document.getElementById("navbar-kiri").classList.add("sidebar-dark-white");
            document.getElementById("navbar-kiri").classList.remove("sidebar-light-dark");
            checkbox.checked = true;
            sessionStorage.setItem("mode", "dark");
        }

        function nodark() {
            document.body.classList.remove("dark-mode");
            document.getElementById("dark-body").classList.remove("dark-mode");
            document.getElementById("navbar-atas").classList.remove("navbar-dark");
            document.getElementById("navbar-kiri").classList.remove("sidebar-dark-white");
            document.getElementById("navbar-kiri").classList.add("sidebar-light-dark");
            checkbox.checked = false;
            sessionStorage.setItem("mode",
                "light");
        }
    </script>
</body>

</html>