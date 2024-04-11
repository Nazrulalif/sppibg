@extends('layouts.user_type.auth')

@section('content')
<!-- Add this to your HTML file -->
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan</h1>
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
        <div class="container-fluid" id="printable-content">
           
            <div class="card p-5" >
                <div class="row">
                    <div class="col-12">
                        <div class="print-button-container">
                            <button class="btn btn-default float-right" onclick="printCard()"><i class="fas fa-print"></i> Print</button>
                        </div>
                    </div>
                </div>
                {{-- <div class="card-header">
                    <h3 class="card-title">Laporan Usul Mesyuarat</h3>
                </div> --}}
                <div class="header"
                    style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <h3 class="card-title">Laporan Usul</h3>
                    <h3 class="card-title">{{$mesyuarat->nama_mesyuarat}}</h3>
                    <h3 class="card-title">SK Jalan Matang Buluh, Bagan Serai, Perak</h3>
                </div>
                <div class="card-body p-3 pt-5 mb-3" >

                    @foreach ($ulasan->groupBy('nama_kategori') as $category => $items)
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>{{ $category}}</th>
                            </tr>
                        </thead>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Usul</th>
                                    <th>Pengusul</th>
                                    <th>Ulasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->usul }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->ulasan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </table>
                    <br>
                    @endforeach






                </div>



            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
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
