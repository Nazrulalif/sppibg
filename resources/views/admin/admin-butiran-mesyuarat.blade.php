@extends('layouts.user_type.auth')

@section('content')


<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Butiran Mesyuarat</h1>
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
                <div class="col-md-3">
                    {{-- <a href="compose.html" class="btn btn-primary btn-block mb-3">Compose</a> --}}

                    <div class="card">
                        {{-- <div class="card-header">
                      <h3 class="card-title">Folders</h3>
        
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div> --}}
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#butiran" data-toggle="tab">
                                        Butiran
                                    </a>
                                </li>
                                @if ($panggilan && $panggilan->draf == 2)


                                @else
                                <li class="nav-item">
                                    <a href="#panggilan" data-toggle="tab" class="nav-link">
                                        Panggilan Mesyuarat
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a href="#usul" data-toggle="tab" class="nav-link">
                                        Usul Mesyuarat
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#minit" data-toggle="tab" class="nav-link">
                                        Minit Mesyuarat
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="tab-content" id="myTabContent">
                        <div class="card card-primary card-outline active tab-pane" id="butiran">
                            <div class="card-header">
                                <h3 class="card-title">Butiran</h3>
                                
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
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
                        <div class="card card-primary card-outline tab-pane" id="panggilan">
                            <div class="card-header">
                                <form action="{{route('admin.panggilan-mesyuarat-simpan', [$data->id])}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Panggilan</label>
                                        <input type="text" name="nama_panggilan" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Kepada</label>
                                        <select class="select2" multiple="multiple" name="kepada[]"
                                            data-placeholder="Pilih" style="width: 100%;">
                                            @foreach ($role as $item)
                                            <option value="{{$item->id}}">{{$item->nama_akses}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Tandatangan</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right ml-1">Hantar</button>
                                </form>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-primary card-outline tab-pane" id="usul">
                            <div class="card-header">
                                <h3 class="card-title">Usul Mesyuarat</h3>
                                @if (!empty($usul) && count($usul) > 0)
                                <a href="{{ route('admin.usul-laporan', ['id' => $data]) }}" target="_blank" class="btn btn-info btn-sm float-right">
                                    Laporan
                                </a>
                                @else
                                    
                                @endif
                                
                                {{-- <div class="btn-group float-right ">
                                    <button type="button" class="btn btn-default">Laporan</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                      <a class="dropdown-item" href="#">Senarai Usul</a>
                                      <a class="dropdown-item" href="#">Ulasan Usul</a>
                                    </div>
                                  </div> --}}
                                <!-- /.card-tools -->
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
                                            Menunggu
                                        <span class="right badge badge-danger">{{ $count }}</span>
                        
                                        </a>
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
                                                    <th >Usul</th>
                                                    <th>Pengusul</th>
                                                    <th>Tarikh</th>
                                                    <th>Status</th>
                                                    <th >Tindakan</th>
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
                                                    <th >Usul</th>
                                                    <th>Kategori</th>
                                                    <th>Pengusul</th>
                                                    <th>Tarikh</th>
                                                    {{-- <th>Pengesahan</th> --}}
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
                        @if (!empty($minit_mesyuarat) && count($minit_mesyuarat) > 0)

                        
                        <div class="tab-pane" id="minit">
                            <a class="btn btn-danger btn-sm float-right mb-3" href="{{ route('admin.minit-padam', ['id' => $data]) }}">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item pb-5" src="{{ asset('uploads/minit-mesyuarat/' . $minit_fail->fail) }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                         @else
                        <div class="card card-primary card-outline tab-pane" id="minit">
                            
                            <div class="card-header">
                                <h3 class="card-title">Minit Mesyuarat</h3>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('admin.minit-simpan', ['id' => $data])}}" class="dropzone" id="myDropzone">
                                    @csrf
                                </form>
                            </div>
                            @endif
                           
                            <!-- /.card-body -->
                        </div>

                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>



        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- jQuery -->
{{-- <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script> --}}
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script>
Dropzone.options.myDropzone = {
    maxFilesize: 2, // MB
    acceptedFiles: '.pdf',
    addRemoveLinks: true,
    maxFiles: 1, 
    dictRemoveFile: 'Remove',
    init: function() {
        this.on('success', function(file, response) {
            console.log('File uploaded:', file);
            // alert('Minit Mesyuarat berjaya disimpan');
            console.log('Server response:', response);
            location.reload();
        });

        this.on('removedfile', function(file) {
            // Send an AJAX request to delete the file from the database
            $.ajax({
                method: 'POST',
                url: '{{ route('admin.minit-padam', ['id' => $data]) }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    file: file.name // Assuming file.name contains the filename
                },
                success: function(response) {
                    console.log('File deleted:', file.name);
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting file:', error);
                }
            });
        });
        // this.on('maxfilesreached', function() {
        //     // Disable the Dropzone element
        //     this.disable();
        // });

        this.on('maxfilesexceeded', function(file) {
            this.removeAllFiles();
            this.addFile(file);
        });
    }
};


