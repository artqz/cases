<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить тему</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/discuss/channels/'. $slug_channel .'/create-theme')); ?>">
                <?php echo e(csrf_field()); ?>


                <input id="slug_channel" type="hidden" class="form-control" name="slug_channel" value="<?php echo e($slug_channel); ?>">

                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="name" class="col-md-4 control-label">Название темы</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                        <?php if($errors->has('name')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                    <label for="text" class="col-md-4 control-label">Текст сообщения</label>

                    <div class="col-md-6">
                        <textarea id="text" type="" class="form-control" name="text" value="<?php echo e(old('text')); ?>" required></textarea>

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