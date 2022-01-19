@extends('admin.main')
@section('content')
    <div class="container">
        <div class="row">
            <h2 class="text-center p-3">Thống kê doanh thu sản phẩm theo năm</h2>
            <div class="col-6">
                <form>
                    <input type="text" class="form-control" name="year" placeholder="Nhập năm đề thống kê"/>
                    <input type="submit" class="btn btn-info"/>
                </form>
                <table id="datatablesSimple" class="table table-hovers">
                    <thead>
                    <tr>
                        <th>Quý / Năm</th>
                        <th>Doanh thu</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($record as $p)
                        <tr>
                            <td>{{ $p->quy }} / {{ $p->nam }} </td>
                            <td>{{ $p->doanh_thu }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const data = [];
        const label = [];
        @foreach($record as $q)
        data.push({{$q->doanh_thu}});
        label.push({{$q->quy}});
        @endforeach

        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: 'Thống kê doanh thu theo năm',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
    </script>
@endsection