</script>

<script>
    // JavaScript to store and retrieve the active tab
    $(document).ready(function() {
        // Retrieve the active tab ID from sessionStorage
        var activeTab = sessionStorage.getItem('activeTab');
        if (activeTab) {
            // Activate the tab if it exists
            $('#myTabContent').find(activeTab).addClass('active');
            $('#myTabContent').find(activeTab).addClass('show');
            $('#myTabContent').find(activeTab).addClass('active');
            $('a[href="' + activeTab + '"]').tab('show');
        }

        // Store the active tab ID in sessionStorage when a tab is clicked
        $('a[data-toggle="tab"]').on('click', function() {
            var tabId = $(this).attr('href');
            sessionStorage.setItem('activeTab', tabId);
        });
    });
</script>

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
            ajax: {
             url: "{{ route('admin.usul-mesyuarat', ['id' => $data]) }}",
                method: 'GET',
                dataSrc: 'data'
            },
            columnDefs: [{
                    width: '1%',
                    targets: 0
                }, // Set 20% width for the first column
                {
                    width: '40%',
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
                    data: 'name',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    //jumlah usul
                    data: 'formatted_date',
                    name: 'formatted_date',
                    orderable: true // Allow ordering for this column
                },
                {
                    //jumlah usul
                    data: 'status',
                    name: 'status',
                    orderable: true,
                    render: function (data, type, row) {
                        if (data === 'Dijawab') {
                            return '<span class="badge badge-success">Dijawab</span>';
                        } else if (data === 'Belum Dijawab') {
                            return '<span class="badge badge-danger">Belum Dijawab</span>';
                        } else {
                            return ''; // Return empty string for other cases
                        }
                    }, // Allow ordering for this column
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                          <a type="button" title="kemaskini" class="btn btn-info btn-sm" onclick="openEditWindow('{{ route('admin.ulasan-usul', '') }}/${row.id}')">
                            <i class="fas fa-pencil-alt"></i>
                          </a>`;
                    },
                    orderable: false,
                    searchable: false

                }
            ],
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
            ajax: {
             url: "{{ route('admin.usul-mesyuarat-pengesahan', ['id' => $data]) }}",
                method: 'GET',
                dataSrc: 'data'
            },
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
                    name: 'usul',
                    orderable: true, // Allow ordering for this column
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true, // Allow ordering for this column
                },
                {
                    //jumlah usul
                    data: 'formatted_date',
                    name: 'formatted_date',
                    orderable: true // Allow ordering for this column
                },
                // {
                //     //jumlah usul
                //     data: 'pengesahan',
                //     name: 'pengesahan',
                //     orderable: true // Allow ordering for this column
                // },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                          <a type="button" title="terima" class="btn btn-success btn-sm acceptEvent" data-id="${data.id}">
                            <i class="fas fa-check"></i>

                        </a>
                        <button title="tolak" class="btn btn-danger btn-sm deleteEvent" data-id="${data.id}">
                            <i class="fas fa-times"></i>
                        </button>`;
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
                text: 'Anda akan menolak usul ini',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, pasti',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action
                    window.location.href = "{{ route('admin.usul-tolak', '') }}/" + id;
                }
            });
        });
        $('#example3').on('click', '.acceptEvent', function () {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Adakah anda pasti?',
                text: 'Anda akan menerima usul ini',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, pasti',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the delete action
                    window.location.href = "{{ route('admin.usul-terima', '') }}/" + id;
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
{{-- <script>
    function openNewWindow() {
        // Define the URL of the new window
        var route = '{{ route('admin.usul-laporan', ['id' => $data]) }}'; // Replace with your URL

        // Define the size and position of the new window
        var width = 800;
        var height = 600;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;

        // Open a new window with the specified URL, size, and position
        window.open(route, '_blank', 'width=' + width + ',height=' + height + ',left=' + left + ',top=' + top);
    }

</script> --}}
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
