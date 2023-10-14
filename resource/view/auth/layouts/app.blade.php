<!doctype html>
<html lang="en">

<head>
    @include('auth.layouts.head-tag')
    @yield('head-tag')
</head>


<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @yield('content')

</body>

@include('auth.layouts.scripts')
@yield('script')

</html>
