<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


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
<body class="hold-transition sidebar-mini layout-fixed">


    <div class="content-wrapper" style="margin-left:0">

        <section class="content">
            <div class="container">
                <div class="row" style="justify-content: center; padding-top:20px">
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                @if ($data->nama_acara)
                                    <h3 class="card-title">
                                        Butiran Acara
                                    </h3>
                                @else
                                    <h3 class="card-title">
                                        Butiran Mesyuarat
                                    </h3>
                                @endif

                                @if (Auth::user()->access_code == 1 || Auth::user()->access_code == 2 || Auth::user()->access_code == 3 )
                                <div class="more float-right">
                                    <a class="dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('admin.kalendar-edit', [$data->id])}}">Kemaskini</a>
                                        <a class="dropdown-item" href="{{route('admin.kalendar-delete', [$data->id])}}" id="deleteEvent" >Padam</a>
                                    </div>

                                </div>
                                @else

                                @endif
                                
                                
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <tbody>
                                      <tr>
                                        <td> <strong>Tarikh</strong></td>
                                        <td>{{$formatted_date}}</td>
                                      </tr>
                                      <tr>
                                        @if ($data->nama_acara)
                                            <td><strong>Nama Acara</strong> </td>
                                            
                                        @else
                                            <td><strong>Nama Mesyuarat</strong> </td>
                                            
                                        @endif

                                        <td>{{$data->nama_acara ? $data->nama_acara : $data->nama_mesyuarat}}</td>
                                      </tr>
                                      <tr>
                                        <td><strong>Masa</strong> </td>
                                        <td>{{ \Carbon\Carbon::parse($data->masa_mula)->format('h:i A') }} - {{ \Carbon\Carbon::parse($data->masa_tamat)->format('h:i A') }}</td>
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.getElementById('deleteEvent').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default anchor behavior

        Swal.fire({
            title: 'Adakah anda pasti?',
            text: 'Anda akan memadam acara',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, pasti',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, navigate to the delete URL
                window.location.href = this.href;
            }
        });
    });
</script>
</body>

</html>
