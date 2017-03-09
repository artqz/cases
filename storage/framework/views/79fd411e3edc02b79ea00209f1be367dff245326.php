<?php $__env->startSection('content'); ?>
    <div>
        <?php echo Breadcrumbs::render('shop'); ?>

        <h1>Магазин - Игры</h1>

        <ul class="games-list">
        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <li class="game-item col-xs-6 col-sm-4 col-md-4">
                <a href="<?php echo e(url('shop/game/' . $game->id)); ?>">
                    <img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>" width="100%">
                    <div><?php echo e($game->name); ?></div>
                </a>
                <div>Количество: <?php echo e($game->gifts->count()); ?></div>
                <div>Купили: 0</div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Добавь игру если её нет!</div><br>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('shop/game/create')); ?>">Добавить игру</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('style'); ?>
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .games-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .game-item {
            margin-bottom: 25px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>