@extends('layouts.user_type.auth')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Panggilan Mesyuarat</h1>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Butiran Mesyuarat</h3>
                        </div>
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
                                        <td>{{ \Carbon\Carbon::parse($data->masa_mula)->format('h:i A') }} -
                                            {{ \Carbon\Carbon::parse($data->masa_tamat)->format('h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tempat</strong> </td>
                                        <td>{{$data->tempat}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jemputan</strong> </td>
                                        <td>{{$data->kepada}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Agenda</strong> </td>
                                        <td>{{$data->agenda}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-7">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Panggilan Mesyuarat</h3>
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="name">Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelect2">Select Multiple Options</label>
                                    <select id="exampleSelect2" class="form-control select2bs4" multiple="multiple">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="customFile">Tandatangan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success float-right ml-1">Hantar</button>
                            </form>

                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>



        </div>


    </section>
    <!-- /.content -->
</div>


@endsection
