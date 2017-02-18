<?php


Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', url('/'));
});

Breadcrumbs::register('discuss', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Общение', url('discuss'));
});

Breadcrumbs::register('channels', function($breadcrumbs, $channel)
{
    $breadcrumbs->parent('discuss');
    $breadcrumbs->push($channel->name, url('discuss/channels', $channel->slug));
});

Breadcrumbs::register('themes', function($breadcrumbs, $channel, $theme)
{
    $breadcrumbs->parent('channels', $channel);
    $breadcrumbs->push($theme->name, url('discuss/channels/{slug_channel}/{slug_theme}', $theme->slug));
});


Breadcrumbs::register('shop', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Магазин', url('shop'));
});

Breadcrumbs::register('items', function($breadcrumbs)
{
    $breadcrumbs->parent('shop');
    $breadcrumbs->push('Вещи', url('shop/items'));
});


Breadcrumbs::register('games', function($breadcrumbs)
{
    $breadcrumbs->parent('shop');
    $breadcrumbs->push('Игры', url('shop/games'));
});
