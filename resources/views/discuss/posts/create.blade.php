@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить пост</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/discuss/channels/'. $slug_channel .'/'. $slug_theme .'/create-post') }}">
                {{ csrf_field() }}

                <input id="slug_theme" type="hidden" class="form-control" name="slug_theme" value="{{ $slug_theme }}">

                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <label for="text" class="col-md-4 control-label">Текст сообщения</label>

                    <div class="col-md-6">
                        <textarea id="text" class="form-control" name="text" value="{{ old('text') }}" required autofocus>{{ $reply }}</textarea>

                        @if ($errors->has('text'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('text') }}</strong>
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