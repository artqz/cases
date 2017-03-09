<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить игру</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/shop/game/create')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('link_app') ? ' has-error' : ''); ?>">
                    <label for="link_app" class="col-md-4 control-label">Ссылка на игру в стим</label>

                    <div class="col-md-6">
                        <input id="link_app" type="text" class="form-control" name="link_app" value="<?php echo e(old('link_app')); ?>" required autofocus>

                        <?php if($errors->has('link_app')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('link_app')); ?></strong>
                                </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Добавить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>