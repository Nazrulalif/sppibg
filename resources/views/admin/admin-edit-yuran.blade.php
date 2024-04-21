<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href=" {{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}} ">
    <!-- iCheck -->
    <link rel="stylesheet" href=" {{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}} ">
    <!-- JQVMap -->
    <link rel="stylesheet" href=" {{asset('plugins/jqvmap/jqvmap.min.css')}} ">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{asset('dist/css/adminlte.min.css')}} ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}} ">
    <!-- Daterange picker -->
    <link rel="stylesheet" href=" {{asset('plugins/daterangepicker/daterangepicker.css')}} ">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>
<style>
    /* Hide the radio buttons */
    input[type="radio"] {
        display: none;
    }

    /* Style the color squares */
    .fc-color-picker li {
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
    }

    .fc-color-picker li i {
        width: 32.5px;
        height: 33px;
        display: inline-block;
        border-radius: 3px;
    }

    /* Highlight the selected color */
    input[type="radio"]:checked+label i {
        border: 3px solid #5c6667;
    }

</style>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="content-wrapper" style="margin-left:0">

        <section class="content">
            <div class="container">
                <div class="row" style="justify-content: center; padding-top:20px">
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card" id="mesyuarat-card">
                            <div class="card-header">
                                <h3 class="card-title">Kemaskini Yuran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('admin.yuran-update', [$data->id])}}" id="form-yuran" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tahun">Tahun</label>
                                                <input type="number" name="tahun" class="form-control" id="tahun"
                                                    value="{{ $data->tahun }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="harga">Yuran PIBG (Per keluarga)</label>
                                                <input type="number" name="harga" class="form-control" id="harga"
                                                    value="{{ $data->harga }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h3 class="card-title">Yuran Tambahan</h3>
                                    <button type="button" data-toggle="modal" data-target="#modal-xl"
                                        class="btn btn-primary btn-sm float-right"><i class="fas fa-plus-circle"></i>
                                        Tambah</button>
                                    <br>
                                    <br>

                                    @if (!empty($yuran_tambahan) && count($yuran_tambahan) > 0)
                                    <table id="dynamic-table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Perkara</th>
                                                <th>Tahun 1 (RM)</th>
                                                <th>Tahun 2 (RM)</th>
                                                <th>Tahun 3 (RM)</th>
                                                <th>Tahun 4 (RM)</th>
                                                <th>Tahun 5 (RM)</th>
                                                <th>Tahun 6 (RM)</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($yuran_tambahan->groupBy('perkara') as $perkara => $items)
                                            <tr>
                                                <td>{{$perkara}}</td>
                                                @foreach ($items as $item)
                                                <td>{{$item->harga}}</td>
                                                @endforeach
                                                @for ($i = $items->count(); $i < 6; $i++) <td>
                                                    </td>
                                                    @endfor
                                                    <td>
                                                        <a title="padam" class="btn btn-danger btn-sm deleteEvent" data-perkara="{{$perkara}}" data-id="{{$data->id}}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>

                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                    <br>

                                    <button type="submit" name="submit"
                                        class="btn btn-success float-right ml-1">Simpan</button>
                                </div>

                            </form>


                            {{-- Modal --}}
                            <div class="modal fade" id="modal-xl">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Yuran Tambahan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('admin.yuran-simpan-tambahan', [$data->id]) }}"
                                                id="form-yuran" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                <table id="dynamic-table" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Perkara</th>
                                                            <th>Tahun 1 (RM)</th>
                                                            <th>Tahun 2 (RM)</th>
                                                            <th>Tahun 3 (RM)</th>
                                                            <th>Tahun 4 (RM)</th>
                                                            <th>Tahun 5 (RM)</th>
                                                            <th>Tahun 6 (RM)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1.</td>
                                                            <td>
                                                                <input type="text" name="perkara" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="harga_tambahan[]"
                                                                    class="form-control">
                                                                <input type="hidden" name="tahun_pelajar[]"
                                                                    class="form-control" value="1">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="harga_tambahan[]"
                                                                    class="form-control">
                                                                <input type="hidden" name="tahun_pelajar[]"
                                                                    class="form-control" value="2">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="harga_tambahan[]"
                                                                    class="form-control">
                                                                <input type="hidden" name="tahun_pelajar[]"
                                                                    class="form-control" value="3">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="harga_tambahan[]"
                                                                    class="form-control">
                                                                <input type="hidden" name="tahun_pelajar[]"
                                                                    class="form-control" value="4">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="harga_tambahan[]"
                                                                    class="form-control">
                                                                <input type="hidden" name="tahun_pelajar[]"
                                                                    class="form-control" value="5">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="harga_tambahan[]"
                                                                    class="form-control">
                                                                <input type="hidden" name="tahun_pelajar[]"
                                                                    class="form-control" value="6">
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" name="submit"
                                                        class="btn btn-success float-right ml-1">Simpan</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}} "></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}} "></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}} "></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}} "></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}} "></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}} "></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}} "></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}} "></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}} "></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}} "></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}} "></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}} "></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/js/demo.js')}} "></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/js/pages/dashboard.js')}} "></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
       $('.deleteEvent').click(function () {
    var perkara = $(this).data('perkara'); // Get perkara from data attribute
    var id = $(this).data('id'); // Get id from data attribute
    var button = $(this); // Store $(this) in a variable

    // Use SweetAlert2 for confirmation
    Swal.fire({
        title: 'Anda pasti?',
        text: 'Adakah anda pasti mahu memadam"' + perkara + '"?',
        icon: 'Amaran',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Padam!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send AJAX request to delete row
            $.ajax({
                url: "{{ route('admin.yuran-tambahan-padam') }}",
                method: "GET",
                data: {
                    perkara: perkara,
                    id: id
                },
                success: function (response) {
                    // Remove the entire row from the table
                    button.closest('tr').remove(); // Use the stored button variable here
                    Swal.fire(
                        'Padam!',
                        'Yuran tambahan berjaya dipadam.',
                        'success'
                    );
                },
                error: function (error) {
                    alert("Error deleting rows: " + error.responseText);
                }
            });
        }
    });
});

    </script>
    
    

</body>

</html>
