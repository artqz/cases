<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Message;
use Carbon\Carbon;

class WidgetChat extends AbstractWidget
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
        $messages_count = Message::count();
        $messages = Message::orderBy('created_at', 'ASC')
            ->offset($messages_count-50)
            ->limit(50)
            ->get();


        return view('widgets.widget_chat', [
            'config' => $this->config,
            'messages' => $messages,
        ]);

        //return view("widgets.widget_chat", [
        //    'config' => $this->config,
        //]);
    }
}