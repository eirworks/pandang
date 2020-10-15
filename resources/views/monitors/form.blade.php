@extends('layouts.dashboard')

@section('title')
    {{ $monitor->id ? 'Edit Monitor' : 'Create Monitor' }}
@endsection

@section('content')
    <div class="container mx-auto flex justify-center">
        <div class="w-full lg:w-1/3">
            <h2 class="text-xl mb-1">@yield('title')</h2>
            <form action="{{ $monitor->id ? route('projects::monitors::update', [$project, $monitor]) : route('projects::monitors::store', [$project]) }}" method="post" class="bg-white p-3 border border-gray-400">
                @csrf
                @if($monitor->id)
                    @method('PUT')
                @endif

                <div class="my-3">
                    <input type="text" name="name" class="w-full outline-none focus:outline-none border-b border-gray-500 py-1" placeholder="Monitor name" value="{{ $monitor->name }}">
                </div>

                <div class="my-3">
                    <input type="text" name="url" class="w-full outline-none focus:outline-none border-b border-gray-500 py-1" placeholder="Monitor URL" value="{{ $monitor->url }}">
                </div>

                @if($monitor->id)
                    <div class="my-3">
                        <label class="block">
                            <input type="checkbox" name="activated" value="1" {{ $monitor->activated ? 'checked' : '' }} class="mr-1">
                            Enable monitoring
                        </label>
                    </div>

                    <div class="my-3">
                        <label class="block">
                            <input type="checkbox" name="settings[{{ \App\Models\Monitor::SETTING_SEND_ALERT }}]" value="1" {{ $monitor->settings->get(\App\Models\Monitor::SETTING_SEND_ALERT) ? 'checked' : '' }} class="mr-1">
                            Enable notification when site is down?
                        </label>
                    </div>

                    <div class="my-3">
                        <input type="text" name="settings[{{ \App\Models\Monitor::SETTING_SMS_NUMBER }}]" class="w-full outline-none focus:outline-none border-b border-gray-500 py-1" placeholder="Alert Mobile Phone number" value="{{ $monitor->settings->get(\App\Models\Monitor::SETTING_SMS_NUMBER) }}">
                        <div class="my-1 text-gray-600 text-sm">Leave it empty to use phone number from the project.</div>
                    </div>

                    <div class="my-3">
                        <input type="number" name="settings[{{ \App\Models\Monitor::SETTING_DOWNTIME_DELAYS }}]" class="w-full outline-none focus:outline-none border-b border-gray-500 py-1" placeholder="Delays" value="{{ $monitor->settings->get(\App\Models\Monitor::SETTING_DOWNTIME_DELAYS, 0) }}">
                        <div class="my-1 text-gray-600 text-sm">How many downtime ping you want before we send alert notification?</div>
                    </div>
                @endif

                <div class="my-3">
                    <button class="border border-orange-900 bg-orange-600 text-white px-2 py-1 rounded shadow mr-2">Save</button>
                    <a href="{{ route('projects::show', [$project]) }}" class="text-gray-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

