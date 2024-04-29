

<aside class="main-sidebar elevation-4 sidebar-light-primary" style="background-color: #f4f6f9">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color: #ffffff">
        <img src="{{asset('assets\img\logo_sekolah.png')}} " alt="AdminLTE Logo" class="brand-image img-circle
        elevation-0"
        style="opacity: .8">
        <span class="brand-text font-weight-bold ">SPPIBG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets\img\avatar.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route("laman-utama")}}" class="nav-link {{ (Request::is('laman-utama', 'borang-profil*') ? 'active' : '') }}" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (Request::is('kalendar-acara') ? 'active' : '') }}" href="{{route('kalendar-acara')}}">
                        <i class="nav-icon fas fa-solid fa-calendar"></i>
                        <p>
                            Acara
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Request::is('mesyuarat', 'rekod-kehadiran', 'minit-mesyuarat') ? 'menu-is-opening menu-open' : '') }}">
                    <a href="#" class="nav-link {{ (Request::is('mesyuarat', 'rekod-kehadiran', 'minit-mesyuarat') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            Mesyuarat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('mesyuarat')}}" class="nav-link {{ (Request::is('mesyuarat') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Panggilan Mesyuarat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('minit-mesyuarat')}}" class="nav-link {{ (Request::is('minit-mesyuarat') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Minit Mesyuarat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('rekod-kehadiran')}}" class="nav-link {{ (Request::is('rekod-kehadiran') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekod Kehadiran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('qr-reader')}}" class="nav-link {{ (Request::is('qr-reader') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-qrcode"></i>
                        <p>
                            iQR Reader
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('yuran')}}" class="nav-link {{ (Request::is('yuran') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Yuran
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sumbangan')}}" class="nav-link {{ (Request::is('sumbangan') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Sumbangan
                        </p>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
