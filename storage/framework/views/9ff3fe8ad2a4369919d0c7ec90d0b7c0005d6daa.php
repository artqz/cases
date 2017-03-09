<?php $__env->startSection('title', 'Игры - Магазин - '); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <?php echo $__env->make('layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Breadcrumbs::render('games'); ?>

        <h1>Игры</h1>
        <div class="games-list row">
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="games-item">
                        <div class="game-name"><?php echo e($game->name); ?></div>
                        <img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>">
                        <div class="game-price">Цена: <?php echo e($game->price); ?> Клик.</div>
                        <div class="pull-right"><a href="<?php echo e(url('/shop/games/'. $game->id .'/buy-game')); ?>" class="btn btn-xs btn-default">Купить</a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
        <div class="clearfix"></div>
        <div><?php echo e($games->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
                <a class="btn btn-sm btn-success" href="<?php echo e(url('shop/games/create-game')); ?>">Добавить игру</a>
            </div>
        </div>
    <?php endif; ?>

    <?php echo app('arrilot.widget')->run('lastBuyItems'); ?>

    <?php echo app('arrilot.widget')->run('lastBuyGames'); ?>

    <?php echo app('arrilot.widget')->run('lastPosts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>