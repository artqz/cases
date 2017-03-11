@if(Session::has('flash_message'))
    <div class="alert alert-{{ session('flash_message_status') }}">
        {{ session('flash_message') }} @if(Session::has('flash_message_value')) <span class="price">{{ session('flash_message_value') }}</span> @endif
    </div>
@endif