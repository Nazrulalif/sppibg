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
                    <h1>Usul Mesyuarat</h1>
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

        <div class="container-fluid ">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Senarai Usul Mesyuarat</h3>
                    <button type="button" onclick="openNewWindow()" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-plus-circle"></i>
                        Tambah</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Usul</th>
                                        <th>Kategori</th>
                                        <th>Tarikh</th>
                                        <th>Status</th>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
            ajax: "{{ route('usul-mesyuarat', $data) }}",
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
                    data: 'usul',
                    name: 'usul',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'formatted_date',
                    name: 'formatted_date',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'status',
                    // className: 'dt-center',
                    render: function (data, type, row) {
                        if (data === 'Belum Dijawab') {
                            return '<span class="badge badge-warning">Belum Dijawab</span>';
                        } else if (data === 'Dijawab') {
                            return '<span class="badge badge-success">Dijawab</span>';
                        } else if (data === 'Ditolak') {
                            return '<span class="badge badge-danger">Ditolak</span>';
                        } else {
                            return ''; // Return empty string for other cases
                        }
                    },
                    name: 'id_draf',
                    orderable: true // Allow ordering for this column
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        if (row.status === 'Belum Dijawab' || row.status === 'Ditolak'  ) {
                            return `
                            <div class="">
                                <button title="Padam" class="btn btn-danger btn-sm deleteEvent" data-id="${data.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>`;
                        }
                        return `
                            <div class="">
                                <a type="button" title="Lihat" class="btn btn-primary btn-sm" onclick="openNewWindow2('{{ route('usul-butiran', '') }}/${row.id}')">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>`;
                        },  
                    orderable: false,
                    searchable: false
                }

            ],

        });
        $('#example2').on('click', '.deleteEvent', function () {
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
                    window.location.href = "{{ route('usul-padam', '') }}/" + id;
                }
            });

        });
    });

</script>
{{-- open new window --}}
<script>
    function openNewWindow() {
        // Define the URL of the new window
        var route = '{{ route('usul-tambah', $data) }}'; // Replace with your URL

        // Define the size and position of the new window
        var width = 600;
        var height = 450;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;

        // Open a new window with the specified URL, size, and position
        window.open(route, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
    }

</script>
<script>
    function openNewWindow2(url) {
        // Define the size and position of the new window
        var width = 800;
        var height = 600;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;

        // Open a new window with the specified URL, size, and position
        window.open(url, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
    }

</script>
@endsection
