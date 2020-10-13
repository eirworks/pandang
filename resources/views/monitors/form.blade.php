@extends('layouts.dashboard')

@section('title')
    {{ $monitor->id ? 'Edit Monitor' : 'Create Monitor' }}
@endsection

@section('content')
    <div class="container mx-auto">
        <h2 class="text-xl mb-1">@yield('title')</h2>
        <form action="{{ $monitor->id ? route('projects::monitors::update', [$project, $monitor]) : route('projects::monitors::store', [$project]) }}" method="post" class="bg-white p-3 border border-gray-400 w-1/3">
            @csrf

            <div class="my-3">
                <input type="text" name="name" class="w-full outline-none focus:outline-none border-b border-gray-500 py-1" placeholder="Monitor name" value="{{ $monitor->name }}">
            </div>

            <div class="my-3">
                <input type="text" name="url" class="w-full outline-none focus:outline-none border-b border-gray-500 py-1" placeholder="Monitor URL" value="{{ $monitor->url }}">
            </div>

            <div class="my-3">
                <button class="border border-orange-900 bg-orange-600 text-white px-2 py-1 rounded shadow mr-2">Save</button>
                <a href="{{ route('projects::show', [$project]) }}" class="text-gray-600">Cancel</a>
            </div>
        </form>
    </div>
@endsection

