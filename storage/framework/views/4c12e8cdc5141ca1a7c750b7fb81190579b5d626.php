<?php if(count($last_buy_items)): ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            Последние купленные вещи
        </div>
        <div class="panel-body">
            <ul class="widget-items-list">
                <?php $__currentLoopData = $last_buy_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li class="widget-items-item">
                        <span class="widget-items-user"><img src="https://secure.gravatar.com/avatar/<?php echo e($item->user['email_hash']); ?>?s=32&d=identicon"><?php echo e($item->user->name); ?></span> купил предмет
                        <span class="widget-items-name"><img src="<?php echo e($item->icon_url); ?>" alt="<?php echo e($item->name); ?>"> <?php echo e($item->name); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
