<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    @include('layouts._style')

</head>
<body>
<div>
    @include('layouts._nav')
    <div class="container-fluid mt-2">
        @yield('content')
    </div>
</div>

@include('layouts._scripts')
@if(Session::has('message'))
    <script>
        $(document).ready(function () {
            notify("{!! Session::get('message')['msg']!!}", "{!! Session::get('message')['type']!!}");
        });
    </script>
@endif
</body>
</html>
