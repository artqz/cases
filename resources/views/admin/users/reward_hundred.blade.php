@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Дать бонус 100 активным пользователям</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/users/create-reward-hundred') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('reward') ? ' has-error' : '' }}">
                    <label for="reward" class="col-md-4 control-label">Количество кликов</label>

                    <div class="col-md-6">
                        <input id="reward" type="text" class="form-control" name="reward" value="{{ old('reward') }}" required autofocus>

                        @if ($errors->has('reward'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('reward') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Выдать
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection