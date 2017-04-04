<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index ()
    {
        Carbon::setLocale('ru');
        Event::where('user_id', \Auth::id())
            ->where('status', 0)
            ->update([
                'status' => 1,
            ]);

        $events = Event::where('user_id', \Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('pages.events', compact('events'));
    }
}
