<!DOCTYPE html>
<html lang="en">

<head>
    @include('app.layouts.head')
    @yield('head-tag')
</head>

<body class="text-right">
    @include('app.layouts.navbar')
    <!-- END nav -->
    @yield('content')

    @include('app.layouts.footer')

</body>
</html>
