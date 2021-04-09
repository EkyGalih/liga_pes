@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">STANDING BPKAD LEAGUE</div>
                <a href="{{ route('admin.tambah_player') }}" class="btn btn-outline-info btn-xs">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (Session::has('fail'))
                       <div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ Session::get('fail') }}
                       </div>
                       @elseif(Session::has('player_add'))
                       <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ Session::get('player_add') }}
                       </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>PLayer</td>
                                <td>Match</td>
                                <td>W</td>
                                <td>L</td>
                                <td>D</td>
                                <td>GM</td>
                                <td>GL</td>
                                <td>Poin</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->match }}</td>
                                <td>{{ $item->win }}</td>
                                <td>{{ $item->lose }}</td>
                                <td>{{ $item->draw }}</td>
                                <td>{{ $item->GM }}</td>
                                <td>{{ $item->GL }}</td>
                                <td>{{ $item->poin }}</td>
                                <td>
                                    <a href="{{ route('admin.ubah_skor', $item->user_id) }}" class="btn btn-outline-primary btn-xs">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin.statistik', $item->user_id) }}" class="btn btn-outline-success btn-xs">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
