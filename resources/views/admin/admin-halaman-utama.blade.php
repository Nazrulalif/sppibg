@extends('layouts.user_type.auth')

@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Utama</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pentadbir sistem</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('assets\img\avatar.png')}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{Auth()->user()->name}}</h3>

                            <p class="text-muted text-center">{{$user->nama_akses}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <strong><i class="fas fa-envelope"></i> Email</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->email}}
                                </p>


                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->address}}

                                </p>


                                <strong><i class="fas fa-phone"></i> Nombor Telefon</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->no_phone}}

                                </p>


                                <a href="{{route('admin.borang-profil', $user->id)}}"
                                    class="btn btn-primary btn-block"><b>Kemaskini</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buletin</h3>
                            <button type="button" onclick="openNewWindow()"
                                class="btn btn-primary btn-sm float-right"><i class="fas fa-plus-circle"></i>
                                Tambah</button>
                        </div>
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Semua</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Arkib</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tajuk</th>
                                                <th>Penerangan</th>
                                                <th>Status</th>
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
                                                <th>Tajuk</th>
                                                <th>Penerangan</th>
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
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
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

<!-- Page specific script -->

{{-- open new window --}}
<script>
    function openNewWindow() {
        // Define the URL of the new window
        var route = '{{ route('admin.buletin-tambah') }}'; // Replace with your URL

        // Define the size and position of the new window
        var width = 600;
        var height = 490;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;

        // Open a new window with the specified URL, size, and position
        window.open(route, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
    }

</script>

{{-- datatable2 --}}

<script>
    $(document).ready(function () {
        $('#example2').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5],
                [5]
            ],
            searching: false,
            ordering: true,
            order: [
                [0, 'desc']
            ], // Order by the first column (index 0) in ascending order
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.laman-utama') }}",
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            }, // Load Bahasa Melayu language file
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '30%',
                    targets: 1
                }, // Set 30% width for the second column
                {
                    width: '15%',
                    targets: 4
                }, // Set 30% width for the second column
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
                    data: 'nama_buletin',
                    name: 'nama_buletin',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'penerangan',
                    name: 'penerangan',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'id_draf',
                    className: 'dt-center',
                    render: function (data, type, row) {
                        if (data == '1') {
                            return '<span class="badge badge-danger">Draf</span>';
                        } else if (data == '2') {
                            return '<span class="badge badge-success">Hantar</span>';
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
                        var assetUrl = '{{ asset('/uploads/buletin', '') }}';
                        return `
                    <div class="">
                        <a type="button" title="Lihat" class="btn btn-primary btn-sm" onclick="openViewWindow('${assetUrl}/${data.fail}')">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a type="button" title="Kemaskini" class="btn btn-info btn-sm" onclick="openEditWindow('{{ route('admin.buletin-edit', '') }}/${data.id}')">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <button title="Padam" class="btn btn-danger btn-sm deleteEvent" data-id="${data.id}">
                            <i class="fas fa-trash"></i>
                        </button>
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
                    window.location.href = "{{ route('admin.buletin-padam', '') }}/" + id;
                }
            });
        });
    });

    function openViewWindow(url) {
        window.open(url, '_blank');
    }

    function openEditWindow(url) {
        // Define the size and position of the new window
        var width = 600;
        var height = 490;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;

        // Open a new window with the specified URL, size, and position
        window.open(url, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
    }

</script>

{{-- datatable3 --}}

<script>
    $(document).ready(function () {
        $('#example3').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5],
                [5]
            ],
            searching: false,
            ordering: true,
            order: [
                [0, 'desc']
            ], // Order by the first column (index 0) in ascending order
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.arkib') }}",
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            }, // Load Bahasa Melayu language file
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '30%',
                    targets: 1
                }, // Set 30% width for the second column
                {
                    width: '15%',
                    targets: 4
                }, // Set 30% width for the second column
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
                    data: 'nama_buletin',
                    name: 'nama_buletin',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'penerangan',
                    name: 'penerangan',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'id_draf',
                    className: 'dt-center',
                    render: function (data, type, row) {
                        if (data == '1') {
                            return '<span class="badge badge-primary">Arkib</span>';
                        } else if (data == '2') {
                            return '<span class="badge badge-primary">Arkib</span>';
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
                        var assetUrl = '{{ asset('/uploads/buletin', '') }}';
                        return `
                    <div class="">
                        <a type="button" title="Lihat" class="btn btn-primary btn-sm" onclick="openViewWindow('${assetUrl}/${data.fail}')">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button title="Padam" class="btn btn-danger btn-sm deleteEvent" data-id="${data.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                      </div>`;
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
                    window.location.href = "{{ route('admin.buletin-padam', '') }}/" + id;
                }
            });
        });
    });

    // function openViewWindow(url) {
    //     window.open(url, '_blank');
    // }

    // function openEditWindow(url) {
    //     // Define the size and position of the new window
    //     var width = 800;
    //     var height = 600;
    //     var left = (window.innerWidth - width) / 2;
    //     var top = (window.innerHeight - height) / 2;

    //     // Open a new window with the specified URL, size, and position
    //     window.open(url, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
    // }

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection
