<?php

namespace App\Widgets;

use App\Item;
use Arrilot\Widgets\AbstractWidget;

class lastBuyItems extends AbstractWidget
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
        $last_buy_items = Item::where('status', 1)->orwhere('status', 2)->limit(15)->get();
        return view('widgets.lastBuyItems', [
            'config' => $this->config,
            'last_buy_items' => $last_buy_items,
        ]);
    }
}