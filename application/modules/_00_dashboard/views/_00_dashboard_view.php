<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Dashboard</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/plugins/summernote/summernote-bs4.min.css">
        <!-- pagination -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/pagination.css">
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="<?php echo base_url() ?>assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="<?php echo base_url() ?>assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    <img src="<?php echo base_url() ?>assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                    <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                    </button>
                    </div>
                    </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="<?php echo site_url() ?>" class="nav-link <?php echo ($this->uri->segment(1) == '' ? 'active' : ''); ?>">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                    DASHBOARD
                                    </p>
                                </a>
                            </li>

                            <!-- setup -->
                            <li class="nav-item
                                <?php
                                switch ($this->uri->segment(1)) {
                                    case 't01_talent':
                                        echo 'menu-open';
                                        break;
                                    default:
                                        echo '';
                                }
                                ?>
                            ">
                                <a href="#" class="nav-link
                                    <?php
                                    switch ($this->uri->segment(1)) {
                                        case 't01_talent':
                                            echo 'active';
                                            break;
                                        default:
                                            echo '';
                                    }
                                    ?>
                                ">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>
                                    SETUP
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo site_url() ?>t01_talent" class="nav-link <?php echo $this->uri->segment(1) == 't01_talent' ? 'active' : ''; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>TALENT</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- ./setup -->

                            <!-- input data -->
                            <li class="nav-item
                                <?php
                                switch ($this->uri->segment(1)) {
                                    case 't00_siswa':
                                    case 't30_absensi':
                                    case 't31_talent':
                                        echo 'menu-open';
                                        break;
                                    default:
                                        echo '';
                                }
                                ?>
                            ">
                                <a href="#" class="nav-link
                                    <?php
                                    switch ($this->uri->segment(1)) {
                                        case 't00_siswa':
                                        case 't30_absensi':
                                        case 't31_talent':
                                            echo 'active';
                                            break;
                                        default:
                                            echo '';
                                    }
                                    ?>
                                ">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>
                                    INPUT DATA
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item
                                        <?php
                                        switch ($this->uri->segment(1)) {
                                            case 't00_siswa':
                                            case 't30_absensi':
                                            case 't31_talent':
                                                echo 'menu-open';
                                                break;
                                            default:
                                                echo '';
                                        }
                                        ?>
                                    ">
                                        <a href="#" class="nav-link
                                            <?php
                                            switch ($this->uri->segment(1)) {
                                                case 't00_siswa':
                                                case 't30_absensi':
                                                case 't31_talent':
                                                    echo 'active';
                                                    break;
                                                default:
                                                    echo '';
                                            }
                                            ?>
                                        ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                            PESERTA DIDIK
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="<?php echo site_url() ?>t00_siswa" class="nav-link <?php echo $this->uri->segment(1) == 't00_siswa' ? 'active' : ''; ?>">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>DATA SISWA</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php echo site_url() ?>t30_absensi" class="nav-link <?php echo $this->uri->segment(1) == 't30_absensi' ? 'active' : ''; ?>">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>PERKEMBANGAN SISWA</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="<?php echo site_url() ?>t31_talent" class="nav-link <?php echo $this->uri->segment(1) == 't31_talent' ? 'active' : ''; ?>">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>TALENT'S DAY</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- ./input data -->

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"><?php echo $_caption ?></h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard v1</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <?php $this->load->view($_view); ?>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->

            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.1.0
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/moment/moment.min.js"></script>
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?php echo base_url() ?>assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/demo.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url() ?>assets/adminlte/dist/js/pages/dashboard.js"></script>

        <script type="text/javascript">
        $(function () {
            $('body').addClass('text-sm'); //$('body').addClass('text-xs');
            $('a').addClass('text-sm'); //$('a').addClass('text-xs');
            $('.btn').addClass('btn-sm'); //$('.btn').addClass('btn-xs');
            $('.table').addClass('table-sm');
            $('.form-control').addClass('form-control-sm');
            $('.input-group').addClass('input-group-sm');
            // $('.main-sidebar').removeClass('sidebar-dark-primary');
            // $('.main-sidebar').addClass('sidebar-light-lightblue text-sm'); //$('.main-sidebar').addClass('sidebar-light-lightblue text-xs');
            $('.nav').addClass('nav-child-indent nav-compact');
        })
        </script>
    </body>

</html>
