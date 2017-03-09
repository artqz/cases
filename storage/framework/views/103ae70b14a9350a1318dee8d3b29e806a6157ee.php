<?php if(count($last_posts)): ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        Последние ответы
    </div>
    <div class="panel-body">
        <ul class="widget-themes-list">
        <?php $__currentLoopData = $last_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <li class="widget-themes-item">
                <span class="widget-themes-user"><img src="https://secure.gravatar.com/avatar/<?php echo e($post->user['email_hash']); ?>?s=32&d=identicon"><?php echo e($post->user->name); ?></span> ответил в теме
                <a href="<?php echo e(url('discuss/channels/'.$post->theme->channel->slug.'/'.$post->theme->slug)); ?>"><?php echo e($post->theme->name); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
</div>
<?php endif; ?>