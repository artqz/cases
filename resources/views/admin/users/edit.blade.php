@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактировать пользователя #{{ $user->name }}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/users/'.$user->id.'/edit-user') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Эл. почта</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('clicks') ? ' has-error' : '' }}">
                            <label for="clicks" class="col-md-4 control-label">Клики</label>

                            <div class="col-md-6">
                                <input id="clicks" type="clicks" class="form-control" name="clicks" value="{{ $user->clicks }}" required>

                                @if ($errors->has('clicks'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clicks') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('crystals') ? ' has-error' : '' }}">
                            <label for="crystals" class="col-md-4 control-label">Кристаллы</label>

                            <div class="col-md-6">
                                <input id="clicks" type="crystals" class="form-control" name="crystals" value="{{ $user->crystals }}" required>

                                @if ($errors->has('crystals'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('crystals') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="" name="isBanned" value="1" {{ ($user->isBanned == 1) ? 'checked' : '' }}> Заблокировать?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="" name="isSpamer" value="1" {{ ($user->isSpamer == 1) ? 'checked' : '' }}> Спамер?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="" name="isTrader" value="1" {{ ($user->isTrader == 1) ? 'checked' : '' }}> Сертификат торговца
                                    </label>
                                </div>
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
    </div>
</div>
@endsection
