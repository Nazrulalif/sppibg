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

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border-color: #006fe6;
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
    }

</style>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="content-wrapper" style="margin-left:0">

        <section class="content">
            <div class="container">
                <div class="row" style="justify-content: center; padding-top:20px">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card" id="mesyuarat-card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Yuran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.yuran-simpan') }}" id="form-yuran" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="year">Tahun Kutipan</label>
                                                @if($errors->has('year'))
                                                    <div class="alert alert-danger alert-dismissible">
                                                        {{ $errors->first('year') }}
                                                    </div>
                                                @endif
                                                <input class="form-control" type="number" name="year" id="year"
                                                    required><br>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pibg_fee">Yuran (per keluarga) (RM)</label>
                                                @if($errors->has('pibg_fee'))
                                                    <div class="alert alert-danger alert-dismissible">
                                                        {{ $errors->first('pibg_fee') }}
                                                    </div>
                                                @endif
                                                <input class="form-control" type="number" name="pibg_fee" id="pibg_fee"
                                                    required><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header pl-0">
                                        <h3 class="card-title">Yuran Tambahan</h3>
                                    </div><br>
                                    <div class="row">

                                    @foreach($tahun as $grade)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ $grade->nama_tahun }} (RM)</label>
                                                <input type="number" class="form-control"
                                                    name="grade_fees[{{ $grade->id }}]" id="grade_{{ $grade->id }}_fee"
                                                    required><br>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>

                                <button type="submit" name="submit"
                                class="btn btn-primary float-right ml-1">Simpan</button>
                                </div>


                            </form>

                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>
    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}} "></script>
    <!-- jQuery -->
    {{-- <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}} "></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })


        })

    </script>



</body>

</html>
