@if($ping)
    <div class="bg-{{ $ping->time > 0 ? 'green' : 'red' }}-500 text-white px-2 py-1">
        <span class="font-bold mr-2">{{ $ping->time > 0 ? 'UP' : 'DOWN' }}</span>
        <span class="text-sm">Last check: {{ $ping->created_at }}</span>
    </div>
@else
    <div class="text-gray-500 text-center border border-gray-400 px-2 py-1">No data</div>
@endif
