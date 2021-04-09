@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ubah statistik Player <u><strong>{{ $player->name }}</strong></u></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.update', $player->user_id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="match">MATCH</label>
                                    <input type="number" class="form-control" name="match" value="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="win">WIN</label>
                                    <input type="number" class="form-control" name="win" value="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="lose">LOSE</label>
                                    <input type="number" class="form-control" name="lose" value="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="draw">DRAW</label>
                                    <input type="number" class="form-control" name="draw" value="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="gm">Goal WIN</label>
                                    <input type="number" class="form-control" name="gm" value="0">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="gl">GOAL LOSE</label>
                                    <input type="number" class="form-control" name="gl" value="0">
                                </div>
                            </div>
                            <input type="hidden" name="bulan" value="{{ date('M') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-block">
                            <i class="glyphicon glyphicon-save"></i> Simpan
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
