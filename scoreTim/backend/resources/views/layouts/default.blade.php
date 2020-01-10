<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>
    <!-- sidebar -->
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">  
        @include('includes.sidebar')
    </nav>
    <div class="main-content">
        <!-- header -->
        @include('includes.header')
        <!-- content -->
        @yield('content')
    </div>
    <!-- footer -->
    <footer class="footer">
        @include('includes.footer')
    </footer>
    @include('includes.script')

</body>
</html>


