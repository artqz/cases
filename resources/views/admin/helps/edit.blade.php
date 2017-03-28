@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Редактировать хелпер</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/helps/'.$help->id.'/edit') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Название</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $help->name }}" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <label for="text" class="col-md-4 control-label">Текст хелпера</label>

                    <div class="col-md-6">
                        <textarea id="text" class="form-control" name="text" value="{{ old('text') }}" required>{!! $help->text !!}</textarea>

                        @if ($errors->has('text'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('text') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                    <label for="position" class="col-md-4 control-label">Позиция</label>

                    <div class="col-md-6">
                        <input id="position" type="text" class="form-control" name="position" value="{{ $help->position }}">

                        @if ($errors->has('position'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('position') }}</strong>
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