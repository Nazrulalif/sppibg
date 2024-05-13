@extends('layouts.user_type.auth')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<style>
    .checkboxPrimary1 {
    transform: scale(1.5); /* Increase the size of the checkbox */
}
    /* CSS to align the ":" symbol */
    .text-secondary strong {
        display: inline-block;
        width: 70px; /* Adjust the width as needed */
    }


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kehadiran Mesyuarat</h1>
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
            <div class="callout callout-danger">
                <h5>Perhatian !</h5>

                <p>Semua ahli akan ditandakan
                    sebagai TIDAK HADIR sehingga ahli mengimbas kod QR
                     ATAU setiausaha mengemas kini status kehadiran secara manual</p>
              </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- Default box -->
                    <div class="card align-items-center">
                        <div class="card-body">
                            {{-- <h3 class="text-danger p-2" style="text-align: center; font-weight:bold;">{{$randomValue}}</h3> --}}
                            <a href="" id="qrcode" >{!! $simple !!}</a><br/>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- Default box -->
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-info">
                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah</span>
                                    <h3 class="info-box-number" id="jumlahCount"></h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-success">
                                <div class="info-box-content">
                                    <span class="info-box-text">Hadir</span>
                                    <h3 class="info-box-number" id="hadirCount"></h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box bg-danger">
                                <div class="info-box-content">
                                    <span class="info-box-text">Tidak Hadir</span>
                                    <h3 class="info-box-number" id="tidakHadirCount"></h3>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="body p-3">
                            <h3 class="text-secondary" style="text-transform: uppercase">{{$mesyuarat->nama_mesyuarat}}</h3>
                            <p class="text-secondary" ><strong>Tarikh</strong> :  {{ \Carbon\Carbon::parse($mesyuarat->tarikh)->format('j F. Y') }}</p>
                            <p class="text-secondary" style="line-height: 1px;"><strong>Masa</strong> :  {{ \Carbon\Carbon::parse($mesyuarat->masa_mula)->format('h:i A') }} - {{ \Carbon\Carbon::parse($mesyuarat->masa_tamat)->format('h:i A') }}</p>
                        </div>
                    </div>

                    <!-- Default box -->
                    <div class="card">

                        <div class="card-header">
                        @if(Auth::user()->access_code !=6)
                            <div class="pb-3">
                                <a href="{{route('admin.kehadiran-laporan', $data)}}" target="_blank" class="btn btn-sm btn-primary float-right">Laporan</a>
                            </div>
                        @endif
                        </div>
                        <div class="card-body ">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        {{-- <th>status</th> --}}
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


        </div>
        <!-- /.card -->

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

{{-- qr random generate code --}}
{{-- <script>
    function updateQRCode() {
        var randomNumber = Math.floor(Math.random() * 9000) + 1000; // Generate a random number
        console.log('Updating QR code with random number:', randomNumber);
        var url = "{{ route('admin.kehadiran-qr', $data) }}";
        document.getElementById('qrCode').src = url + '?random=' + randomNumber; // Update the image source
    }

    // Update the QR code image every 10 seconds
    setInterval(updateQRCode, 10000);

    // Initial update
    updateQRCode();
</script> --}}

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
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Malay.json"
            },
            ajax: "{{ route('admin.kehadiran-pengguna', $data) }}",
            columnDefs: [{
                width: '1%',
                targets: 0
            }, // Set 20% width for the first column
            {
                width: '70%',
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
                data: 'name',
                name: 'name',
                orderable: true, // Allow ordering for this column
            },
            // {
            //     data: 'status',
            //     name: 'name',
            //     orderable: true, // Allow ordering for this column
            // },
            {
                data: null,
                className: 'dt-center',
                render: function (data, type, row) {
                    var checked = (data.status === 'Hadir') ? 'checked' : '';
                    return `
                    <div class="">
                         
                        <input type="checkbox" name="kehadiran" data-id="${data.id}" class="checkboxPrimary1" title="Hadir" ${checked}>

                    </div>
                    `;
                },
                orderable: false,
                searchable: false
            }
            ],
        });

    });

    // jQuery to handle checkbox changes and send data to the server
    $(document).on('change', 'input[name="kehadiran"]', function () {

        var id = $(this).data('id');
        var status = $(this).is(':checked') ? 'Hadir' : 'Tidak Hadir';


        $.ajax({
            url: "{{ route('admin.kehadiran-qr-simpan', '') }}/" + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function (response) {
                // Handle success response
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        function updateCounts() {
            $.ajax({
                url: "{{ route('admin.update-counts', '') }}/" + '{{ $data }}',
                type: 'GET',
                success: function(response) {
                    $('#jumlahCount').text(response.jumlahCount);
                    $('#hadirCount').text(response.hadirCount);
                    $('#tidakHadirCount').text(response.tidakHadirCount);
                },
                error: function(xhr, status, error) {
                    console.error('Error updating counts:', error);
                }
            });
        }

        // Update counts every 5 seconds
        setInterval(updateCounts, 5000);

        // Initial update
        updateCounts();
    });
</script>




@endsection
