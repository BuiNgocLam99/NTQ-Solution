<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1" data-preloader="disable">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <title>@yield('title')</title>

    @include('admin.layouts.styles')

    @stack('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    
    @yield('content')

    @include('admin.layouts.scripts')

    @stack('scripts')
</body>
</html>