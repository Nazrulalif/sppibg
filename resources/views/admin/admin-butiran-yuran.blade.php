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
                    {{-- <h1>Butiran Pembayaran Yuran Tahun {{$yuran->tahun}}</h1> --}}
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
                            <h3>{{$selesai}}</h3>

                            <p>Selesai Pembayaran</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$belum_selesai}}</h3>

                            <p>Belum Selesai Pembayaran</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$jumlah_pelajar}}</h3>

                            <p>Jumlah Pelajar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Senarai Pembayar</h3>
                    <button type="button" onclick="openNewWindow()"
                            class="btn btn-primary btn-sm float-right">
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
                                        <th>Nama Pelajar</th>
                                        <th>Nama Ahli</th>
                                        <th>Yuran (RM)</th>
                                        <th>Yuran Tambahan (RM)</th>
                                        <th>Jumlah Bayar</th>
                                        <th>Status</th>
                                        <th>Tarikh</th>
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
    $(document).ready(function () {
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
                    render: function (data, type, row, meta) {
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
                    data: 'name',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'yuran',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'yuran_tambahan',
                    name: 'jumlah_bayar',
                    orderable: true, // Allow ordering for this column

                },
                {
                    data: 'jumlah_yuran',
                    name: 'jumlah_bayar',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: true, // Allow ordering for this column
                    className: 'dt-center',
                    render: function (data, type, row) {
                        if (data === 'Selesai') {
                            return '<span class="badge badge-success">Selesai</span>';
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
                    render: function (data, type, row) {
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
    });

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
