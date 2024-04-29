@extends('layouts.user_type.auth')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman Utama</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">{{ str_replace(['admin/', '-'], ' ', Request::path()) }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{asset('assets\img\avatar.png')}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{Auth()->user()->name}}</h3>

                            <p class="text-muted text-center">{{$user->nama_akses}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <strong><i class="fas fa-envelope"></i> Email</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->email}}
                                </p>


                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->address}}

                                </p>


                                <strong><i class="fas fa-phone"></i> Nombor Telefon</strong>

                                <p class="text-muted">
                                    {{Auth()->user()->no_phone}}

                                </p>


                                <a href="{{route('borang-profil', $user->id)}}" class="btn btn-primary btn-block"><b>Kemaskini</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->



                <div class="col-md-9">
                    <div class="col-md-12">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <!-- Previous Page Link -->
                                @if ($buletin->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Sebelumnya</span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $buletin->previousPageUrl() }}"
                                        rel="prev">Sebelumnya</a>
                                </li>
                                @endif

                                <!-- Page Links -->
                                @foreach ($buletin->getUrlRange(1, $buletin->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $buletin->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                                @endforeach

                                <!-- Next Page Link -->
                                @if ($buletin->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $buletin->nextPageUrl() }}" rel="next">Seterusnya</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">Seterusnya</span>
                                </li>
                                @endif
                            </ul>
                        </nav>
                        <!-- End Pagination -->
                    </div>
                    @foreach ($buletin as $item)
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{$item->nama_buletin}}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>
                                @if($item->penerangan)
                                    {{$item->penerangan}}
                                @endif

                                @if ($item->fail)
                                
                                <a target="_blank" href="{{asset('uploads/buletin/'. $item->fail)}}">klik di sini</a>
                                @endif

                            </p>
                        </div>
                    </div>
                    @endforeach

                </div>

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
@endsection
