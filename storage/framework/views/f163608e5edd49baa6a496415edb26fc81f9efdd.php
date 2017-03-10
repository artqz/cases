<?php $__env->startSection('title', 'Общение - '); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <?php echo Breadcrumbs::render('discuss'); ?>

        <h1>Общение</h1>

        <ul class="channels-list">
            <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li class="channel-item">
                    <div><a href="<?php echo e(url('discuss/channels/'.$channel->slug)); ?>"><?php echo e($channel->name); ?></a></div>
                    <div><?php echo e($channel->description); ?></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div>Тут можно добавить раздел</div><br>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('discuss/create-channel')); ?>">Добавить раздел</a>
        </div>
    </div>
    <?php endif; ?>

    <?php echo app('arrilot.widget')->run('WidgetChat'); ?>

    <?php echo $__env->make('widgets.reklama', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo app('arrilot.widget')->run('WidgetTopClickers'); ?>

    <?php echo app('arrilot.widget')->run('WidgetLastPosts'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('style'); ?>
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .channels-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .channel-item {
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