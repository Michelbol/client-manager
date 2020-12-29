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
    @yield('content')
</div>

@include('layouts._scripts')

</body>
</html>
