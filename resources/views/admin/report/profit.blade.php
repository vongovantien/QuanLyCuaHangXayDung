@extends('admin.main')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-6">
                <h2>Thống kê báo cáo</h2>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hovers">
                        <thead>
                        <tr>
                            <th>Năm</th>
                            <th>Doanh thu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($record as $r)
                            <tr>
                                <td>{{$r->year}}</td>
                                <td>{{$r->doanh_thu}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let labels = [];
        let data = [];
        @foreach ($record as $r)
        labels.push('{{ $r->year }}')
        data.push('{{$r->doanh_thu}}')
        @endforeach
            window.onload = function () {
            const ctx = document.getElementById('myChart').getContext('2d');
            showChart(ctx, labels, data, 'line')
        }

        function showChart(ctx, labels, data, type) {
            let colors = [], borderColors = []
            let r, g, b
            for (let i = 0; i < labels.length; i++) {
                r = parseInt(Math.random() * 255)
                g = parseInt(Math.random() * 255)
                b = parseInt(Math.random() * 255)
                colors.push(`rgba(${r}, ${g}, ${b}, 0.2)`)
                borderColors.push(`rgba(${r}, ${g}, ${b}, 1)`)
            }

            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Thống kê doanh thu theo tháng',
                        data: data,
                        backgroundColor: colors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endsection
