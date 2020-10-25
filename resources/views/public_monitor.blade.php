<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $monitor->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <div class="container mx-auto">
        <h1 class="text-xl text-center my-3">{{ $monitor->name }}</h1>
        <div class="my-3 text-center text-sm">
            <code class="text-pink-500">{{ $monitor->url }}</code>
        </div>
        <div class="my-3">
            <x-ping-status :ping="$pings->reverse()->last()" />
        </div>
        @if(!$monitor->activated)
            <div class="my-3 bg-yellow-500 text-center text-white font-bold px-2 py-1">
                MONITORING PAUSED
            </div>
        @endif

        <div class="border border-gray-400 bg-white p-3 rounded my-3 shadow">
            <x-ping-line-chart :pings="$pings" name="$monitor->name" :displayStat="true" />
        </div>

        <div class="my-10 text-center text-gray-600 text-xs">
            Powered by {{ config('app.name') }}
        </div>

    </div>
<script src="{{ asset('js/app.js') }}"></script>
    @stack('footer')
    <script>
        setTimeout(function(){
            window.location.reload()
        }, 60000);
    </script>
</body>
</html>
