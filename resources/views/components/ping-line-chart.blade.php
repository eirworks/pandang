@if(empty($pings))
    <div class="text-center text-gray-500 my-3">No data</div>
@else
    <canvas class="w-full" id="{{ $id }}"></canvas>
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
