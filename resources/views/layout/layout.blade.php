<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>AKS Machine Test</title>
    @include('includes.styles')
</head>
<body>
    <!-- ======= Header ======= -->
        @include('includes.header')
    <!-- End Header -->

    <!-- Main Content -->
        @yield('content')
    <!-- End #main -->

    <!-- ======= Footer ======= -->
        @include('includes.footer')
    <!-- End Footer -->

    @include('includes.script')
</body>
</html>