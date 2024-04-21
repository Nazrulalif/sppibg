

<aside class="main-sidebar elevation-4 sidebar-light-primary" style="background-color: #f4f6f9">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="background-color: #ffffff">
        <img src="{{asset('assets\img\logo_sekolah.png')}} " alt="AdminLTE Logo" class="brand-image img-circle
        elevation-0"
        style="opacity: .8">
        <span class="brand-text font-weight-bold ">SPPIBG (User)</span>
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
                    <a href="{{route("admin.laman-utama")}}" class="nav-link {{ (Request::is('admin/laman-utama') ? 'active' : '') }}" >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                </li>
                
                <li class="nav-item ">
                    <a class="nav-link {{ (Request::is('admin/pengguna') ? 'active' : '') }}" href="{{route("admin.pengguna")}}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Pengguna
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (Request::is('admin/kalendar-acara') ? 'active' : '') }}" href="{{route('admin.kalendar-acara')}}">
                        <i class="nav-icon fas fa-solid fa-calendar"></i>
                        <p>
                            Acara
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ (Request::is('admin/kalendar-acara', 'admin/tinjauan-acara') ? 'menu-is-opening menu-open' : '') }} ">
                    <a href="#" class="nav-link {{ (Request::is('admin/kalendar-acara', 'admin/tinjauan-acara') ? 'active' : '') }} ">
                        <i class="nav-icon fas fa-solid fa-calendar"></i>
                        <p>
                            Acara
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.kalendar-acara')}}" class="nav-link {{ (Request::is('admin/kalendar-acara') ? 'active' : '') }} ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kalendar Acara</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.tinjauan-acara')}}" class="nav-link {{ (Request::is('admin/tinjauan-acara') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tinjauan Acara</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item {{ (Request::is('admin/mesyuarat','admin/panggilan-mesyuarat-surat*', 'admin/usul_laporan*', 'admin/mesyuarat-butiran*', 'admin/kehadiran', 'admin/kehadiran-qr*') ? 'menu-is-opening menu-open' : '') }}">
                    <a href="#" class="nav-link {{ (Request::is('admin/mesyuarat', 'admin/panggilan-mesyuarat-surat*', 'admin/usul_laporan*', 'admin/mesyuarat-butiran*', 'admin/kehadiran', 'admin/kehadiran-qr*') ? 'active' : '') }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            Mesyuarat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.panggilan-mesyuarat')}}" class="nav-link {{ (Request::is('admin/mesyuarat','admin/panggilan-mesyuarat-surat*', 'admin/usul_laporan*', 'admin/mesyuarat-butiran*') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Senarai Mesyuarat</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{route('admin.usul-mesyuarat')}}" class="nav-link {{ (Request::is('admin/usul-mesyuarat') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usul Mesyuarat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.minit-mesyuarat')}}" class="nav-link {{ (Request::is('admin/minit-mesyuarat') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Minit Mesyuarat</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('admin.kehadiran')}}" class="nav-link {{ (Request::is('admin/kehadiran', 'admin/kehadiran-qr*') ? 'active' : '') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kehadiran</p>
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
                    <a href="{{route('admin.sumbangan')}}" class="nav-link {{ (Request::is('admin/sumbangan') ? 'active' : '') }}">
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
