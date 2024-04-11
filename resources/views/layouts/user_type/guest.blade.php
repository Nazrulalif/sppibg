@extends('layouts.app')

@section('guest')

{{-- @include('layouts.navbars.guest.nav') --}}
{{-- @include('layouts.navbars.auth.sidebar-admin') --}}


    @yield('content')

{{-- @include('layouts.footers.guest.footer') --}}

@endsection
