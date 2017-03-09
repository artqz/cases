<?php $__env->startSection('content'); ?>
        <?php echo Breadcrumbs::render('game', $game->id); ?>

        <?php $__currentLoopData = $game->gifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gift): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo e($gift->link); ?>

                    <a class="btn btn-xs btn-success pull-right">Купить игру за <?php echo e($game->price_click); ?> кликов</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6><?php echo e($game->name); ?></h6>
        </div>
        <div class="panel-body">
            <img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>" width="100%">
            <br><br>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('/shop/game/'.$game->id.'/gift/create')); ?>">Добавить гифт!</a>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('style'); ?>
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>