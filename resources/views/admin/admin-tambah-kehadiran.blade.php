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
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border-color: #006fe6;
            color: #fff;
            padding: 0 10px;
            margin-top: .31rem;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="content-wrapper" style="margin-left:0">
        <section class="content">
            <div class="container">
                <div class="row" style="justify-content: center; padding-top:20px">
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card" id="mesyuarat-card">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Kehadiran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="{{route('admin.kehadiran-simpan')}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Pilih Mesyuarat</label>
                                        @if($errors->has('mesyuarat'))
                                                <div class="alert alert-danger alert-dismissible">
                                                    {{ $errors->first('mesyuarat') }}
                                                </div>
                                        @endif
                                        <select class="form-control" name="mesyuarat">
                                            <option>--Pilih--</option>
                                            @foreach ($mesyuarat as $item)
                                            @if (in_array($item->id, $existingIds))
                                            {{-- <option value="{{$item->id}}">exist</option> --}}
                                            @else
                                            <option value="{{$item->id}}">{{$item->nama_mesyuarat}}</option>
                                            @endif
                                            {{-- <option value="{{$item->id}}">{{$item->nama_mesyuarat}}</option> --}}

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Terlibat</label>
                                        @if($errors->has('kepada'))
                                                <div class="alert alert-danger alert-dismissible">
                                                    {{ $errors->first('kepada') }}
                                                </div>
                                        @endif
                                        <select class="select2" multiple="multiple" name="kepada[]"
                                            data-placeholder="Pilih" style="width: 100%;">
                                            @foreach ($role as $item)
                                            <option value="{{$item->id}}">{{$item->nama_akses}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" name="submit"
                                        class="btn btn-primary float-right ml-1">Simpan</button>
                                    
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
