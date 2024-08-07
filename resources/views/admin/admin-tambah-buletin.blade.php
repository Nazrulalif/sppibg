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
    <!-- summernote -->
    <link rel="stylesheet" href=" {{asset('plugins/summernote/summernote-bs4.min.css')}} ">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{asset('plugins/dropzone/min/dropzone.min.css')}}">

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="content-wrapper" style="margin-left:0">

        <section class="content">
            <div class="container">
                <div class="row" style="justify-content: center; padding-top:20px">
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Buletin</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route("admin.buletin-simpan")}}" id="buletin-form" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">

                                        <label for="name">Tajuk</label>
                                        @if($errors->has('file'))
                                        <div class="alert alert-danger alert-dismissible">
                                            {{ $errors->first('buletin_name') }}
                                        </div>
                                        @endif
                                        <input type="text" name="buletin_name" class="form-control" id="">

                                    </div>
                                    <div class="form-group">
                                        <label for="name">Penerangan</label>
                                        @if($errors->has('file'))
                                        <div class="alert alert-danger alert-dismissible">
                                            {{ $errors->first('penerangan') }}
                                        </div>
                                        @endif
                                        <input type="text" name="penerangan" class="form-control" id="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Fail</label>
                                        @if($errors->has('file'))
                                        <div class="alert alert-danger alert-dismissible">
                                            {{ $errors->first('file') }}
                                        </div>
                                        @endif
                                        <div class="input-group">

                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Pilih
                                                    Fail</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Muat Naik</span>
                                            </div>

                                        </div>
                                    </div>

                                    <button type="submit" name="submit" value="2"
                                        class="btn btn-primary float-right ml-1">Simpan</button>
                                    <button type="submit" name="submit" class="btn btn-light float-right ml-1"
                                        value="1">Draf</button>
                                    {{-- <a type="button" onclick="window.close();"
                                        class="btn btn-secondary float-right">Tutup</a> --}}
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

        </section>
    </div>

    <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}} "></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script> --}}
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
    <!-- bs-custom-file-input -->
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}} "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // document.getElementById('buletin-form').addEventListener('submit', function (e) {
        //     e.preventDefault(); // Prevent the form from submitting

        //     Swal.fire({
        //         title: 'Adakah anda pasti?',
        //         text: 'Anda akan mengemas kini profil',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#28a745',
        //         cancelButtonColor: '#dc3545',
        //         confirmButtonText: 'Ya, pasti',
        //         cancelButtonText: 'Batal',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             // If the user confirms, submit the form
        //             this.submit();
        //         }
        //     });
        // });

    </script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });

    </script>


</body>

</html>
