<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index ()
    {
        $events = 1;
        return view('layouts.events', compact('events'));
    }
}
