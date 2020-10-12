<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="bg-orange-600 pt-3 pb-8" x-data="{ open: false }">
        <div class="container mx-auto">
            <div class="text-center">
                <h1 class="my-3 font-serif text-5xl text-white font-bold">{{ config('app.name') }}</h1>
                <h2 class="my-3">Website, API monitoring</h2>
            </div>
        </div>


    </div>

    @guest
        <div class="my-3 flex justify-center">
            <div class="w-1/4 bg-gray-200 border border-gray-400 rounded">
                <div class="text-center py-1 border-b border-gray-400 text-gray-800">{{ __('auth.login') }}</div>
                <div class="p-3">
                    <form action="{{ route('login.submit') }}" method="post">
                        @csrf
                        @if(!$errors->isEmpty())
                            <div class="my-3 text-red-500 italic">{{ __('auth.failed') }}</div>
                        @endif
                        <div class="block my-3">
                            <input type="email" name="email" class="appearance-none focus:outline-none focus:shadow-outline border w-full border-gray-100 p-2" placeholder="{{ __('auth.form.email') }}">
                        </div>
                        <div class="block my-3">
                            <input type="password" name="password" class="appearance-none focus:outline-none focus:shadow-outline border w-full border-gray-100 p-2" placeholder="{{ __('auth.form.password') }}">
                        </div>
                        <div class="my-3 text-center">
                            <button class="bg-orange-600 border hover:bg-orange-600 py-1 px-2 text-white rounded">{{ __('auth.login') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="my-5 text-center">
            Welcome back, {{ auth()->user()->name }}
            <a href="{{ route('dashboard') }}" class="text-orange-500 mx-2 p-2 border border-orange-500">Enter Dashboard</a>
        </div>
        <div class="my-3 text-center">
            <button class="text-orange-500 mx-2 p-2" form="logout">Logout</button>
            <form action="/logout" method="post" id="logout" class="hidden">
                @csrf
            </form>
        </div>
    @endguest
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
