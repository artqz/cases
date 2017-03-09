<?php $__env->startSection('title', 'Предметы - Панель управления - '); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Breadcrumbs::render('admin.items'); ?>

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
                    <th>Хэш</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>

                    <td><?php echo e($item->name); ?> (<?php echo e($item->price); ?>)</td>

                    <td> <?php if($item->status == 1): ?><span class="label label-default">Ожидание выдачи</span><?php elseif($item->status == 2): ?><span class="label label-success">Выдано</span><?php elseif($item->status == 0): ?><span class="label label-warning">Продается</span><?php endif; ?></td>

                    <td><?php echo e($item->user_id ? $item->user->name : 'Нет'); ?></td>

                    <td><?php echo e($item->hashcode ? $item->hashcode : 'Нет'); ?></td>

                    <td>
                        <a class="btn btn-xs btn-success" href="<?php echo e(url('admin/items/'.$item->id.'/give-item')); ?>" onclick="return confirm('Точно выдал?')">Выдал</a>
                        <a class="btn btn-xs btn-primary" href="<?php echo e(url('admin/items/'.$item->id.'/edit-item')); ?>">Редактировать</a>
                        <a class="btn btn-xs btn-danger" href="<?php echo e(url('admin/items/'.$item->id.'/delete-item')); ?>" onclick="return confirm('Точно удалить?')">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </tbody>
        </table>
    </div>

    <div><?php echo e($items->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить Категорию или предмет</div><br>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('admin/items/create-item')); ?>">Добавить предмет</a>
            <hr>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('admin/items/categories/create-category')); ?>">Добавить категорию</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>