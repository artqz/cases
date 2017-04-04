<?php

namespace App\Widgets;

use App\Event;
use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;

class Events extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        Carbon::setLocale('ru');
        $events = Event::where('user_id', \Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view("widgets.events", [
            'config' => $this->config,
            'events' => $events,
        ]);
    }
}