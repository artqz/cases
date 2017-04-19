@extends('app')

@section('content')
    <div id="app-vue">
        <inventory steamid="{{ Auth::user()->steamid }}"></inventory>
    </div>
@endsection