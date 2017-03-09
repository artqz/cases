<?php $__env->startSection('title', 'Предметы - Магазин - '); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <?php echo $__env->make('layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Breadcrumbs::render('items'); ?>

        <h1>Вещи</h1>
        <div class="row items-categories">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="col-sm-3 col-md-3">
                    <a class="category <?php echo e(Request::is('shop/items/g/'.$category->category->appid) ? 'active' : ''); ?>" href="<?php echo e(url('shop/items/g/'.$category->category->appid)); ?>">
                        <img class="category-icon" src="<?php echo e(url('images/games/icons/'.$category->category->appid.'.jpg')); ?>" alt="<?php echo e($category->category->name); ?>">
                        <span class="category-name"><?php echo e($category->category->name); ?></span>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
        <br>
        <div class="items-list row">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="items-item">
                        <div class="item-name"><?php echo e($item->name); ?></div>
                        <img src="<?php echo e($item->icon_url); ?>" alt="<?php echo e($item->name); ?>">
                        <div class="item-price">Цена: <?php echo e($item->price); ?> Клик.</div>
                        <div class="pull-right"><a href="<?php echo e(url('/shop/items/'. $item->id .'/buy-item')); ?>" class="btn btn-xs btn-default">Купить</a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
        <div class="clearfix"></div>
        <div><?php echo e($items->links()); ?></div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div>Тут можно добавить игру или предмет</div><br>
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
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>