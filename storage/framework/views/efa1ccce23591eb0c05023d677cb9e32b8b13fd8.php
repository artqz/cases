<?php $__env->startSection('title', 'Панель управления - '); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('admin'); ?>

    <ul class="list-group">
        <li class="list-group-item">
            <span class="badge"><?php echo e($items_count); ?></span>
            <a href="<?php echo e(url('admin/items')); ?>">Предметы</a>
        </li>
        <li class="list-group-item">
            <span class="badge"><?php echo e($games_count); ?></span>
            <a href="<?php echo e(url('admin/games')); ?>">Игры</a>
        </li>
        <li class="list-group-item">
            <span class="badge"><?php echo e($users_count); ?></span>
            <a href="<?php echo e(url('admin/users')); ?>">Пользователи</a>
        </li>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>