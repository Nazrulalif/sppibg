<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href=" {{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}} ">
    <!-- iCheck -->
    <link rel="stylesheet" href=" {{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}} ">
    <!-- JQVMap -->
    <link rel="stylesheet" href=" {{asset('plugins/jqvmap/jqvmap.min.css')}} ">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{asset('dist/css/adminlte.min.css')}} ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}} ">
    <!-- Daterange picker -->
    <link rel="stylesheet" href=" {{asset('plugins/daterangepicker/daterangepicker.css')}} ">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>
<style>
    /* Hide the radio buttons */
    input[type="radio"] {
        display: none;
    }

    /* Style the color squares */
    .fc-color-picker li {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
    }

    .fc-color-picker li i {
        width: 32.5px;
        height: 33px;
        display: inline-block;
        border-radius: 3px;
    }

    /* Highlight the selected color */
    input[type="radio"]:checked+label i {
        border: 3px solid #5c6667;
    }

</style>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="content-wrapper" style="margin-left:0">

        <section class="content">
            <div class="container">
                <div class="row" style="justify-content: center; padding-top:20px">
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card" id="mesyuarat-card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Sumbangan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('admin.sumbangan-simpan')}}" id="form-mesyuarat" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Nama Sumbangan</label>
                                        <input type="text" name="nama" class="form-control" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Jumlah Sasaran (RM)</label>
                                        <input type="number" name="sasaran" class="form-control" id="">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Penerangan</label>
                                        <textarea name="penerangan" class="form-control" id="" cols="30"
                                            rows="5"></textarea>
                                    </div>
                                    <button type="submit" name="submit"
                                        class="btn btn-success float-right ml-1">Simpan</button>
                                    <a type="button" onclick="window.close();"
                                        class="btn btn-secondary float-right">Tutup</a>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}} "></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}} "></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}} "></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}} "></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}} "></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}} "></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}} "></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}} "></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}} "></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}} "></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}} "></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}} "></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}} "></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/js/pages/dashboard.js')}} "></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

</body>

</html>
