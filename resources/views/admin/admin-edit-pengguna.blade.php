@extends('layouts.user_type.auth')

@section('content')
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{asset('plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kemaskini Maklumat Pengguna</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pentadbir sistem</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('assets\img\avatar.png')}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <p class="text-muted text-center"> </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <strong><i class="fas fa-envelope"></i></strong>
                                <p class="text-muted">
                                    {{$user->email}}
                                </p>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i></strong>
                                <p class="text-muted">
                                    {{$user->address}}
                                </p>
                                <strong><i class="fas fa-phone"></i></strong>
                                <p class="text-muted">
                                    {{$user->no_phone}}
                                </p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Maklumat Pengguna</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="profil" method="POST" action="{{route('admin.pengguna-update', [$user->id])}}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body p-0">
                                    {{-- {{$user->id}} --}}
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
                                                    <span class="bs-stepper-label">Akaun</span>
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
                                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
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
                                                            <input type="text" name="ic" class="form-control" value="{{$user->no_ic}}">
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
                                                            <input type="text" name="phone" class="form-control" value="{{$user->no_phone}}">
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
                                                    <input type="text" name="address" class="form-control" value="{{$user->address}}">
                                                </div>
                                                <a class="btn btn-primary" onclick="stepper.next()">Seterusnya</a>
                                            </div>
                                            <div id="information-part" class="content" role="tabpanel"
                                                aria-labelledby="information-part-trigger">
                                                
                                                <div id="childrenFields">
                                                    @foreach($pelajar as $pelajar)
                                                    <div class="child-fields row" >
                                                        <div class="col-md-10">
                                                            <div class="form-group">
                                                                <label for="name">Nama Pelajar</label>
                                                                <input type="text" name="child[]" class="form-control" value="{{$pelajar->nama_pelajar}}">
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="name">Tahun</label>
                                                                {{-- <input type="text" name="year[]" class="form-control" value="{{$pelajar->tahun}}"> --}}
                                                                <select name="year[]" class="form-control" id="">
                                                                    <option value="{{$pelajar->tahun}}">Tahun {{$pelajar->tahun}}</option>
                                                                    <option value="1">Tahun 1</option>
                                                                    <option value="2">Tahun 2</option>
                                                                    <option value="3">Tahun 3</option>
                                                                    <option value="4">Tahun 4</option>
                                                                    <option value="5">Tahun 5</option>
                                                                    <option value="6">Tahun 6</option>
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="name">Kelas</label>
                                                                {{-- <input type="text" name="class[]" class="form-control" value="{{$pelajar->kelas}}"> --}}
                                                                <select name="class[]" class="form-control" id="">
                                                                    <option value="{{$pelajar->kelas}}">{{$pelajar->kelas}}</option>
                                                                    <option value="Bestari">Bestari</option>
                                                                    <option value="Gemilang">Gemilang</option>
                                                                    <option value="Cemerlang">Cemerlang</option>
                                                                   
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="name"> </label>
                                                                @if($pelajar->where('id_pengguna', $pelajar->id_pengguna)->count() > 1)
                                                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.pelajar-delete', [$pelajar->pelajarId]) }}">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </a>
                                                                @endif


                                                            </div>
                                                        </div>
    
                                                    </div>
                                                    @endforeach
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-sm btn-primary" id="addChild">
                                                            Tambah
                                                        </button><br>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('addChild').addEventListener('click', function () {
                                                        const childrenFields = document.querySelector('#childrenFields');
                                                        const newChildField = document.createElement('div');
                                                        newChildField.classList.add('child-fields', 'row');
                                                
                                                        newChildField.innerHTML = `
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="child" class="form-label">Nama Pelajar</label>
                                                                    <input type="text" name="child[]" class="form-control value="{{$user->nama_pelajar}}">
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
                                                                <option selected="selected" value="{{$user->hubungan}}">{{$user->hubungan}}</option>
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
                                                            <input type="email" name="email" class="form-control" value="{{$user->email}}">
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
                                                                <option selected="selected" value="{{$user->access_code}}">{{$user->nama_akses}}</option>
                                                                <option value="1">Pentadbir Sistem</option>
                                                                <option value="2">Yang Di-Pertua</option>
                                                                <option value="3">Naib Yang Di-Pertua</option>
                                                                <option value="4">Ahli Jawatankuasa</option>
                                                                <option value="5">Ahli</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group">
                                                    <label for="name">Password</label>
                                                    <input type="password" name="password" class="form-control" id="">
                                                </div> --}}
                                                <a class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</a>
                                                <button type="submit"
                                                    class="btn btn-success float-right ml-1">Simpan</button>
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
    <!-- /.content -->
</div>

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
    document.getElementById('profil').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting

        Swal.fire({
            title: 'Adakah anda pasti?',
            text: 'Anda akan mengemas kini profil',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, pasti',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, submit the form
                this.submit();
            }
        });
    });
</script>


@endsection
