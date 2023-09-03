@include('home.layouts.header')

<body>
    <!-- ====== Navbar Section Start -->
    @include('home.layouts.nav')
    <!-- ====== Navbar Section End --> <!-- ====== Hero Section Start -->


    @yield('content')


    <!-- ====== Footer ====== -->
    <!-- ====== Footer Section Start -->
    @include('home.layouts.footer')
    <!-- ====== Footer Section End -->

    <!-- ====== All Scripts -->
    <!-- ====== All Scripts -->
    @include('home.layouts.scripts')
    @stack('scripts')
</body>

</html>