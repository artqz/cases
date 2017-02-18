@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить игру</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/shop/game/'.$game_id.'/gift/create') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('type_gift') ? ' has-error' : '' }}">
                    <label for="type_gift" class="col-md-4 control-label">Ссылка на игру в стим</label>

                    <div class="col-md-6">
                        <select id="type_gift" class="form-control" name="type_gift" required autofocus>
                            <option value="0">Гифт</option>
                            <option value="0">Код</option>
                        </select>

                        @if ($errors->has('type_gift'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('type_gift') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('link_gift') ? ' has-error' : '' }}">
                    <label for="link_gift" class="col-md-4 control-label">Ссылка на игру в стим</label>

                    <div class="col-md-6">
                        <input id="link_gift" type="text" class="form-control" name="link_gift" value="{{ old('link_gift') }}" required autofocus>

                        @if ($errors->has('link_gift'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('link_gift') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('code_gift') ? ' has-error' : '' }}">
                    <label for="code_gift" class="col-md-4 control-label">Ссылка на игру в стим</label>

                    <div class="col-md-6">
                        <input id="code_gift" type="text" class="form-control" name="code_gift" value="{{ old('link_gift') }}" required autofocus>

                        @if ($errors->has('code_gift'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('code_gift') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Добавить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection