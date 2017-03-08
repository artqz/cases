<?php if(count($user)): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Топ кликеров
        </div>
        <div class="panel-body">
            <ul class="widget-users-list">
                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li class="widget-users-item">
                        <?php echo e($key+1); ?>. <span class="widget-themes-user"><img src="https://secure.gravatar.com/avatar/<?php echo e($value->email_hash); ?>?s=32&d=identicon"><?php echo e($value->name); ?></span>
                        <span>(<?php echo e($value->all_clicks); ?>)</span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>