@if(Session::has('flash_message'))
    <div class="alert alert-{{ session('flash_message_status') }}">
        {{ session('flash_message') }}
    </div>
@endif