<?php $__env->startSection('title', 'Магазин - '); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <?php echo Breadcrumbs::render('shop'); ?>

        <h1>Магазин</h1>
        <p>Добро пожаловать в магазин игр и предметов для платформы Steam.</p>
        <p>В нашем магазине игры не продаются за деньги, а даются пользователям за клики, которые можно получить только в нашем <a
                    href="<?php echo e(url('faucet')); ?>">Кликере</a>.</p>

        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo e(url('shop/games')); ?>" class="all-games">
                    <h2>Игры</h2>
                    <div class="games-list row">
                        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <div class="col-sm-6 col-md-6">
                                <div class="game-card">
                                    <div class="game-name"><?php echo e($game->name); ?></div>
                                    <div class="game-image"><img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>"></div>
                                    <div class="price"><span><?php echo e($game->price); ?></span></div>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?php echo e(url('shop/items')); ?>" class="all-items">
                    <h2>Предметы</h2>
                    <div class="items-list row">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <div class="col-sm-6 col-md-6">
                                <div class="item-card">
                                    <div class="item-name"><?php echo e($item->name); ?></div>
                                    <div class="category-icon"><img src="<?php echo e(url('images/games/icons/'.$item->category->appid.'.jpg')); ?>" alt="<?php echo e($item->category->name); ?>"></div>
                                    <div class="item-image"><img src="<?php echo e($item->icon_url); ?>" alt="<?php echo e($item->name); ?>"></div>
                                    <div class="price"><span><?php echo e($item->price); ?></span></div>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <ul class="last-buy-games-list">
                    <h3>Последние купленные игры</h3>
                    <?php $__currentLoopData = $last_buy_games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <li class="last-buy-game-card">
                            <div class="game-image"><img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>"></div>
                            <div class="game-name"><?php echo e($game->name); ?></div>
                            <div class="game-buyer"><?php echo e($game->user->name); ?></div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>Последние купленные вещи</h3>
                <ul class="last-buy-items-list">
                    <?php $__currentLoopData = $last_buy_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <li class="last-buy-item-card">
                            <div class="category-icon"><img src="<?php echo e(url('images/games/icons/'.$item->category->appid.'.jpg')); ?>" alt="<?php echo e($item->category->name); ?>"></div>
                            <div class="item-image"><img src="<?php echo e($item->icon_url); ?>" alt="<?php echo e($item->name); ?>"></div>
                            <div class="item-name"><?php echo e($item->name); ?></div>
                            <div class="item-buyer"><?php echo e($item->user->name); ?></div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="<?php echo e(url('shop/games/create-game')); ?>">Добавить игру</a>
                <hr>
                <a class="btn btn-sm btn-success" href="<?php echo e(url('shop/items/create-item')); ?>">Добавить предмет</a>
            </div>
        </div>
    <?php endif; ?>

    <?php echo app('arrilot.widget')->run('WidgetLastPosts'); ?>

    <?php echo $__env->make('widgets.reklama', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo app('arrilot.widget')->run('WidgetTopClickers'); ?>

    <?php echo app('arrilot.widget')->run('WidgetBuyGames'); ?>

    <?php echo app('arrilot.widget')->run('WidgetBuyItems'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .items-list {

        }
        .items-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
        .items-item img {
            width: 100%;
        }
        .item-name {
            color: #a04eb4;
            margin-bottom: 7px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .item-price {
            margin-top: 15px;
            font-size: 11px;
            color: #b2b2b2;
        }

        .last-buy-items-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .item-buy-name {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .item-buy-name img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .item-user {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
            position: relative;
        }
        .item-user img {
            width:20px;
            height:20px;
            position:absolute;
            top:-2px;
            left:0px;
            border-radius:50%;
        }
        .last-buy-items-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>