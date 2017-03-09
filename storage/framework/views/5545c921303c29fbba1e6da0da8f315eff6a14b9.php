<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить пост</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/discuss/channels/'. $slug_channel .'/'. $slug_theme .'/create-post')); ?>">
                <?php echo e(csrf_field()); ?>


                <input id="slug_theme" type="hidden" class="form-control" name="slug_theme" value="<?php echo e($slug_theme); ?>">

                <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                    <label for="text" class="col-md-4 control-label">Текст сообщения</label>

                    <div class="col-md-6">
                        <textarea id="text" class="form-control" name="text" value="<?php echo e(old('text')); ?>" required autofocus><?php echo e($reply); ?></textarea>

                        <?php if($errors->has('text')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('text')); ?></strong>
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