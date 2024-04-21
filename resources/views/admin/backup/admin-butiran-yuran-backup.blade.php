@extends('layouts.user_type.auth')

@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Butiran Pembayaran Yuran Tahun {{$yuran->tahun}}</h1>
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>RM {{$jumlah_kutipan}}</h3>
                            <p>Jumlah Kutipan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$bayar_penuh}}</h3>

                            <p>Bayaran Penuh</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$bayar_separa}}</h3>

                            <p>Bayaran Separa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$belum_bayar}}</h3>

                            <p>Belum Buat Pembayaran</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Ringkasan
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="bar-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.card-body-->
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- Donut chart -->
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">
                                Jumlah Baki
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="donut-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.card-body-->
                    </div>
                </div>
            </div>


            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Senarai Pembayar</h3>
                    <button type="button" onclick="openNewWindow()" class="btn btn-primary btn-sm float-right">
                        Laporan
                    </button>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama pelajar</th>
                                        <th>Nama Ahli</th>
                                        <th>Yuran (RM)</th>
                                        <th>Yuran Tambahan (RM)</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Baki</th>
                                        <th>Status</th>
                                        {{-- <th>Tarikh</th> --}}
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>\
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- FLOT CHARTS -->
<script src="{{asset('plugins/flot/jquery.flot.j')}}s"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{asset('plugins/flot/plugins/jquery.flot.pie.js')}}"></script>

{{-- Datatable2 --}}
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: true,
            order: [
                [0, 'desc']
            ], // Order by the first column (index 0) in ascending order
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.senarai-bayar', $data) }}",
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                // {
                //     width: '50%',
                //     targets: 1
                // }, // Set 30% width for the second column
                // {
                //     width: '10%',
                //     targets: 2
                // } // Set 50% width for the third column
            ],
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart +
                            1; // Column for displaying row number
                    },
                    orderable: true,
                },
                {
                    data: 'nama_pelajar',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'nama_pengguna',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'yuran_rm',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'yuran_tambahan',
                    name: 'jumlah_bayar',
                    orderable: true, // Allow ordering for this column

                },
                {
                    data: 'jumlah_bayar',
                    name: 'jumlah_bayar',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'jumlah_yang_tinggal',
                    name: 'jumlah_bayar',
                    orderable: true, // Allow ordering for this column
                },
                // {
                //     data: 'cara_bayar',
                //     name: 'cara_bayar',
                //     orderable: true, // Allow ordering for this column

                // },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true, // Allow ordering for this column
                    className: 'dt-center',
                    render: function(data, type, row) {
                        if (data === 'Bayaran Penuh') {
                            return '<span class="badge badge-success">Bayaran Penuh</span>';
                        } else if (data === 'Bayaran Separa') {
                            return '<span class="badge badge-warning">Bayaran Separa</span>';
                        } else {
                            return ''; // Return empty string for other cases
                        }
                    },

                },
                {
                    data: 'formatted_date',
                    name: 'formatted_date',
                    orderable: true, // Allow ordering for this column

                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                    <div class="">
                        <a type="button" title="papar" class="btn btn-primary btn-sm" href="{{ route('admin.yuran-butiran', '') }}/${data.id}">
                            <i class="fas fa-folder"></i>
                        </a>`;
                    },
                    orderable: false,
                    searchable: false
                }
            ],
        });
        $('#example2').on('click', '.deleteEvent', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Adakah anda pasti?',
                text: 'Anda akan memadam rekod ini',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, pasti',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action
                    window.location.href = "{{ route('admin.yuran-padam', '') }}/" + id;
                }
            });
        });
    });
</script>

{{-- Bar chart --}}
<script>
    var bar_data = {
        data: [
            [1, {
                {
                    $bayar_penuh
                }
            }],
            [2, {
                {
                    $bayar_separa
                }
            }],
            [3, {
                {
                    $belum_bayar
                }
            }]
        ],
        bars: {
            show: true
        }
    }
    $.plot('#bar-chart', [bar_data], {
        grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center',
            },
        },
        colors: ['#3c8dbc'],
        xaxis: {
            ticks: [
                [1, 'Bayaran Penuh'],
                [2, 'Bayaran Separuh'],
                [3, 'Belum Bayar']
            ]
        }
    })
    /* END BAR CHART */
</script>
{{-- donut chart --}}
<script>
    var collectedAmount = {
        {
            $jumlah_kutipan
        }
    };
    var totalAmount = {
        {
            $jumlah_keseluruhan
        }
    };
    var remainingAmount = totalAmount - collectedAmount;

    var donutData = [{
            label: 'Kutipan',
            data: collectedAmount,
            color: '#0073b7'
        },
        {
            label: 'Baki',
            data: remainingAmount,
            color: '#d2d6de'
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
    })

    // Add a separate element to display total amount in the center
    var donutCenterText = $('<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 16px; font-weight: bold; text-align: center; color: #0073b7;"> Jumlah <br> Keseluruhan <br> RM ' + totalAmount + '</div>');
    $('#donut-chart').append(donutCenterText);

    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
            label +
            '<br>' +
            Math.round(series.percent) + '%</div>'
    }
</script>

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

@endsection