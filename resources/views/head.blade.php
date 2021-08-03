@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/calc.js') }}"></script>
    <script src="{{ asset('js/beforeMonthShow.js') }}"></script>
    <script src="{{ asset('js/monthRegister.js') }}"></script>
    <script src="{{ asset('js/todayRegister.js') }}"></script>
    <script src="{{ asset('js/infoRegister.js') }}"></script>
@endsection