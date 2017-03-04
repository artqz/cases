<?php

namespace App\Widgets;

use App\Game;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Cache;

class WidgetBuyGames extends AbstractWidget
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
        $last_buy_games = Cache::remember('widget:last_buy_games', 60, function()
        {
            return Game::where('status', 1)->orwhere('status', 2)->limit(15)->get();
        });

        return view('widgets.widget_buy_games', [
            'config' => $this->config,
            'last_buy_games' => $last_buy_games,
        ]);

        //return view("widgets.widget_buy_games", [
        //    'config' => $this->config,
        //]);
    }
}