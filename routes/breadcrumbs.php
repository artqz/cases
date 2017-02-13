<?php


Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', url('/'));
});


Breadcrumbs::register('shop', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Магазин', url('shop'));
});


Breadcrumbs::register('games', function($breadcrumbs)
{
    $breadcrumbs->parent('shop');
    $breadcrumbs->push('Игры', url('shop/games'));
});

Breadcrumbs::register('game', function($breadcrumbs, $id)
{
    $game = App\Game::find($id);
    $breadcrumbs->parent('games');
    $breadcrumbs->push($game->name, url('shop/game/{id}', $game->id));
});
