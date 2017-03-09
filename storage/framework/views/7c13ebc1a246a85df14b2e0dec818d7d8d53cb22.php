<?php $__env->startSection('title', 'Предметы - Панель управления - '); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Breadcrumbs::render('admin.games'); ?>

    <h1>Предметы</h1>
    <div class="panel panel-default">

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ИД</th>
                    <th>Наименование</th>
                    <th>Статус</th>
                    <th>Юзер</th>
                    <th>Гифт</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                    <td><?php echo e($game->id); ?></td>

                    <td><?php echo e($game->name); ?> (<?php echo e($game->price); ?>)</td>

                    <td> <?php if($game->status == 1): ?><span class="label label-default">Ожидание выдачи</span><?php elseif($game->status == 2): ?><span class="label label-success">Выдано</span><?php elseif($game->status == 0): ?><span class="label label-warning">Продается</span><?php endif; ?></td>

                    <td><?php echo e($game->user_id ? $game->user->name : 'Нет'); ?></td>

                    <td><?php echo e($game->data); ?></td>

                    <td><a class="btn btn-xs btn-primary" href="<?php echo e(url('admin/games/'.$game->id.'/edit-game')); ?>">Редактировать</a> <a class="btn btn-xs btn-danger" href="<?php echo e(url('admin/games/'.$game->id.'/delete-game')); ?>" onclick="return confirm('Точно удалить?')">Удалить</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tbody>
        </table>
    </div>

    <div><?php echo e($games->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить игру</div><br>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('admin/games/create-game')); ?>">Добавить игру</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>