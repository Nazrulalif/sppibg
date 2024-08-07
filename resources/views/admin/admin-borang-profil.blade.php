@extends('layouts.user_type.auth')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kemaskini Profil</h1>
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
                                    src="{{asset('\assets\img\avatar.png')}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{Auth()->user()->name}}</h3>

                            <p class="text-muted text-center">{{$user->nama_akses}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <strong><i class="fas fa-envelope"></i> Email</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->email}}
                                </p>


                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->address}}

                                </p>


                                <strong><i class="fas fa-phone"></i> Nombor Telefon</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->no_phone}}

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
                        <form id="profil" method="POST" action="{{route('admin.profil-update', [$user->id])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Penuh</label>
                                            @if($errors->has('name'))
                                            <div class="alert alert-danger alert-dismissible">
                                                {{ $errors->first('name') }}
                                            </div>
                                            @endif
                                            <input type="text" name="name" class="form-control" id="" value="{{$user->name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Nombor Kad Pengenalan</label>
                                            @if($errors->has('ic'))
                                            <div class="alert alert-danger alert-dismissible">
                                                {{ $errors->first('ic') }}
                                            </div>
                                            @endif
                                            <input type="text" name="ic" class="form-control" id="" value="{{$user->no_ic}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombor Telefon</label>
                                            @if($errors->has('phone'))
                                            <div class="alert alert-danger alert-dismissible">
                                                {{ $errors->first('phone') }}
                                            </div>
                                            @endif
                                            <input type="text" name="phone" class="form-control" id="" value="{{$user->no_phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            @if($errors->has('address'))
                                            <div class="alert alert-danger alert-dismissible">
                                                {{ $errors->first('address') }}
                                            </div>
                                            @endif
                                            <input type="text" name="address" class="form-control" id="" value="{{$user->address}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            @if($errors->has('email'))
                                            <div class="alert alert-danger alert-dismissible">
                                                {{ $errors->first('email') }}
                                            </div>
                                            @endif
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                                value="{{$user->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kata Laluan Baharu</label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                                placeholder="Kata laluan">
                                        </div>

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-right ml-1">Simpan</button>

                            </div>
                            <!-- /.card-body -->

                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>

    </section>
    <!-- /.content -->
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
