@extends('layouts.user_type.auth')

@section('content')


<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

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
                            <form action="{{route('admin.panggilan-mesyuarat-simpan', [$data->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Panggilan</label>
                                    <input type="text" name="nama_panggilan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Kepada</label>
                                    <select class="select2" multiple="multiple" name="kepada[]" data-placeholder="Pilih"
                                        style="width: 100%;">
                                        @foreach ($role as $item)
                                            <option value="{{$item->id}}">{{$item->nama_akses}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Tandatangan</label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                      </div>
                                      <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                      </div>
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


<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
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
<script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script>
@endsection
