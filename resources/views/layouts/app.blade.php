<html>

<head>

    @include('includes.head')
    @yield('jsscript')

</head>

<body class="d-flex flex-column h-100">
   <div class="container-fluid">
        <header>
            @include('includes.header')
        </header>
    
        <!-- main content -->
        <main role="main">
            @yield('content')
        </main>
        
        <footer class="footer mt-auto py-3">
            @include('includes.footer')
        </footer>
    </div>
</body>

</html>