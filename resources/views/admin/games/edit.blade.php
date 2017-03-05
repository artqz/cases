@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Редактировать игру</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/games/'.$game->id.'/edit-game') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="col-md-4 control-label">Цена в кликах</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control" name="price" value="{{ $game->price }}" required autofocus>

                        @if ($errors->has('price'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('data') ? ' has-error' : '' }}">
                    <label for="data" class="col-md-4 control-label">Сылка на гифт или ключ</label>

                    <div class="col-md-6">
                        <input id="data" type="text" class="form-control" name="data" value="{{ $game->data }}" required autofocus>

                        @if ($errors->has('data'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('data') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                           Редактировать
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection