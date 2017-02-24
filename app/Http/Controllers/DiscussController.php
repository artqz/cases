<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Stats;
use App\Helpers\SlugHelper;
use App\Post;
use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Config;


class DiscussController extends Controller
{
    public function index () {
        $channels = Channel::paginate(Config::get('main.channels_per_page'));
        return view('discuss.index', compact('channels'));
    }
    public function show_channel ($slug_channel) {
        $channel = Channel::where('slug', $slug_channel)->first();
        $themes = $channel->themes()->latest()->paginate(Config::get('main.themes_per_page'));
        return view('discuss.channels.index', compact('channel', 'themes'));
    }
    public function create_channel () {
        return view('discuss.channels.create');
    }

    public function store_channel (Request $request, SlugHelper $slug) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
        ]);

        $slug_channel = $slug->makeSlugFromTitle(Theme::class, $request->input('name'));

        Channel::create([
            'slug' => $slug_channel,
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
        ]);
        return redirect('discuss/channels/'. $slug_channel);
    }
    public function edit_channel ($slug_channel) {
        $channel = Channel::where('slug', $slug_channel)->first();
        return view('discuss.channels.edit', compact('channel', 'slug_channel'));
    }
    public function update_channel (Request $request, SlugHelper $slug, $slug_channel_old) {
       $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
        ]);

        $slug_channel = $slug->makeSlugFromTitle(Theme::class, $request->input('name'));

        $channel = Channel::where('slug', $slug_channel_old)->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'description' => $request->input('description'),
            'slug' => $slug_channel,
        ]);

        return redirect('discuss/channels/'. $slug_channel);
    }

    public function delete_channel ($slug_channel) {
        Channel::where('slug', $slug_channel)->delete();
        return redirect('discuss');
    }

    public function show_theme ($slug_channel, $slug_theme) {
        $theme = Theme::where('slug', $slug_theme)->first();
        $posts = $theme->posts()->paginate(Config::get('main.posts_per_page'));
        //$post = Post::where('id', 25)->first();
        return view('discuss.themes.index', compact('theme', 'posts', 'slug_channel'));
    }
    public function create_theme ($slug_channel) {
    return view('discuss.themes.create', compact('slug_channel'));
}

    public function store_theme (Request $request, SlugHelper $slug, $slug_channel) {
        $this->validate($request, [
            'slug_channel' => 'required',
            'name' => 'required|max:255',
            'text' => 'required|min:10',
        ]);

        $slug_theme = $slug->makeSlugFromTitle(Theme::class, $request->input('name'));
        //Проверка на замену слага
        if ($slug_channel == $request->input('slug_channel')) {
            $channel = Channel::where('slug', $slug_channel)->first();
            $user_id = \Auth::id();
            $theme = Theme::create([
                'user_id' => $user_id,
                'slug' => $slug_theme,
                'name' => $request->input('name'),
            ]);
            $post = Post::create([
                'user_id' => $user_id,
                'text' => $request->input('text'),
            ]);
            $channel->themes()->save($theme)->posts()->save($post);

            if ($channel) {
                //Записываем статистику
                Stats::where('name', 'posts')->increment('value', 1);
                return redirect('discuss/channels/'. $slug_channel .'/'. $slug_theme);
            }

        }
        return redirect('/');
    }
    public function edit_theme ($slug_channel, $slug_theme) {
        $theme = Theme::where('slug', $slug_theme)->first();
        return view('discuss.themes.edit', compact('slug_channel', 'slug_theme', 'theme'));
    }

    public function update_theme (Request $request, SlugHelper $slug, $slug_channel, $slug_theme_old) {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $slug_theme = $slug->makeSlugFromTitle(Theme::class, $request->input('name'));

        Theme::where('slug', $slug_theme_old)->update([
            'name' => $request->input('name'),
            'slug' => $slug_theme,
        ]);

        return redirect('discuss/channels/'. $slug_channel .'/'. $slug_theme);
    }

    public function delete_theme ($slug_channel, $slug_theme) {
        Theme::where('slug', $slug_theme)->delete();
        return redirect('discuss/channels/'. $slug_channel);
    }

    public function create_post (Request $request, $slug_channel, $slug_theme) {
        if ($request->all()) $reply = $request->all()['reply']. ', ';
        else {
            $reply = '';
        }
        return view('discuss.posts.create', compact('slug_channel', 'slug_theme', 'reply'));
    }

    public function store_post (Request $request, $slug_channel, $slug_theme) {
        $this->validate($request, [
            'slug_theme' => 'required',
            'text' => 'required|min:10',
        ]);

        //Проверка на замену слага
        if ($slug_theme == $request->input('slug_theme')) {
            $theme = Theme::where('slug', $slug_theme)->first();
            $post = Post::create([
                'user_id' => \Auth::id(),
                'text' => $request->input('text'),
            ]);
            $theme->posts()->save($post);

            if ($theme) {
                //Записываем статистику
                Stats::where('name', 'posts')->increment('value', 1);
                if ($post->where('theme_id', $theme->id)->paginate(Config::get('main.posts_per_page'))->lastPage() > 1) {
                    $page = '?page='. ($post->where('theme_id', $theme->id)->paginate(Config::get('main.posts_per_page'))->lastPage());
                }
                else {
                    $page = null;
                }
                return redirect('discuss/channels/'. $slug_channel .'/'. $slug_theme . $page);
            }

        }
        return redirect('/');
    }

    public function edit_post ($slug_channel, $slug_theme, $id_post) {
        $post = Post::where('id', $id_post)->first();
        return view('discuss.posts.edit', compact('slug_channel', 'slug_theme', 'post'));
    }

    public function update_post (Request $request, $slug_channel, $slug_theme, $id_post) {
        $this->validate($request, [
            'id_post' => 'required',
            'text' => 'required|min:10',
        ]);

        //Проверка на замену id
        if ($id_post == $request->input('id_post')) {
            $post = Post::where('id', $id_post)->first();
            //Проверка на авторство
            if (\Auth::id() == $post->user->id) {
                Post::where('id', $id_post)->update(['text' => $request->input('text')]);

                return redirect('discuss/channels/'. $slug_channel .'/'. $slug_theme);
            }
        }
        return redirect('/');
    }
    public function delete_post ($slug_channel, $slug_theme, $id_post) {
        Post::where('id', $id_post)->delete();
        return redirect('discuss/channels/'. $slug_channel .'/'. $slug_theme);
    }
}
