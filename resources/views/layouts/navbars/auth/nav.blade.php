<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @if (Auth::user()->access_code == 5 )

        <li class="nav-item">
            <a class="nav-link" href="{{route('qr-reader')}}">
                <i class="nav-icon fas fa-qrcode"></i>

            </a>
            
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.qr-reader')}}">
                <i class="nav-icon fas fa-qrcode"></i>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">
                <i class="fas fa-sign-out-alt" title="Log keluar"></i>

            </a>
            
        </li>
    </ul>
</nav>