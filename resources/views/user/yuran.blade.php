@extends('layouts.user_type.auth')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pembayaran Yuran</h1>
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
            {{-- <div align="right" id="non-printable"><a class="btn btn-app" onclick="javascript:window.print()">
                    <i class="fa fa-print"></i> Cetak </a>
                <a href="" target="_blank" class="btn btn-app">
                    <i class="fa fa-credit-card"></i>
                    Bayar </a>
            </div> --}}
            <!-- Default box -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Penyata Yuran</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="container-fluid bootstrap-iso box-body">
                        <div class="form-row col-md-12">
                            <div class="col-md-2">
                                <strong>Nama Penuh</strong>
                            </div>
                            <div class="col-md-4 mb-10">
                                <p>{{$user->name}}</p>
                            </div>
                            <div class="col-md-2">
                                <strong>Hubungan</strong>
                            </div>
                            <div class="col-md-4 mb-10">
                                <p>{{$user->hubungan}}</p>
                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="col-md-2">
                                <strong>Akses</strong>
                            </div>
                            <div class="col-md-10  mb-10">
                                <p>{{$user->nama_akses}}</p>
                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="col-md-2">
                                <strong>Status</strong>
                            </div>
                            <div class="col-md-10  mb-10">
                                @if ($user->verified == 1)
                                <p>Aktif</p>
                                @else
                                <p>Belum disahkan</p>
                                @endif


                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="col-md-2">
                                <strong>Nombor Kad Pengenalan</strong>
                            </div>
                            <div class="col-md-10  mb-10">
                                <p>{{$user->no_ic}}</p>

                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="col-md-2">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-10 mb-10">
                                <p>{{$user->address}}</p>

                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="col-md-2">
                                <strong>Nombor telefon</strong>
                            </div>
                            <div class="col-md-4 mb-10">
                                <p>{{$user->no_phone}}</p>
                            </div>
                            <div class="col-md-2">
                                <strong>Emel</strong>
                            </div>
                            <div class="col-md-4 mb-10">
                                <p>{{$user->email}}</p>
                            </div>
                        </div>

                    </div><br>



                    <table class="table table-bordered">
                        <thead class="bg-navy">
                            <tr>
                                <th>Tahun</th>
                                <th>Nama Pelajar</th>
                                <th>Kelas</th>
                                <th>Yuran (Per Keluarga) (RM)</th>
                                <th>Yuran Tambahan (RM)</th>
                                <th>Jumlah Yuran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $family = []; // Array to track paid PIBG fees for each family
                            @endphp
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->tahun_yuran }}</td>
                                <td>{{ $student->nama_pelajar }}</td>
                                <td>{{ $student->tahun_pelajar_id }} {{$student->kelas}}</td>
                                @php
                                // Check if the student is the first child in the family for the current year
                                if (!in_array($student->tahun_yuran, array_keys($family))) {
                                $family[$student->tahun_yuran] = $student->yuran ; // Set the PIBG fee for the family
                                $fee = $student->yuran + $student->yuran_tambahan; // First child pays the PIBG fee
                                } else {
                                $fee = $student->yuran_tambahan; // Additional children pay the additional fee only
                                }
                                @endphp
                                <td>{{ $student->yuran }}</td>
                                <td>{{ $student->yuran_tambahan }}</td>
                                <td>{{ $fee }}</td>
                                <td>
                                    @if (!$student->status)
                                    @if ($student->paymentStatus == 'Selesai')
                                    Selesai
                                    @else
                                    <button type="button" class="btn btn-block btn-default pay-btn" data-toggle="modal"
                                        data-target="#paymentModal-{{ $fee }}" data-fee="{{ $fee }}"
                                        data-student-id="{{ $student->id }}" data-yuran-id='{{ $student->id_yuran}}'>
                                        <i class="fa fa-credit-card"></i> Bayar
                                    </button>
                                    @endif
                                    @else
                                    Selesai
                                    @endif
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="paymentModal-{{ $fee }}" tabindex="-1" role="dialog"
                                aria-labelledby="paymentModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="paymentModalLabel">Butiran Bayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="paymentForm-{{ $fee }}" action="{{ route('pembayaran-yuran') }}"
                                            method="POST" style="display: none;" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                Tahun : {{ $student->tahun_yuran }} <br>
                                                Nama : {{ $student->nama_pelajar }} <br>
                                                Kelas : {{ $student->tahun_pelajar_id }} {{$student->kelas}} <br>
                                                Jumlah Yuran: RM {{ $fee }} <br>

                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <input type="hidden" name="fee" value="{{ $fee }}">
                                                <input type="hidden" name="id_yuran" value="{{ $student->id_yuran }}">
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary confirmPayment"
                                                    data-fee="{{ $fee }}">Mengesahkan pembayaran</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>

                    </table>

                </div>

                <!-- /.card-body -->
            </div>
            {{-- <a type="button" class="btn btn-secondary">Laman Utama</a> --}}

            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>

<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>

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

{{-- <script>
$(document).ready(function() {
    $('.confirmPayment').click(function() {
        var studentId = $(this).data('student-id');
        var fee = $(this).data('fee');
        var id_yuran = $(this).data('yuran-id');

        // Send an AJAX request to store the payment information
        $.ajax({
            url: '{{ route("pembayaran-yuran") }}',
method: 'POST',
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
data: {
student_id: studentId,
fee: fee,
id_yuran: id_yuran,
},
success: function(response) {
// Handle success response
console.log('Payment stored successfully');
console.log(response);
window.location.reload();
},
error: function(xhr, status, error) {
// Handle error
console.error('Error storing payment: ' + error);
}
});
});
});

</script> --}}


@endsection
