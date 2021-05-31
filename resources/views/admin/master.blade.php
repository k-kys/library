<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="application/json" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Library</title>

    <link rel="stylesheet" href="{{ asset('css') }}/reset.css">

    <!-- Font Awesome 5.13.0 -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> --}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css"> --}}
    <!-- overlayScrollbars - Sidebar -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- jsGrid -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/jsgrid/jsgrid.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/jsgrid/jsgrid-theme.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/toastr/toastr.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte-v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/dist/css/adminlte.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    @stack('style')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var csrf_token = '{{ csrf_token() }}';
        var base_url = '{{ config("app.url") }}';
    </script>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
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
                            <h1>@yield('header')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                            class="fa fa-home"></i></a></li>
                                @yield('breadcrumb')
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
            <strong>Copyright &copy; {{ date('Y') }}
                <a href="http://khuong2k.blogspot.com" target="_blank">
                    Trần Quang Khương
                </a>.
            </strong>
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>
@routes()
@include('sweetalert::alert')
{{-- <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script> --}}

<!-- jQuery -->
<script src="{{ asset('adminlte-v3') }}/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte-v3') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars - Sidebar -->
<script src="{{ asset('adminlte-v3') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte-v3') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('adminlte-v3') }}/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('adminlte-v3/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- jsGrid -->
<script src="{{ asset('adminlte-v3') }}/plugins/jsgrid/demos/db.js"></script>
<script src="{{ asset('adminlte-v3') }}/plugins/jsgrid/jsgrid.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte-v3') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte-v3') }}/dist/js/demo.js"></script>
<!-- Summernote -->
<script src="{{ asset('adminlte-v3') }}/plugins/summernote/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
            $('.btn-delete').click(function(event) {
                let isDelete = confirm('Bạn có chắc chắn muốn xóa ?');
                if (!isDelete) {
                    event.preventDefault();
                }
                // Swal.fire({
                // title: 'Are you sure?',
                // text: "You won't be able to revert this!",
                // icon: 'warning',
                // showCancelButton: true,
                // confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                // confirmButtonText: 'Yes, delete it!',
                // cancelButtonText: 'No',
                // }).then((result) => {
                // if (result.isConfirmed) {
                //     event.preventDefault();
                // }
                // })
            });
        });
</script>
<script>
    $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
</script>

@stack('js')

</html>
