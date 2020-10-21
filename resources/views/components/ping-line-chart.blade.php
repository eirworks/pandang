@if(empty($pings))
    <div class="text-center text-gray-500 my-3">No data</div>
@else
    <div class="my-3">
        <canvas class="w-full" height="{{ $height }}px" id="{{ $id }}"></canvas>
    </div>
    @if($displayStat)
        <div class="my-3">
            <span class="mr-2">Average {{ number_format($pings->pluck('time')->avg(), 2) }}s</span>
            <span class="mr-2">Slowest {{ $pings->pluck('time')->max() }}s</span>
            <span class="mr-2">Fastest {{ $pings->pluck('time')->filter(function($ping) { return $ping > 0; })->min() }}s</span>
            <span class="mr-2 text-red-600">Downtime {{ $pings->filter(function($ping) { return $ping->time == 0;})->count() }}</span>
        </div>
    @endif
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
                        data: [{{ $pings->pluck('time')->reverse()->join(',') }}],
                        lineTension: 0,
                        borderColor: '#ED8936',
                        backgroundColor: '#f3c59966'
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })
    </script>
@endpush
