<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Library</title>

    <link rel="stylesheet" href="{{ asset('css') }}/reset.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars - Sidebar -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- jsGrid -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/jsgrid/jsgrid.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/jsgrid/jsgrid-theme.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        {{-- Nav --}}
        @include('admin.includes.nav')
        {{-- Sidebar --}}
        @include('admin.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Fixed Layout</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Fixed Layout</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                {{-- Content --}}
                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.4
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
</body>

<!-- jQuery -->
<script src="{{ asset('adminlte-v3') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte-v3') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars - Sidebar -->
<script src="{{ asset('adminlte-v3') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- jsGrid -->
<script src="{{ asset('adminlte-v3') }}/plugins/jsgrid/demos/db.js"></script>
<script src="{{ asset('adminlte-v3') }}/plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte-v3') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte-v3') }}/dist/js/demo.js"></script>

@stack('js')

</html>
