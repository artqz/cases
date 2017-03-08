<?php if(Session::has('flash_message')): ?>
    <div class="alert alert-<?php echo e(session('flash_message_status')); ?>">
        <?php echo e(session('flash_message')); ?>

    </div>
<?php endif; ?>