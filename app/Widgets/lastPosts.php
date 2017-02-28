<?php

namespace App\Widgets;

use App\Post;
use Arrilot\Widgets\AbstractWidget;

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

        $last_posts = Post::all();

        return view('widgets.lastPosts', [
            'config' => $this->config,
            'last_posts' => $last_posts,
        ]);
    }
}