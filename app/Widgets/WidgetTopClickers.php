<?php

namespace App\Widgets;

use App\User;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Cache;

class WidgetTopClickers extends AbstractWidget
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
        $user = Cache::remember('widget:users', 5, function()
        {
            return User::orderBy('all_clicks', 'desc')->limit(10)->get();
        });

        return view('widgets.widget_top_clickers', [
            'config' => $this->config,
            'user' => $user,
        ]);

        //return view("widgets.widget_top_clickers", [
        //    'config' => $this->config,
        //]);
    }
}