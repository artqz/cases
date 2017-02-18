@extends('app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Редактировать пост</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/discuss/channels/'. $slug_channel .'/'. $slug_theme .'/'. $post->id .'/edit-post') }}">
                {{ csrf_field() }}

                <input id="id_post" type="hidden" class="form-control" name="id_post" value="{{ $post->id }}">

                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <label for="text" class="col-md-4 control-label">Текст сообщения</label>

                    <div class="col-md-6">
                        <textarea id="text" class="form-control" name="text" required autofocus>{{ $post->text }}</textarea>

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
                            Редактировать
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection