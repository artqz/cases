<?php

namespace App\Widgets;

use App\Item;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Cache;

class WidgetBuyItems extends AbstractWidget
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
        $last_buy_items = Cache::remember('widget:last_buy_items', 5, function()
        {
            return Item::where('status', 1)->orwhere('status', 2)->orderBy('updated_at', 'desc')->limit(15)->get();
        });

        return view('widgets.widget_buy_items', [
            'config' => $this->config,
            'last_buy_items' => $last_buy_items,
        ]);

        //return view("widgets.widget_buy_items", [
        //    'config' => $this->config,
        //]);
    }
}