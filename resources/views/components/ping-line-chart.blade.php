@if(empty($pings))
    <div class="text-center text-gray-500 my-3">No data</div>
@else
    <div class="my-3">
        <canvas class="w-full" height="{{ $height }}px" id="{{ $id }}"></canvas>
    </div>
    <div class="my-3">
        <span class="mr-2">Average {{ $pings->pluck('time')->avg() }}s</span>
        <span class="mr-2">Highest {{ $pings->pluck('time')->max() }}s</span>
        <span class="mr-2">Lowest {{ $pings->pluck('time')->min() }}s</span>
        <span class="mr-2 text-red-600">Downtime {{ $pings->filter(function($ping) { return $ping->time == 0;})->count() }}</span>
    </div>
@endif

@push('footer')
    <script>
        new Chart(document.getElementById('{{ $id }}'), {
            type: 'line',
            data: {
                labels: [{{ implode(',', range(0, count($pings) - 1)) }}],
                datasets: [
                    {
                        label: "Milisecs",
                        data: [{{ $pings->pluck('time')->join(',') }}],
                        lineTension: 0,
                        borderColor: '#ED8936',
                        backgroundColor: '#f3c59966'
                    }
                ]
            }
        })
    </script>
@endpush
