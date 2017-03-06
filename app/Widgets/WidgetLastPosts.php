<?php

namespace App\Widgets;

use App\Post;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Cache;

class WidgetLastPosts extends AbstractWidget
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
        $last_posts = Cache::remember('widget:last_posts', 5, function()
        {


            $last_posts = Post::orderBy('created_at', 'desc')->get();
            //$last_posts = Post::with(['user', 'theme'])->with('theme', 'channel')->get();

            $object = new \stdClass();
            foreach ($last_posts as $key => $value) {
                $object->$key = new \stdClass();
                $object->$key->post = $value;
                $object->$key->user = $value->user;
                $object->$key->theme = $value->theme;
                $object->$key->channel = $value->theme->channel;
            }

            return $last_posts;
        });

        return view('widgets.widget_last_posts', [
            'config' => $this->config,
            'last_posts' => $last_posts,
        ]);

        //return view("widgets.widget_last_posts", [
        //    'config' => $this->config,
        //]);
    }
}