<?php

namespace App\Widgets;

use App\Post;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Cache;
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

        $last_posts = Cache::remember('widget:last_posts', 1, function()
        {
            return Post::get();
        });

        return view('widgets.lastPosts', [
            'config' => $this->config,
            'last_posts' => $last_posts,
        ]);
    }
}