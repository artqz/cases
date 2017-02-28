<?php

namespace App\Widgets;

use App\Game;
use Arrilot\Widgets\AbstractWidget;

class lastBuyGames extends AbstractWidget
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
        //

        $last_buy_games = Game::where('status', 1)->orwhere('status', 2)->limit(15)->get();
        return view('widgets.lastBuyGames', [
            'config' => $this->config,
            'last_buy_games' => $last_buy_games,
        ]);
    }
}