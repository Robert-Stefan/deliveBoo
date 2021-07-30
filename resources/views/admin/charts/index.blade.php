@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Ordini ricevuti negli ultimi dodici mesi</h1>
                <canvas id="userChart" class="rounded shadow"></canvas>
            </div>
        </div>
        <a class="btn show-info text-uppercase mt-5" href="{{route('admin.orders.index')}}">Torna allo Storico Ordini</a>
    </div>

    <!-- ChartJs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- CHART -->
    <script>
        const date = {!!json_encode($chart->labels)!!};
        const order = {!!json_encode($chart->dataset)!!};
        const monthName = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre']
        // Convert date in Month name
        let month = date.map(item => {
            return monthName[item - 1] 
        })

        var ctx = document.getElementById('userChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: month,
                datasets: [{
                    label: 'Ordini al Mese',
                    data:  order,
                    fill: true,
                    borderColor: 'rgb(19, 217, 119)',
                    backgroundColor: 'rgba(19, 217, 119, .2)',
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 10,
                            maxTicksLimit: 20,
                        }
                    }]
                }
            }
        });
    </script>
@endsection