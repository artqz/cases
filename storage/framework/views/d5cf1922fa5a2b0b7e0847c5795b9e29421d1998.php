<?php $__env->startSection('title', 'Мои игры - '); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <?php echo Breadcrumbs::render('mygames'); ?>

        <ul class="items-list">
            <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li class="items-item">
                    <span class="item-buy-name"><img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>"> <?php echo e($game->name); ?></span>
                    <?php if($game->status == 1): ?><span class="label label-default">Ожидание выдачи</span><?php elseif($game->status == 2): ?><span class="label label-success">Выдано</span><?php endif; ?>
                    <div class="pull-right">
                        <span class="item-user"><?php echo e($game->data); ?></span>
                    </div>
                    <div class="clearfix"></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
        <div><?php echo e($games->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .items-list {
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
        .items-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }

        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            background-color: #ad75bb;
            border-color: #8b7796;
            cursor: default;
        }
        .pagination>li:first-child>a, .pagination>li:first-child>span {
            margin-left: 0;
            border-radius: 0;
        }

        .pagination>li:last-child>a, .pagination>li:last-child>span {
            border-radius: 0;
        }

        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.6;
            text-decoration: none;
            color: #a04eb4;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-left: -1px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>