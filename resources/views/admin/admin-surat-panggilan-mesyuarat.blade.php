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
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{asset('dist/css/adminlte.min.css')}} ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}} ">
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f4f6f9; */
        }

        .wrapper {
            padding: 20px;
            max-width: 100%;
            overflow-x: hidden;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* img {
            max-width: 100%;
            height: auto;
        } */
/* 
        @media (max-width: 767px) {
            .header {
                text-align: center;
            }

            .content {
                padding-left: 0;
                padding-right: 0;
            }

            .print-button-container {
                text-align: center;
            }

            .alamat p {
                text-align: center;
            }

            .title {
                text-align: center;
            }

            .mesyuarat-detail {
                padding-left: 0;
            }

            .mesyuarat-detail table {
                margin: 0 auto;
            }
        } */

        @media print {
            /* Hide the print button and other non-essential elements */
            .print-button-container {
                display: none;
            }

            /* Limit the width of the printed content */
            body {
                max-width: 800px;
                margin: auto;
            }

            /* Adjust text color for printing */
            p,
            h5,
            ul,
            ol,
            h6 {
                color: black;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Content Wrapper. Contains page content -->
    <div class="wrapper" style="background-color: #f4f6f9">
        <section class="content p-2" id="printable-content">
            <div class="print-button-container">
                <a onclick="printCard()" class="btn btn-app bg-secondary">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">

                        <div class="header">
                            <img src="{{asset('assets\img\logo_sekolah.png')}}" class="img-fluid" style="width: 110px; height: 110px;" alt="">
                            <h4>SEKOLAH KEBANGSAAN JALAN MATANG BULUH</h4>
                            <p>No 1, Jalan Matang Buluh, Kampung Alor Senggut, </p>
                            <p>34300 Bagan Serai, Perak</p>
                        </div>
                        <hr style="border: 0; height: 2px; background-color: black; font-weight: bold;">
                        <div class="content">
                            <div class="row">
                                <div class="col">
                                    <div style="text-align: end">
                                        <p class="rujukan">Rujukan: PIBG/SKJMB {{$data->id_panggilan}}/{{ ucwords(\Carbon\Carbon::parse($data->created_at)->locale('ms_MY')->isoFormat('YYYY')) }}</p>
                                        <p class="rujukan">Tarikh: {{ ucwords(\Carbon\Carbon::parse($data->created_at)->locale('ms_MY')->isoFormat('D MMMM YYYY')) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="alamat">
                                        <p>Ke Majlis,</p>
                                        @foreach($userRole as $role)
                                        <p>{{ $role }},</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p>Tuan/Puan</p>
                            <div class="title">
                                <h5 style="text-decoration:underline;">{{$data->nama_panggilan}}</h5>
                            </div>
                            <br>
                            <p>Dengan segala hormatnya perkara di atas adalah dirujuk</p>
                            <ol style="list-style: decimal" start='2'>
                                <li style="text-indent: 20px"> Sehubungan dengan itu, tuan/puan dijemput menghadiri
                                    mesyuarat di atas sebagaimana berikut:</li>
                            </ol>
                            <div class="mesyuarat-detail" style="padding-left:80px">

                                <table>
                                    <tr>
                                        <td>
                                            <p><strong>Tarikh</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>:</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>{{ ucwords(\Carbon\Carbon::parse($data->tarikh)->locale('ms_MY')->isoFormat('D MMMM YYYY')) }}</strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><strong>Masa</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>:</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>{{ \Carbon\Carbon::parse($data->masa_mula)->locale('ms_MY')->isoFormat('h:mm A') }}</strong></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><strong>Tempat &nbsp;</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>:</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>{{$data->tempat}}</strong></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <ol style="list-style: decimal; text-indent:25px" start='3'>
                                <li>
                                    <p>Agenda Mesyuarat adalah seperti Berikut: </p>
                                    <ol type="a">
                                        @foreach ($listItems as $item)
                                        <li>{{ $item}}</li>
                                        @endforeach
                                    </ol>
                                    <br>
                                <li>
                                    <p>Kehadiran Tuan/Puan amatlah dihargai bagi memantapkan lagi fungsi PIBG dan Kecemerlangan
                                        pelajar serta kemajuan sekolah ini
                                    </p>
                                </li>
                                </li>
                            </ol>
                            <br>
                            <p>Sekian, Terima kasih</p>
                            <h6 style="font-weight:normal">"BERSAMA KEARAH KECEMERLANGAN"</h6>
                            <p>Saya yang Menjalankan Amanah,</p>
                            <img src="{{asset('/uploads/tandatangan/' .$data->tandatangan)}}" alt="" class="img-fluid"
                                style="width: 200px; height:100px">
                            {{-- <p style="text-transform:uppercase">({{Auth()->user()->name}})</p> --}}
                            <p>Setiausaha</p>
                            <p>Persatuan Ibu Bapa dan Guru</p>
                            <p>SK. Jalan Matang Buluh</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
