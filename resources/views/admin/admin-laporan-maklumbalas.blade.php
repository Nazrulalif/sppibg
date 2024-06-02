<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPPIBG</title>


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
    <!-- summernote -->
    <link rel="stylesheet" href=" {{asset('plugins/summernote/summernote-bs4.min.css')}} ">
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="stylesheet" href="path_to_adminlte3_css_file">
    <style>
        @media print {
            .print-button-container {
                display: none;
            }
        }

    </style>

</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" style="background-color: #f4f6f9">



        <!-- Main content -->
        <section class="content p-sm-5">
            <div class="print-button-container">
                <a onclick="printCard()" class="btn btn-app bg-secondary">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
            <div class="container-fluid" id="printable-content">

                <div class="card p-5">
                    <div class="header">
                        <div class="row align-items-center">
                            <div class="col-4 col-sm-auto mb-3 mb-sm-0 text-center">
                                <img src="{{asset('assets/img/logo_sekolah.png')}}" class="img-fluid"
                                    style="max-width: 80px;" alt="">
                            </div>
                            <div class="col-sm">
                                <h4 class="mb-1">SEKOLAH KEBANGSAAN JALAN MATANG BULUH</h4>
                                <p class="mb-0">No 1, Jalan Matang Buluh, Kampung Alor Senggut,</p>
                                <p class="mb-0">34300 Bagan Serai, Perak</p>
                            </div>
                            <div class="col-sm-auto text-center text-sm-right">
                                <h4><strong>Laporan Maklum Balas Kehadiran</strong></h4>
                                <small class="float-right">{{date('l, j F Y')}}</small>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 p-4"
                            style="align-items: center; display: flex; justify-content: center; flex-direction: column;">
                            <h4 class="title"></h4>
                            <p></p>
                        </div>
                    </div>
                    <div class="card-body p-3 pt-1 mb-3">
                        <table class="table table-bordered bg-light">
                            <tr>
                                <th style="width: 30%">Jumlah Terlibat</th>
                                <td>{{$maklumbalas_count}}</td>

                                <th style="width: 30%">Jumlah Hadir</th>
                                <td>{{$maklumbalas_hadir}}</td>
                            </tr>
                            <tr>
                                <th style="width: 30%">Jumlah Tidak Hadir</th>
                                <td>{{$maklumbalas_tidak_hadir}}</td>

                                <th style="width: 30%">Jumlah Belum Jawab</th>
                                <td>{{$maklumbalas_belum_jawab}}</td>


                            </tr>
                        </table>

                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 30%">Nama</th>
                                    <th>Status</th>
                                    <th>Alasan Tidak Hadir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->alasan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
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

    <script>
        function printCard() {
            // Hide the print button
            var printButton = document.querySelector('.print-button-container');
            printButton.style.display = 'none';

            // Print the content
            var printContents = document.getElementById('printable-content').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();

            // Restore the print button
            printButton.style.display = 'block';
            document.body.innerHTML = originalContents;
        }

    </script>
</body>

</html>
