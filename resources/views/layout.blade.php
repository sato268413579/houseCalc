<!DOCTYPE html>
<html>
<head>
    @yield('head')
</head>
<body>
    <header>
        @yield('header')
    </header>
    <div id="wrapper">
        @yield('content')
        <script src="{{ asset('js/navActive.js') }}"></script>
    </div>
    <footer>
        <!-- 省略 -->
    </footer>
    <script src="js/app.js"></script>
</body>
</html>