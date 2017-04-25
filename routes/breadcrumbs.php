<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', url('/'));
});

Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Панель управления', url('admin'));
});

Breadcrumbs::register('admin.messages', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Сообщения чата', url('admin/messages'));
});

Breadcrumbs::register('admin.items', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Предметы', url('admin/items'));
});

Breadcrumbs::register('admin.games', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Игры', url('admin/games'));
});

Breadcrumbs::register('admin.users', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Пользователи', url('admin/users'));
});

Breadcrumbs::register('faucet', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Кликер', url('faucet'));
});

Breadcrumbs::register('mygames', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Мои игры', url('my-games'));
});

Breadcrumbs::register('myitems', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Мои предметы', url('my-items'));
});

Breadcrumbs::register('referral', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Реферальная система', url('referral'));
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

Breadcrumbs::register('distributions', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Раздачи', url('distributions'));
});

Breadcrumbs::register('distribution', function($breadcrumbs, $distribution)
{
    $breadcrumbs->parent('distributions', $distribution);
    $breadcrumbs->push($distribution->data_name, url('distributions/{id_distribution}', $distribution->id));
});

Breadcrumbs::register('donate', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Купить кристаллы', url('donate'));
});

Breadcrumbs::register('exchange', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Получить клики', url('exchange'));
});