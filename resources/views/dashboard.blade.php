@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">STANDING BPKAD LEAGUE</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" >
                            <thead class="table-dark">
                                <tr style="text-align: center;">
                                    <td>#</td>
                                    <td>PLayer</td>
                                    <td>Match</td>
                                    <td>W</td>
                                    <td>L</td>
                                    <td>D</td>
                                    <td>GM</td>
                                    <td>GL</td>
                                    <td>Poin</td>
                                    <td>Statistik</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td style="text-align: center;">{{ $item->match }}</td>
                                    <td style="text-align: center;">{{ $item->win }}</td>
                                    <td style="text-align: center;">{{ $item->lose }}</td>
                                    <td style="text-align: center;">{{ $item->draw }}</td>
                                    <td style="text-align: center;">{{ $item->GM }}</td>
                                    <td style="text-align: center;">{{ $item->GL }}</td>
                                    <td style="text-align: center;">{{ $item->poin }}</td>
                                    <td>
                                        <a href="{{ route('statistik', $item->user_id) }}" class="btn btn-outline-success btn-xs">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <canvas id="statistik"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <canvas id="statistik2"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional-js')
<script>
    var ctx = document.getElementById("statistik").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["LOSE", "WIN", "DRAW"],
            datasets: [{
                label: 'standing of month',
                data: [{{ $t_lose }}, {{ $t_win }}, {{ $t_draw }}],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
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
    var ctx = document.getElementById("statistik2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Kebobolan", "Goal"],
            datasets: [{
                label: '# of Votes',
                data: [{{ $t_gl }}, {{ $t_gm }}],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
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
