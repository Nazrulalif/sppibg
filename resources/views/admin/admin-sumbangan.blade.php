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
                    <h1>Sumbangan</h1>
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
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Senarai Sumbangan</h3>

                    @if (Auth::user()->access_code == 1)
                    <button type="button" onclick="openNewWindow()" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-plus-circle"></i> Tambah</button>
                    @endif
                    
                </div>
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#activity" data-toggle="tab">
                                Semua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settings" data-toggle="tab">
                                Arkib
                            </a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sumbangan</th>
                                        <th>Penerangan</th>
                                        <th>Status</th>
                                        <th>Tarikh</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="settings">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sumbangan</th>
                                        <th>Penerangan</th>
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
            order: [
                [0, 'desc']
            ], // Order by the first column (index 0) in ascending order
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.sumbangan') }}",
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            },
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '40%',
                    targets: 2
                }, // Set 30% width for the second column
                {
                    width: '11%',
                    targets: 5
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
                    data: 'nama_sumbangan',
                    name: 'nama_sumbangan',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'penerangan',
                    name: 'penerangan',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'status',
                    className: 'dt-center',
                    render: function (data, type, row) {
                        if (data === 'aktif') {
                            return '<span class="badge badge-success">Aktif</span>';
                        } else if (data === 'tidak aktif') {
                            return '<span class="badge badge-danger">Tidak Aktif</span>';
                        } else {
                            return ''; // Return empty string for other cases
                        }
                    },
                    name: 'status',
                    orderable: true // Allow ordering for this column
                },
                {
                    data: 'formatted_date',
                    name: 'tarikh',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                    <div class="">
                        <a type="button" title="Lihat" class="btn btn-primary btn-sm" href="{{ route('admin.sumbangan-butiran', '') }}/${data.id}">
                            <i class="fas fa-eye"></i>
                        </a>

                    @if (Auth::user()->access_code == 1 || Auth::user()->access_code == 6)
                        <a type="button" title="Kemaskini" class="btn btn-info btn-sm" onclick="openEditWindow('{{ route('admin.sumbangan-edit', '') }}/${row.id}')">
                                      <i class="fas fa-pencil-alt"></i>
                        </a>
                        <button title="Nyah aktif" class="btn btn-danger btn-sm deactiveEvent" data-id="${data.id}">
                            <i class="fas fa-times"></i>
                        </button>

                      </div>
                    @endif`;
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
                    window.location.href = "{{ route('admin.sumbangan-padam', '') }}/" + id;
                }
            });
        });
        $('#example2').on('click', '.deactiveEvent', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Adakah anda pasti?',
                text: 'Anda akan nyah aktif rekod ini',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, pasti',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action
                    window.location.href = "{{ route('admin.sumbangan-nyahaktif', '') }}/" + id;
                }
            });
        });
    });

</script>
{{-- Datatable3 --}}
<script>
    $(document).ready(function () {
        $('#example3').DataTable({
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
            ajax: "{{ route('admin.sumbangan-arkib') }}",
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '40%',
                    targets: 2
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
                    data: 'nama_sumbangan',
                    name: 'nama_sumbangan',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'penerangan',
                    name: 'penerangan',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'status',
                    className: 'dt-center',
                    render: function (data, type, row) {
                        if (data === 'aktif') {
                            return '<span class="badge badge-success">Aktif</span>';
                        } else if (data === 'tidak aktif') {
                            return '<span class="badge badge-danger">Tidak Aktif</span>';
                        } else {
                            return ''; // Return empty string for other cases
                        }
                    },
                    name: 'id_draf',
                    orderable: true // Allow ordering for this column
                },
                {
                    data: 'formatted_date',
                    name: 'tarikh',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                    <div class="">
                        <a type="button" title="Lihat" class="btn btn-primary btn-sm" href="{{ route('admin.sumbangan-butiran', '') }}/${data.id}">
                            <i class="fas fa-eye"></i>
                        </a>

                        @if (Auth::user()->access_code == 1 || Auth::user()->access_code == 6)
                        <button title="Padam" class="btn btn-danger btn-sm deleteEvent" data-id="${data.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                      </div>
                      @endif`;
                    },
                    orderable: false,
                    searchable: false
                }

            ],
        });
        $('#example3').on('click', '.deleteEvent', function () {
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
                    window.location.href = "{{ route('admin.sumbangan-padam', '') }}/" + id;
                }
            });
        });
    });

</script>
<script>
  function openEditWindow(url) {
          // Define the size and position of the new window
          var width = 800;
          var height = 600;
          var left = (window.innerWidth - width) / 2;
          var top = (window.innerHeight - height) / 2;
  
          // Open a new window with the specified URL, size, and position
          window.open(url, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
      }
  
  
  </script>
{{-- open new window --}}
<script>
  function openNewWindow() {
      // Define the URL of the new window
      var route = '{{ route('admin.sumbangan-tambah') }}'; // Replace with your URL

      // Define the size and position of the new window
      var width = 800;
      var height = 600;
      var left = (window.innerWidth - width) / 2;
      var top = (window.innerHeight - height) / 2;

      // Open a new window with the specified URL, size, and position
      window.open(route, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
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
