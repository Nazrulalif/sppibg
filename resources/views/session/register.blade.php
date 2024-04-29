@extends('layouts.user_type.guest')

@section('content')

<!-- BS Stepper -->
<link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .wrapper {
        min-height: 0%;
    }

</style>

<body class="hold-transition login-page">
    <div class="">
        <div class="login-logo">
            <img src="\assets\img\logo_sekolah.png" width="30%" class="navbar-brand-img h-100" alt="...">

        </div>
        <!-- /.login-logo -->
        <div class="row px-4">
            <div class="col-md-12">
                <div class="card card-default">
                    <form id="profil" method="POST" action="{{route('pengguna-simpan')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-0">
                            <div class="bs-stepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <!-- your steps here -->
                                    <div class="step" data-target="#logins-part">
                                        <a type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                            id="logins-part-trigger">
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
                                        <a type="button" class="step-trigger" role="tab" aria-controls="register-part"
                                            id="register-part-trigger">
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
                                            <input type="text" name="name" class="form-control" id="">
                                            @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nombor Kad Pengenalan</label>
                                                    <input type="text" name="ic" class="form-control" id="">
                                                    @error('ic')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nombor Telefon</label>
                                                    <input type="text" name="phone" class="form-control" id="">
                                                    @error('phone')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <input type="text" name="address" class="form-control" id="">
                                            @error('address')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.next()">Seterusnya</a>
                                        <br>
                                        <p class="py-2 mb-0">
                                            <p style="text-align: center">Sudah ada akaun? <a href="{{route('login')}}"
                                                    class="text-center">Log Masuk</a></p>
                                        </p>
                                    </div>
                                    <div id="information-part" class="content" role="tabpanel"
                                        aria-labelledby="information-part-trigger">

                                        <div id="childrenFields">
                                            <div class="child-fields row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Nama Pelajar</label>
                                                        <input type="text" name="child[]" class="form-control" id="">
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
                                                <button type="button" class="btn btn-sm btn-primary" id="addChild">
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
                                                    @error('hubungan')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
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
                                                    <input type="email" name="email" class="form-control" id="">
                                                    @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Akses Pengguna</label>
                                                    <select class="form-control select2" name="akses"
                                                        style="width: 100%;">
                                                        <option selected="selected">--Pilih--</option>
                                                        {{-- <option value="1">Setiausaha</option>
                                                        <option value="2">Yang Di-Pertua</option>
                                                        <option value="3">Naib Yang Di-Pertua</option>
                                                        <option value="6">Bendahari</option>
                                                        <option value="4">Ahli Jawatankuasa</option> --}}
                                                        <option value="5">Ahli</option>
                                                    </select>
                                                    @error('akses')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Kata Laluan</label>
                                            <input type="password" name="password" class="form-control" id="">
                                            @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <a class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</a>
                                        <button type="submit" class="btn btn-success float-right ml-1">Simpan</button>
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
        </div>


        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <!-- BS-Stepper -->
        <script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}} "></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        {{-- sweet alert --}}
        @if (Session::get('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "success",
                title: "{{Session::get('success')}}"
            });

        </script>
        @endif
        <script>
            // BS-Stepper Init
            document.addEventListener('DOMContentLoaded', function () {
                window.stepper = new Stepper(document.querySelector('.bs-stepper'))
            })

        </script>
</body>




@endsection
