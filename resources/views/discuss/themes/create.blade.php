@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить тему</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/discuss/channels/'. $slug_channel .'/create-theme') }}">
                {{ csrf_field() }}

                <input id="slug_channel" type="hidden" class="form-control" name="slug_channel" value="{{ $slug_channel }}">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Название темы</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <label for="text" class="col-md-4 control-label">Текст сообщения</label>

                    <div class="col-md-6">
                        <textarea id="text" type="" class="form-control" name="text" value="{{ old('text') }}" required></textarea>

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