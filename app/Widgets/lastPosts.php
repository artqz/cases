<?php

namespace App\Widgets;

use App\Post;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Redis;

class lastPosts extends AbstractWidget
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
        $storage = Redis::Connection();

        $last_posts = Post::all();

        return view('widgets.lastPosts', [
            'config' => $this->config,
            'last_posts' => $last_posts,
        ]);
    }
}