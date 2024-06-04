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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
            p,ul,li,h4,h2,h4,h6, td, th{
            color: black;
        }
    </style>

</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main content -->
        <section class="content p-sm-5">
            <div class="container-fluid" id="printable-content">
                <div class="card p-5">
                    <div class="header">
                        <div class="row align-items-center">
                            <div class="col-4 col-sm-auto mb-3 mb-sm-0 text-center">
                                <img src="{{$message->embed(asset('assets/img/logo_sekolah.png'))}}" class="img-fluid" style="max-width: 80px;" alt="">
                            </div>
                            <div class="col-sm">
                                <h4 class="mb-1">SEKOLAH KEBANGSAAN JALAN MATANG BULUH</h4>
                                <p class="mb-0">No 1, Jalan Matang Buluh, Kampung Alor Senggut,</p>
                                <p class="mb-0">34300 Bagan Serai, Perak</p>
                            </div>
                            {{-- <div class="col-sm-auto text-center text-sm-right">
                                <h4><strong>Laporan Sumbangan</strong></h4>
                                <small class="float-right">{{date('l, j F Y')}}</small>

                        </div> --}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div style="text-align: end">
                            <p class="mb-0">Rujukan: PIBG/SKJMB
                                {{$data->id}}/{{ ucwords(\Carbon\Carbon::parse($data->created_at)->locale('ms_MY')->isoFormat('YYYY')) }}
                            </p>
                            <p class="">Tarikh: {{date('j F Y')}}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="mb-0">Yang Dihormati</p>
                        <p class="mb-0">Ibu bapa / Penjaga</p>
                        <p>Murid-murid SKJMB</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Tuan/Puan</p>
                        <h4><strong>KADAR BAYARAN TAMBAHAN PERSEKOLAHAN PIBG TAHUN {{$id}} </strong></h4>
                        <p>dengan hormatnya saya ingin merujuk kepada perkara diatas</p>
                    </div>
                </div>
                <div class="row">!
                    <div class="col">
                        <ol start="2" style="text-indent: 1rem">
                            <li>Sukacita dimaklumkan bahawa Persatuan Ibu Bapa dan Guru (PIBG) SK Jalan Matang Buluh
                                telah mendapat kebenaran Jabatan Pendidikan Negeri Perak untuk
                                membuat kutipan Bayaran Tambahan Persekolahan bagi semua murid. Cadangan kutipan ini
                                telah dibentangkan dan dipersetujui dalam Mesyuarat Agung PIBG yang lalu.</li><br>

                            <li>Senarai kutipan bayaran tambahan yang telah diluluskan disertakan bersama surat ini.
                                Ibubapa/Penjaga boleh menjelaskan bayaran tambahan PIG melalui guru kelas anak
                                masing-masing atau melalui sistem SPPIBG</li><br>

                            <li>Diharap tuan/puan dapat memberi kerjasama untuk melancarkan kutipan bayaran ini demi
                                kebajikan anak masing-masing. Kerjasama dan keprihatinan tuan/puan amat dihargai dan
                                didahului dengan ucapan terima kasih.</li>
                        </ol>

                        <p>Sekian, Terima kasih</p>
                            <h4><strong>"WAWASAN KEMAKMURAN BERSAMA 2030"</strong></h4>
                            <h4><strong>"BERKHIDMAT UNTUK NEGARA"</strong></h4>
                        <p>Saya yang Menjalankan Amanah,</p>
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col" >

                        <h4 class="p-4" style="text-align: center"><strong>KADAR BAYARAN TAMBAHAN
                                PERSEKOLAHAN PIBG TAHUN 2021 </strong></h4>

                                <div class="table"style="display: flex; align-items:center; flex-direction:column">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Perkara</th>
                                                @for ($i = 1; $i <= 6; $i++) <th>Tahun {{ $i }} (RM)</th>
                                                    @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Yuran (Per Keluarga)</td>
                                                @foreach ($fees as $fee)
                                                <td>{{ $fee['total_yuran'] }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Yuran Tambahan</td>
                                                @foreach ($fees as $fee)
                                                <td>{{ $fee['total_yuran_tambahan'] }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><strong>Jumlah Besar</strong></td>
                                                @php
                                                $total_yuran = array_sum(array_column($fees, 'total_yuran'));
                                                $total_yuran_tambahan = array_sum(array_column($fees, 'total_yuran_tambahan'));
                                                @endphp
                                                @for ($i = 1; $i <= 6; $i++) @php $total=($i <=count($fees)) ?
                                                    $fees[$i-1]['total_yuran'] + $fees[$i-1]['total_yuran_tambahan'] : '' ; @endphp
                                                    <td><strong>{{ $total }}</strong></td>
                                                    @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        



                    </div>
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
</body>

</html>
