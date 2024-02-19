<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include ('includes.header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @yield('content')
    </div>
    @include ('includes.scripts')
</body>

</html>
