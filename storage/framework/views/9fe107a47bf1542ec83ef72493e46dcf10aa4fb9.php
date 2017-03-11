<?php if(Session::has('flash_message')): ?>
    <div class="alert alert-<?php echo e(session('flash_message_status')); ?>">
        <?php echo e(session('flash_message')); ?> <?php if(Session::has('flash_message_value')): ?> <span class="price"><?php echo e(session('flash_message_value')); ?></span> <?php endif; ?>
    </div>
<?php endif; ?>