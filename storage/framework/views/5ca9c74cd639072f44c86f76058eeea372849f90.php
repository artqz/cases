<?php $__env->startSection('title', $theme->name . ' - ' . $theme->channel->name . ' - Общение - '); ?>

<?php $__env->startSection('content'); ?>
    <div>
        <?php echo Breadcrumbs::render('themes', $theme->channel, $theme); ?>

        <h1><?php echo e($theme->name); ?></h1>
        <ul class="posts-list">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li class="posts-item">
                    <div class="post-date pull-right"><?php echo e($post->created_at); ?></div>
                    <div class="post-author">
                        <img src="https://secure.gravatar.com/avatar/<?php echo e($post->user['email_hash']); ?>?s=32&d=identicon"> <?php echo e($post->user['name']); ?>

                    </div>
                    <div class="post-text">
                        <?php echo e($post->text); ?>

                    </div>
                    <div class="pull-right">
                        <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
                            <a href="<?php echo e(url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/'. $post->id .'/delete-post/')); ?>" class="post-reply btn btn-xs btn-danger">Удалить</a>
                        <?php endif; ?>
                        <?php if(Auth::id() == $post->user->id): ?>
                        <a href="<?php echo e(url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/'. $post->id .'/edit-post/')); ?>" class="post-reply btn btn-xs btn-default">Редактировать</a>
                        <?php endif; ?>
                        <a href="<?php echo e(url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/create-post?reply='. $post->user->name)); ?>" class="post-reply btn btn-xs btn-default">Ответить</a>
                    </div>
                    <div class="clearfix"></div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
        <div><?php echo e($posts->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?php if(\Auth::id() == \Config::get('main.admin_id')): ?>
                <div>Тут можно редактировать тему</div><br>
                <a class="btn btn-sm btn-success" href="<?php echo e(url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/edit-theme')); ?>">Редактировать тему</a>
                <hr>
            <?php endif; ?>
            <div>Может пора написать пост?</div><br>
            <a class="btn btn-sm btn-success" href="<?php echo e(url('discuss/channels/'. $slug_channel .'/'. $theme->slug .'/create-post')); ?>">Добавить пост</a>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('style'); ?>
    <style>
        button[disabled], html input[disabled] {
            cursor: no-drop;
        }
        .posts-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .posts-item {
            margin-bottom: 15px;
            display: block;
            color: #777;
            border: 1px solid #e3e3e3;
            padding: 10px;
            background-color: white;
            position:relative;
        }
        .post-date {
            font-size: 10px;
            color: #b2b2b2;
        }
        .post-author {
            padding-left: 25px;
            color: #a04eb4;
            margin-bottom: 7px;
        }
        .post-author img {
            width:20px;
            height:20px;
            position:absolute;
            top:10px;
            left:10px;
            border-radius:50%;
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