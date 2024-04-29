@extends('layouts.user_type.auth')

@section('content')

<style>
    /* Hide the default radio button */
    input[type="radio"] {
        display: none;
    }

    /* Style the label as the clickable element */
    label.btn {
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 5px;
        background-color: #17a2b8; 
        color: #fff; 
    }

    /* Style the label when the radio button is checked */
    input[type="radio"]:checked + label.btn {
        background-color: #007bff; 
    }

    /* Show the custom amount input when its radio button is checked */
    .custom-amount input[type="number"] {
        display: none;
    }

    /* .custom-amount input[type="radio"]:checked + input[type="number"] {
        display: block;
    } */

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sumbangan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid ">
            <div class="card-body pb-0">
                <div class="row">

                    @foreach ($sumbangan as $item)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Sumbangan Ikhlas

                                {{-- @if ($pengguna && $item->id == $pengguna->id_sumbangan)
                                <span class="fas fa-check-circle" style="color: green;"></span>
                                @endif --}}


                                <span
                                    class="float-right">{{ \Carbon\Carbon::parse($item->created_at)->format('j F Y') }}</span>

                            </div>
                            <div class="card-body pt-0">
                                <h2 class="lead"><b>{{$item->nama_sumbangan}}</b> </h2>
                                <p class="text-muted text-sm">{{$item->penerangan}} </p>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-bullseye"></i></span>Jumlah
                                        Sasaran: RM {{$item->jumlah_sasaran}}</li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-donate"></i></span>Jumlah
                                        Kutipan: RM {{ $jumlah_kutipan[$item->id]->total_kutipan ?? 0 }}</li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    {{-- <a href="#" class="btn btn-sm btn-primary">
                                        Jom Menyumbang
                                    </a> --}}
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#paymentModal-{{ $item->id }}" data-id-sumbangan='{{$item->id}}'>
                                        Jom Menyumbang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="paymentModal-{{ $item->id }}" tabindex="-1" role="dialog">

                        <div class="modal-dialog modal-lg" role="document">

                            <div class="modal-content">


                                <div class="modal-header">
                                    <h4 class="modal-title">Sumbangan Ikhlas</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form id="paymentForm-{{ $item->id }}" action="{{route('pembayaran-sumbangan')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{$item->id}}" name='id_sumbangan'>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="radio" id="amount1-{{$item->id}}" name="amount" value="10">
                                                <label for="amount1-{{$item->id}}" class="btn btn-block btn-info">Rm 10</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" id="amount2-{{$item->id}}" name="amount" value="30">
                                                <label for="amount2-{{$item->id}}" class="btn btn-block btn-info">Rm 30</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" id="amount3-{{$item->id}}" name="amount" value="50">
                                                <label for="amount3-{{$item->id}}" class="btn btn-block btn-info">Rm 50</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="custom-amount">
                                                    <label for="customAmount-{{$item->id}}" class="btn btn-block btn-info">Jumlah lain</label>

                                                    <input type="radio" id="customAmount-{{$item->id}}" name="amount" value="custom">
                                                    <input type="number" id="customInput" name="customAmount"
                                                        placeholder="Masukkan Jumlah Lain" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Sah Pembayaran</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    @endforeach


                </div>
            </div>

            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
<script>
$(document).ready(function() {
    // Show/hide custom amount input based on radio button state
    $('input[name="amount"]').change(function() {
        var modal = $(this).closest('.modal'); // Get the closest modal container
        var customInput = modal.find('input[name="customAmount"]'); // Find the custom amount input within the modal
        if ($(this).val() === 'custom') {
            customInput.show();
        } else {
            customInput.hide();
        }
    });
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

@if (Session::get('error'))
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
        icon: "error",
        title: "{{Session::get('error')}}"
    });

</script>
@endif


@endsection
