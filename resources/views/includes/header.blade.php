<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<!-- Favicon -->
{{-- <link rel="icon" href="{{ asset('admin/dist/img/fav-icon.png') }}" type="images/png" sizes="16x16" class="loading-img"> --}}

<title>Laravel</title>
{{-- <title>Admin |
    @hasSection('page-title')
        @yield('page-title')
    @else
        {{ \Request::route()->getName() }}
    @endif
</title> --}}

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/49bc342b2c.js" crossorigin='anonymous' type='text/javascript' defer></script>
<!-- IonIcons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('plugin/adminLte/css/OverlayScrollbars.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('plugin/adminLte/css/adminlte.min.css') }}">

@hasSection('style')
    @yield('style')
@endif
