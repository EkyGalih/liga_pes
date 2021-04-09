@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="content">
        <div class="title m-b-md" style="text-align: center;">
            STATISTIK PLAYER <u><strong>{{ $stat->name }}</strong></u>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div style="width: 500px;height: 500px">
                    <canvas id="statisik"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div style="width: 500px;height: 500px">
                    <canvas id="statisik_goal"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional-js')
<script>
    var ctx = document.getElementById("statisik").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["WIN","LOSE","DRAW"],
            datasets: [{
                label: 'STATISIK PLAYER BULAN {{ strtoupper($stat->bulan) }}',
                data: [
                {{$stat->win}},
                {{$stat->lose}},
                {{$stat->draw}}
                ],
                backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255,99,132,1)',
                'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    var ctx = document.getElementById("statisik_goal").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["GOAL","KEBOBOLAN"],
            datasets: [{
                label: 'STATISIK PLAYER BULAN {{ strtoupper($stat->bulan) }}',
                data: [
                {{$goal->GM}},
                {{$goal->GL}},
                ],
                backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255,99,132,1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection
