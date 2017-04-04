<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index ()
    {
        Event::where('user_id', \Auth::id())
            ->where('status', 0)
            ->update([
                'status' => 1,
            ]);

        $events = Event::where('user_id', \Auth::id())->paginate(30);
        return view('pages.events', compact('events'));
    }
}
