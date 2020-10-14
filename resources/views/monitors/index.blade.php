@extends('layouts.dashboard')

@section('title')
    {{ $monitor->name }}
@endsection

@section('content')
    <div class="container mx-auto">
        <h2 class="text-xl">@yield('title')</h2>

        <div class="my-3 text-gray-500 text-sm">
            <span class="mr-1">#{{ $monitor->id }}</span>
            <span class="mr-1">{{ $monitor->created_at }}</span>
            <a class="text-gray-700 hover:text-gray-800" href="{{ route('projects::monitors::edit', [$project, $monitor]) }}">Edit</a>
        </div>

        <div class="my-3">
            <x-ping-status :ping="$pings->last()" />
        </div>

        @if(!$monitor->activated)
            <div class="my-3 bg-yellow-500 text-center text-white font-bold px-2 py-1">
                MONITORING PAUSED
            </div>
        @endif

        <div class="border border-gray-400 bg-white p-3 rounded my-3">
            <x-ping-line-chart :pings="$pings" name="$monitor->name" :displayStat="true" />
        </div>

        <div class="my-3">
            <code class="text-pink-500">{{ $monitor->url }}</code>
        </div>
    </div>
@endsection

