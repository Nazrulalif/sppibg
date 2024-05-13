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
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                                <h3 class="card-title">Tambah pengguna</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <!-- form start -->
                            <form id="profil" method="POST" action="{{route('admin.pengguna-simpan')}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body p-0">
                                    <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                            <!-- your steps here -->
                                            <div class="step" data-target="#logins-part">
                                                <a type="button" class="step-trigger" role="tab"
                                                    aria-controls="logins-part" id="logins-part-trigger">
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Maklumat Pengguna</span>
                                                </a>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#information-part">
                                                <a type="button" class="step-trigger" role="tab"
                                                    aria-controls="information-part" id="information-part-trigger">
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Maklumat Pelajar</span>
                                                </a>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#register-part">
                                                <a type="button" class="step-trigger" role="tab"
                                                    aria-controls="register-part" id="register-part-trigger">
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">Daftar</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content">
                                            <!-- your steps content here -->
                                            <div id="logins-part" class="content" role="tabpanel"
                                                aria-labelledby="logins-part-trigger">
                                                <div class="form-group">
                                                    <label for="name">Nama Penuh</label>
                                                    @if($errors->has('name'))
                                                    <div class="alert alert-danger alert-dismissible">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                    @endif
                                                    <input type="text" name="name" class="form-control" id="">
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Nombor Kad Pengenalan</label>
                                                            @if($errors->has('ic'))
                                                            <div class="alert alert-danger alert-dismissible">
                                                                {{ $errors->first('ic') }}
                                                            </div>
                                                            @endif
                                                            <input type="text" name="ic" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Nombor Telefon</label>
                                                            @if($errors->has('phone'))
                                                            <div class="alert alert-danger alert-dismissible">
                                                                {{ $errors->first('phone') }}
                                                            </div>
                                                            @endif
                                                            <input type="text" name="phone" class="form-control" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    @if($errors->has('address'))
                                                            <div class="alert alert-danger alert-dismissible">
                                                                {{ $errors->first('address') }}
                                                            </div>
                                                    @endif
                                                    <input type="text" name="address" class="form-control" id="">

                                                </div>
                                                <a class="btn btn-primary" onclick="stepper.next()">Seterusnya</a>
                                            </div>
                                            <div id="information-part" class="content" role="tabpanel"
                                                aria-labelledby="information-part-trigger">

                                                <div id="childrenFields">
                                                    <div class="child-fields row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="name">Nama Pelajar</label>
                                                                <input type="text" name="child[]" class="form-control"
                                                                    id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Tahun</label>
                                                                {{-- <input type="text" name="year[]" class="form-control"
                                                                    id=""> --}}
                                                                    <select name="year[]" class="form-control" id="">
                                                                        {{-- <option value="1">Tahun 1</option> --}}
                                                                        <option>--Pilih--</option>
                                                                        <option value="1">Tahun 1</option>
                                                                        <option value="2">Tahun 2</option>
                                                                        <option value="3">Tahun 3</option>
                                                                        <option value="4">Tahun 4</option>
                                                                        <option value="5">Tahun 5</option>
                                                                        <option value="6">Tahun 6</option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Kelas</label>
                                                                {{-- <input type="text" name="class[]" class="form-control"
                                                                    id=""> --}}
                                                                    <select name="class[]" class="form-control" id="">
                                                                        {{-- <option value="1">Tahun 1</option> --}}
                                                                        <option>--Pilih--</option>
                                                                        <option value="Bestari">Bestari</option>
                                                                        <option value="Gemilang">Gemilang</option>
                                                                        <option value="Cemerlang">Cemerlang</option>
                                                                       
                                                                    </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            id="addChild">
                                                            Tambah
                                                        </button><br>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('addChild').addEventListener('click',
                                                        function () {
                                                            const childrenFields = document.querySelector(
                                                                '#childrenFields');
                                                            const newChildField = document.createElement('div');
                                                            newChildField.classList.add('child-fields', 'row');

                                                            newChildField.innerHTML = `
                                                            <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="name">Nama Pelajar</label>
                                                                <input type="text" name="child[]" class="form-control"
                                                                    id="">
                                                            </div>
                                                        </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="child" class="form-label">Tahun</label>
                                                                    <select name="year[]" class="form-control" id="">
                                                                        
                                                                        <option>--Pilih--</option>
                                                                        <option value="1">Tahun 1</option>
                                                                        <option value="2">Tahun 2</option>
                                                                        <option value="3">Tahun 3</option>
                                                                        <option value="4">Tahun 4</option>
                                                                        <option value="5">Tahun 5</option>
                                                                        <option value="6">Tahun 6</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="class" class="form-label">Kelas</label>
                                                                    <select name="class[]" class="form-control" id="">
                                                                        <option>--Pilih--</option>
                                                                        <option value="Bestari">Bestari</option>
                                                                        <option value="Gemilang">Gemilang</option>
                                                                        <option value="Cemerlang">Cemerlang</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        `;

                                                            childrenFields.appendChild(newChildField);
                                                        });

                                                </script>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Hubungan</label>
                                                            <select class="form-control select2" name="hubungan"
                                                                style="width: 100%;">
                                                                <option selected="selected" value="">--Pilih--</option>
                                                                <option value="Bapa">Bapa</option>
                                                                <option value="Ibu">Ibu</option>
                                                                <option value="Waris">Waris</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</a>
                                                <a class="btn btn-primary" onclick="stepper.next()">Seterusnya</a>
                                                {{-- <a type="button" class="btn btn-primary">Submit</a> --}}
                                            </div>
                                            <div id="register-part" class="content" role="tabpanel"
                                                aria-labelledby="register-part-trigger">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Email</label>
                                                            @if($errors->has('email'))
                                                            <div class="alert alert-danger alert-dismissible">
                                                                {{ $errors->first('email') }}
                                                            </div>
                                                             @endif
                                                            <input type="email" name="email" class="form-control" id="">

                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Akses Pengguna</label>
                                                            @if($errors->has('akses'))
                                                            <div class="alert alert-danger alert-dismissible">
                                                                {{ $errors->first('akses') }}
                                                            </div>
                                                            @endif
                                                            <select class="form-control select2" name="akses"
                                                                style="width: 100%;">
                                                                <option selected="selected">--Pilih--</option>
                                                                <option value="1">Setiausaha</option>
                                                                <option value="2">Yang Di-Pertua</option>
                                                                <option value="3">Naib Yang Di-Pertua</option>
                                                                <option value="6">Bendahari</option>
                                                                <option value="4">Ahli Jawatankuasa</option>
                                                                <option value="5">Ahli</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Kata Laluan</label>
                                                    @if($errors->has('password'))
                                                    <div class="alert alert-danger alert-dismissible">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                    @endif
                                                    <input type="password" name="password" class="form-control" id="">
                                                </div>
                                                <a class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</a>
                                                <button type="submit"
                                                    class="btn btn-primary float-right ml-1">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                {{-- <div class="card-footer ">
                                    <button type="button" class="btn btn-success float-right ml-1">Simpan</button>
                                    <a type="button" class="btn btn-secondary float-right"
                                        onclick="window.history.back();">Kembali</a>
                                </div> --}}
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
    <!-- BS-Stepper -->
    <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}} "></script>

    <script>
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

    </script>

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


</body>

</html>
