<?php

namespace App\Widgets;

use App\Order;
use Arrilot\Widgets\AbstractWidget;

class TopDonate extends AbstractWidget
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
        $orders = Order::where('status', 1)->orderBy('update_at', 'desc')->limit(10)->get();


        return view("widgets.top_donate", [
            'config' => $this->config,
            'orders' => $orders,
        ]);
    }
}