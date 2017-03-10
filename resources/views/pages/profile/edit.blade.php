@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Редактировать ссылку для обмена</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('profile/edit-tradeoffer') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('tradeoffer') ? ' has-error' : '' }}">
                    <label for="tradeoffer" class="col-md-4 control-label">Ссылка для обмена</label>

                    <div class="col-md-6">
                        <input id="tradeoffer" type="text" class="form-control" name="tradeoffer" value="{{ Auth::user()->tradeoffer }}" autofocus>

                        @if ($errors->has('tradeoffer'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('tradeoffer') }}</strong>
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