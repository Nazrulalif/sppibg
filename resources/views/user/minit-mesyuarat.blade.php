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
                    <h1>Minit Mesyuarat</h1>
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
            <!-- Default box -->
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>nama_mesyuarat</th>
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
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

@if (Auth::user()->access_code == 2|| Auth::user()->access_code == 3 || Auth::user()->access_code == 6)

{{-- Datatable2 --}}
<script>
    $(document).ready(function () {
        $('#example2').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ordering: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            },
            order: [
                [0, 'desc']
            ], // Order by the first column (index 0) in ascending order
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.minit-mesyuarat') }}",
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '50%',
                    targets: 1
                }, // Set 30% width for the second column
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
                    data: 'nama_mesyuarat',
                    name: 'nama_mesyuarat',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'formatted_date',
                    name: 'tarikh',
                    orderable: true, // Allow ordering for this column
                },
                {
                  data: null,
                  render: function (data, type, row) {
                    var assetUrl = '{{ asset('/uploads/minit-mesyuarat', '') }}';
                      return `
                      <a type="button" title="Lihat" class="btn btn-primary btn-sm" onclick="openViewWindow('${assetUrl}/${data.fail}')">
                            <i class="fas fa-folder"></i>
                        </a>`;
                      },
                  orderable: false,
                  searchable: false
  
                }
            ],
        });
    });
  
    function openViewWindow(url) {
        window.open(url, '_blank');
    }

</script>
@else
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
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            },
            ajax: "{{ route('minit-mesyuarat') }}",
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '50%',
                    targets: 1
                }, // Set 30% width for the second column
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
                    data: 'nama_mesyuarat',
                    name: 'nama_mesyuarat',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'formatted_date',
                    name: 'tarikh',
                    orderable: true, // Allow ordering for this column
                },
                {
                  data: null,
                  render: function (data, type, row) {
                    var assetUrl = '{{ asset('/uploads/minit-mesyuarat', '') }}';
                      return `
                      <a type="button" title="Lihat" class="btn btn-primary btn-sm" onclick="openViewWindow('${assetUrl}/${data.fail}')">
                            <i class="fas fa-folder"></i>
                        </a>`;
                      },
                  orderable: false,
                  searchable: false
  
                }
            ],
        });
    });
  
    function openViewWindow(url) {
        window.open(url, '_blank');
    }

</script>
@endif


@endsection
