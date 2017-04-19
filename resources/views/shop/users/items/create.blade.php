@extends('app')

@section('content')
    <div id="app-vue">
        <inventory steam_id="{{ Auth::user()->steamid }}"></inventory>
    </div>
@endsection