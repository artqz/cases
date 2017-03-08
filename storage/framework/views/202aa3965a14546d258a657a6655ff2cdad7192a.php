<?php if(count($last_buy_games)): ?>
    <div class="panel panel-warning">
        <div class="panel-heading">
            Последние купленные игры
        </div>
        <div class="panel-body">
            <ul class="widget-games-list">
                <?php $__currentLoopData = $last_buy_games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li class="widget-games-item">
                        <span class="widget-games-user"><img src="https://secure.gravatar.com/avatar/<?php echo e($game->user['email_hash']); ?>?s=32&d=identicon"><?php echo e($game->user->name); ?></span> купил игру <span class="widget-games-name"><img src="<?php echo e($game->header_image); ?>" alt="<?php echo e($game->name); ?>"> <?php echo e($game->name); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>