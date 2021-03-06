@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Редактировать раздел</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/discuss/channels/'. $slug_channel .'/edit-channel') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Доступ</label>
                    <div class="col-md-6">
                    <select id="type" class="form-control" name="type" required autofocus>
                        <option value="{{ $channel->type }}" selected>
                            @if($channel->type == 1)
                                Для админа
                            @elseif($channel->type == 0)
                                Для всех
                            @endif
                        </option>
                        <option value="0">Для всех</option>
                        <option value="1">Для админа</option>
                    </select>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Название раздела</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $channel->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Описание раздела</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control" name="description" value="{{ $channel->description }}" required autofocus>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Добавить
                        </button>
                        <a href="{{ url('/discuss/channels/'. $slug_channel .'/delete-channel') }}" type="submit" class="btn btn-danger">
                            Удалить
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection