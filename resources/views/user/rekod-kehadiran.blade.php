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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Butiran Kehadiran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tarikh</th>
                                    <th>Mesyurat</th>
                                    <th>Mula</th>
                                    <th>Tamat</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekod as $item)
                                        <tr>
                                            <td>1.</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tarikh)->format('j F Y') }}</td>
                                            <td>{{$item->nama_mesyuarat}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->masa_mula)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->masa_tamat)->format('h:i A') }}</td>
                                            <td>{{$item->status}}</td>
                                        </tr>
                                    @endforeach
                                  
                                </tbody>
                              </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-sm-5">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Laporan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="donut-chart" style="height: 300px;"></div>
    
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            

        </div>


    </section>
    <!-- /.content -->
</div>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
<!-- FLOT CHARTS -->
<script src="{{asset('plugins/flot/jquery.flot.j')}}s"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.pie.js')}}"></script>
<script>
    var donutData = [{
            label: 'Hadir',
            data: {{$hadir}}, // Assuming 70% are 'Hadir'
            color: '#3c8dbc'
        },
        {
            label: 'Tidak Hadir',
            data: {{$tidak_hadir}}, // Assuming 30% are 'Tidak Hadir'
            color: '#f56954'
        }
    ];

    $.plot('#donut-chart', donutData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                innerRadius: 0.5,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }
            }
        },
        legend: {
            show: false
        }
    });

    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
            label +
            '<br>' +
            Math.round(series.percent) + '%</div>';
    }
</script>


@endsection
