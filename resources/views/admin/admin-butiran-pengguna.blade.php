@extends('layouts.user_type.auth')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Maklumat Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pentadbir sistem</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Pengguna</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid bootstrap-iso box-body">
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Nama Penuh</strong>
                        </div>
                        <div class="col-md-4 mb-10">
                            <p>{{$user->name}}</p>
                        </div>
                        @if (!empty($user->hubungan))
                            <div class="col-md-2">
                                <strong>Hubungan</strong>
                            </div>
                            <div class="col-md-4 mb-10">
                                <p>{{$user->hubungan}}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Akses</strong>
                        </div>
                        <div class="col-md-10  mb-10">
                            <p>{{$user->nama_akses}}</p>
                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Status</strong>
                        </div>
                        <div class="col-md-10  mb-10">
                            @if ($user->verified == 1)
                            <p>Aktif</p>
                            @else
                            <p>Belum disahkan</p>
                            @endif


                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Nombor Kad Pengenalan</strong>
                        </div>
                        <div class="col-md-10  mb-10">
                            <p>{{$user->no_ic}}</p>

                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Alamat</strong>
                        </div>
                        <div class="col-md-10 mb-10">
                            <p>{{$user->address}}</p>

                        </div>
                    </div>
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Nombor telefon</strong>
                        </div>
                        <div class="col-md-4 mb-10">
                            <p>{{$user->no_phone}}</p>
                        </div>
                        <div class="col-md-2">
                            <strong>Emel</strong>
                        </div>
                        <div class="col-md-4 mb-10">
                            <p>{{$user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>

        @if (!empty($pelajar) && count($pelajar) > 0)
        <!-- /.card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Pelajar</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid bootstrap-iso box-body">
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <strong>Nama Penuh</strong>
                        </div>
                        <div class="col-md-4 mb-10">
                            <!-- Leave this empty or add a placeholder if needed -->
                        </div>
                        <div class="col-md-2">
                            <strong>kelas</strong>
                        </div>
                        <div class="col-md-4 mb-10">
                            <!-- Leave this empty or add a placeholder if needed -->
                        </div>
                    </div>
                    @foreach ($pelajar as $item)
                    <div class="form-row col-md-12">
                        <div class="col-md-2">
                            <!-- Leave this empty or add a placeholder if needed -->
                        </div>
                        <div class="col-md-4 mb-10">
                            <p>{{$item->nama_pelajar}}</p>
                        </div>
                        <div class="col-md-2">
                            <!-- Leave this empty or add a placeholder if needed -->
                        </div>
                        <div class="col-md-4 mb-10">
                            <p> {{$item->tahun_pelajar_id}} {{$item->kelas}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- /.card-body -->

        </div>

        @endif
    </section>
    <!-- /.content -->
</div>

@endsection
