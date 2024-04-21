@extends('layouts.user_type.auth')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>iQr-reader</h1>
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
        <div class="container-fluid">
            <!-- Default box -->
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="scanner" style="display: flex; flex-direction:column; align-items:center">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video id="preview" class="embed-responsive-item"></video>

                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    scanner.addListener('scan', function (content) {
        console.log('Scanned:', content);
        // Send the scanned content to the server
        $.ajax({
            url: "{{ route('qr-simpan') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                content: content
            },
            success: function (response) {
                console.log(response);
                if (response.message === 'User not found') {
                     // Show SweetAlert2 popup
                Swal.fire({
                    icon: 'error',
                    title: 'Maklumat anda tidak dijumpai',
                    text: 'Maklumat anda tidak dijumpai dalam mesyuarat ini',
                    showConfirmButton: false,
                    timer: 2000 // Close the popup after 2 seconds
                });
                } else {
                    window.location.href = "{{ route('qr-berjaya') }}";
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                // Optionally, show an error message or handle the error
            }
        });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (error) {
        console.error('Error accessing camera:', error);
    });

</script>


@endsection
