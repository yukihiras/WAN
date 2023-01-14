<!-- Header -->
@include('adminView.component.headerAndScript');
@php
    $objUser = \Illuminate\Support\Facades\Auth::user();
@endphp

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('adminBunker')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
             height="60" width="60">
    </div>


    <!-- Navbar -->
    @include('adminView.component.navBarTop')


    <!-- Main Sidebar Container -->
    @include('adminView.component.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')

    <!-- Footer -->
    @include('adminView.component.footer')
</div>



