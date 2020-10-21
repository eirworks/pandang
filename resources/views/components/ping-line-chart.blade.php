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
                labels: [{!!  $pings->map(function($p) { return "'".\Carbon\Carbon::parse($p->created_at)->format("h:i")."'"; })->join(',')  !!}],
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
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 12,
                            maxRotation: 0,
                        }
                    }]
                }
            }
        })
    </script>
@endpush
