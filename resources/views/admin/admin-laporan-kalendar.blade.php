@extends('layouts.user_type.auth')

@section('content')
<!-- Add this to your HTML file -->
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
{{-- <link rel="stylesheet" href="path_to_adminlte3_css_file"> --}}
<style>
    @media print {
    .print-button-container {
        display: none;
    }
}

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan</h1>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Aktiviti</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.kalendar-laporan-tarikh')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tarikh Mula</label>
                                    @if($errors->has('tarikh_mula'))
                                    <div class="alert alert-danger alert-dismissible">
                                        {{ $errors->first('tarikh_mula') }}
                                    </div>
                                    @endif
                                    <input type="date" class="form-control" name="tarikh_mula" id="">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tarikh Akhir</label>
                                    @if($errors->has('tarikh_akhir'))
                                    <div class="alert alert-danger alert-dismissible">
                                        {{ $errors->first('tarikh_akhir') }}
                                    </div>
                                    @endif
                                    <input type="date" class="form-control" name="tarikh_akhir" id="">
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Hantar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            @if(!empty($activities) && count($activities) > 0)
            <div class="print-button-container">
                <a onclick="printCard()" class="btn btn-app bg-secondary">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
            <div class="card p-3 mb-3" id="printable-content">
                <div class="card-body">
                    <div class="header">
                        <div class="row align-items-center">
                            <div class="col-4 col-sm-auto mb-3 mb-sm-0 text-center">
                                <img src="{{asset('assets/img/logo_sekolah.png')}}" class="img-fluid"
                                    style="max-width: 80px;" alt="">
                            </div>
                            <div class="col-sm">
                                <h4 class="mb-1">SEKOLAH KEBANGSAAN JALAN MATANG BULUH</h4>
                                <p class="mb-0">No 1, Jalan Matang Buluh, Kampung Alor Senggut,</p>
                                <p class="mb-0">34300 Bagan Serai, Perak</p>
                            </div>
                            <div class="col-sm-auto text-center text-sm-right">
                                <h4><strong>Laporan Aktiviti</strong></h4>
                                <small class="float-right">{{date('l, j F Y')}}</small>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-12 p-4" style="align-items: center; display: flex; justify-content: center; flex-direction: column;">
                            <h4 class="title">Laporan Aktiviti</h4>
                            <p>{{$tarikh_mula}} sehingga {{$tarikh_akhir}}</p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 120px">Tarikh</th>
                                        <th style="width: 170px">Masa</th>
                                        <th>Nama / Tajuk</th>
                                        <th>Terlibat</th>
                                        <th>Tempat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $index => $item)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tarikh)->format('j F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->masa_mula)->format('h:i A') }} - {{ \Carbon\Carbon::parse($item->masa_tamat)->format('h:i A') }}</td>
                                            <td><strong>{{$item->nama}}</strong></td>
                                            <td>{{$item->kepada}}</td>
                                            <td>{{$item->tempat}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        @endif
        
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
function printCard() {
    // Hide the print button
    var printButton = document.querySelector('.print-button-container');
    printButton.style.display = 'none';

    // Print the content
    var printContents = document.getElementById('printable-content').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();

    // Restore the print button
    printButton.style.display = 'block';
    document.body.innerHTML = originalContents;
}

</script>


@endsection
