@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить раздачу</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('distributions/create') }}">
                {{ csrf_field() }}

                @if(Auth::user()->isTrader == 2)
                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                    <label for="level" class="col-md-4 control-label">Раздача</label>
                    <div class="col-md-6">
                        <select name="level" class="form-control">
                            <option value="1">За Клики</option>
                            <option value="2">За Кристаллы</option>
                        </select>
                    </div>
                </div>
                @endif

                <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                    <label for="type" class="col-md-4 control-label">Тип</label>
                    <div class="col-md-6">
                        <select name="type" class="form-control">
                            <option value="2">Игра</option>
                            <option value="1">Комплект</option>
                        </select>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('game_id') ? ' has-error' : '' }}">
                    <label for="game_id" class="col-md-4 control-label">ID игры / комплекта</label>

                    <div class="col-md-6">
                        <input id="game_id" type="text" class="form-control" name="game_id" value="{{ old('game_id') }}" required autofocus>

                        @if ($errors->has('game_id'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('game_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="col-md-4 control-label">Какую сумму вы хотите собрать?</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required>

                        @if ($errors->has('price'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                        @endif
                        <span>Стоймость участия вычисляется автоматически, исходя от требуемой суммы и максимального количества участников!</span>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('players') ? ' has-error' : '' }}">
                    <label for="players" class="col-md-4 control-label">Максимальное количество игроков</label>

                    <div class="col-md-6">
                        <input id="players" type="text" class="form-control" name="players" value="{{ old('players') }}" required>

                        @if ($errors->has('players'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('players') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('data') ? ' has-error' : '' }}">
                    <label for="data" class="col-md-4 control-label">Ссылка на гифт или ключ</label>

                    <div class="col-md-6">
                        <input id="data" type="text" class="form-control" name="data" value="{{ old('data') }}" required>

                        @if ($errors->has('data'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('data') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                    <label for="region" class="col-md-4 control-label">Раздача</label>
                    <div class="col-md-6">
                        <select name="region" class="form-control">
                            <option value="0">Нет</option>
                            <option value="1">Китай</option>
                            <option value="2">Гонгконг и Тайвань</option>
                            <option value="3">Индия</option>
                            <option value="4">Польша</option>
                            <option value="5">Германия</option>
                            <option value="6">Россия и СНГ</option>
                            <option value="7">Юго-Восточная Азия</option>
                            <option value="8">Южная Америка</option>
                            <option value="9">Турция</option>
                        </select>
                        <span>Если Ваша копия игры имеет региональные ограничения Вы должны указать это, в противном случае Ваш аккаунт может быть заморожен.</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Создать раздачу
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection