<?php $__env->startSection('content'); ?>
    <h1>Профиль

    <h3>Реферальная программа</h3>
    <p>Ваша ссылка - http://steamclicks.ru/r/<?php echo e(Auth::id()); ?></p>
    <p>По вашей ссылке зарегистрировалось <?php echo e($referral_count); ?> чел., которые принесли вам <?php echo e($referral_clicks); ?> Клик.</p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>