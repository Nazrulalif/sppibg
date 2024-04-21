@extends('layouts.user_type.auth')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekod Kehadiran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-md-5">
      
        <div class="container-fluid ">
          
            <!-- Default box -->
            <div class="card card-primary card-outline">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <tbody>
                          <tr>
                            <td> <strong>Tarikh</strong></td>
                              <td>{{$formatted_date}}</td>
                          </tr>
                          <tr>
                                <td><strong>Nama Mesyuarat</strong> </td>
                            <td>{{$data->nama_mesyuarat}}</td>
                          </tr>
                          <tr>
                            <td><strong>Masa</strong> </td>
                            <td>{{ \Carbon\Carbon::parse($data->masa_mula)->format('h:i A') }} - {{ \Carbon\Carbon::parse($data->masa_tamat)->format('h:i A') }}</td>

                          </tr>
                          <tr>
                            <td><strong>Tempat</strong> </td>
                            <td>{{$data->tempat}}</td>
                          </tr>
                          <tr>
                            <td><strong>Status</strong> </td>
                            <td>Hadir</td>
                          </tr>
                          
                        </tbody>
                      </table>
                </div>
                <!-- /.card-body -->
            </div>
            {{-- <a type="button" class="btn btn-secondary">Laman Utama</a> --}}

            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>



@endsection
