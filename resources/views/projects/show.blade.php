@extends('layouts.dashboard')

@section('title')
    {{ $project->name }}
@endsection

@section('content')
    <div class="container mx-auto">
        <h2 class="mb-3 text-xl">@yield('title')</h2>

        <div class="my-3">
            <button class="outline-none focus:outline-none border border-orange-700 px-2 py-1 bg-orange-500 text-orange-200 rounded mr-1">Create Monitor</button>
            <a href="{{ route('projects::edit', [$project]) }}" class="outline-none focus:outline-none border border-gray-700 px-2 py-1 rounded mr-1">Settings</a>
        </div>

        <div class="my-3">
            <div class="grid grid-cols-2 gap-2">

                @foreach($monitors as $monitor)
                <div class="border border-gray-400 bg-white">
                    <div class="p-3">
                        <div class="font-bold mb-3">
                            <span class="text-gray-500 font-normal">#{{ $monitor->id }}</span>
                            {{ $monitor->name }}
                        </div>
                        @if($monitor->pings->last())
                            <div class="bg-{{ $monitor->pings->last()->time > 0 ? 'green' : 'red' }}-500 text-white px-2 py-1"><span class="font-bold">{{ $monitor->pings->last()->time > 0 ? 'UP' : 'DOWN' }}</span></div>
                        @else
                            <div class="text-gray-500 text-center border border-gray-400 px-2 py-1">No data</div>
                        @endif
                        <x-ping-line-chart :pings="$monitor->pings" :name="$monitor->name" />
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

