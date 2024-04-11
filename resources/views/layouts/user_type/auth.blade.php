@extends('layouts.app')

@section('auth')

{{-- @include('layouts.navbars.auth.sidebar-admin') --}}
{{-- @include('layouts.navbars.guest.nav')

    @yield('content')

@include('layouts.footers.guest.footer') --}}

@if(Auth::user()->access_code ==1 || Auth::user()->access_code == 2|| Auth::user()->access_code ==3)
        @include('layouts.navbars.auth.sidebar-admin')
    @else
        @include('layouts.navbars.auth.sidebar-user')
@endif

<main class="main-content">
    @include('layouts.navbars.auth.nav')
    <div class="py-0">
        @yield('content')
    @include('layouts.footers.auth.footer')

    </div>

</main>


@endsection