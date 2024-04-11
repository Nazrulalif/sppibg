@extends('layouts.user_type.auth')

@section('content')
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
<link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

<style>
    @media print {
        /* Hide the print button and other non-essential elements */
        .print-button-container {
            display: none;
        }

        /* Limit the width of the printed content */
        body {
            max-width: 800px; /* Adjust this value as needed */
            margin: auto; /* Center the content on the printed page */
        }

        /* Optional: Adjust other styles for better printing */
        p,
        h5,
        ul,
        ol,
        h6 {
            color: black;
        }
    }

    /* Styles that apply to both screen and print */
    /* p, */
    h5,
    ul,
    ol,
    h6 {
        color: black;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Main content -->
<section class="content p-5" id="printable-content">

    <!-- Default box -->
    <div class="container-fluid">
        <div class="card p-5">

            <div class="float-right">

                <div class="print-button-container">
                    <button class="btn btn-default float-right" onclick="printCard()"><i class="fas fa-print"></i>
                        Print</button>
                </div>
            </div>

            
            <div class="card-body p-6 pt-0 mb-3" id="printable-content">

                <div class="header">
                    <div class="row">
                        <div class="col-auto">
                            <img src="{{asset('assets\img\logo_sekolah.png')}}" class="img-fluid"
                                style="width: 110px; height: 110px;" alt="">
                        </div>
                        <div class="col">
                            <h4>SEKOLAH KEBANGSAAN JALAN MATANG BULUH</h4>
                            <p>No 1, Jalan Matang Buluh, Kampung Alor Senggut, </p>
                            <p class="" style="line-height: 5px;">34300 Bagan Serai, Perak</p>
                        </div>
                    </div>
                </div>
                <hr style="border: 0; height: 2px; background-color: black; font-weight: bold;">
                <div class="content">
                    <div class="row">
                        <div class="col">
                            <div style="text-align: end">
                                <p class="rujukan">Rujukan: PIBG/SKJMB
                                    {{$data->id_panggilan}}/{{ ucwords(\Carbon\Carbon::parse($data->created_at)->locale('ms_MY')->isoFormat('YYYY')) }}
                                </p>
                                <p class="rujukan" style="line-height: 5px;">Tarikh:
                                    {{ ucwords(\Carbon\Carbon::parse($data->created_at)->locale('ms_MY')->isoFormat('D MMMM YYYY')) }}
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="alamat">
                                
                                <p>Ke Majlis,</p>
                                @foreach($userRole as $role)
                                    <p class="" style="line-height: 5px;">{{ $role }},</p>
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
                    <div class="mesyuarat-detail" style="padding-left:130px">

                        <table>
                            <tr>
                                <td>
                                    <p><strong>Tarikh</strong></p>
                                </td>
                                <td>
                                    <p><strong>:</strong></p>
                                </td>
                                <td>
                                    <p><strong>{{ ucwords(\Carbon\Carbon::parse($data->tarikh)->locale('ms_MY')->isoFormat('D MMMM YYYY')) }}
                                        </strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="" style="line-height: 5px;"><strong>Masa</strong></p>
                                </td>
                                <td>
                                    <p class="" style="line-height: 5px;"><strong>:</strong></p>
                                </td>
                                <td>
                                    <p class="" style="line-height: 5px;">
                                        <strong>{{ \Carbon\Carbon::parse($data->masa_mula)->locale('ms_MY')->isoFormat('h:mm A') }}
                                        </strong></p>
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

                                <li>
                                    <p class="" style="line-height: 5px;">{{ $item}}</p>
                                </li>
                                @endforeach
                            </ol><br>

                        <li>
                            <p>Kehadiran Tuan/Puan amatlah dihargai bagi memantapkan lagi fungsi PIBG dan
                                Kecemerlangan
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
                    <p style="text-transform:uppercase">({{Auth()->user()->name}})</p>
                    <p class="" style="line-height: 5px;">Setiausaha</p>
                    <p class="" style="line-height: 5px;">Persatuan Ibu Bapa dan Guru</p>
                    <p class="" style="line-height: 5px;">SK. Jalan Matang Buluh</p>

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
@endsection
