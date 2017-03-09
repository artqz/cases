<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить раздел</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/discuss/create-channel')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="name" class="col-md-4 control-label">Доступ</label>
                    <div class="col-md-6">
                    <select id="type" class="form-control" name="type" required autofocus>
                        <option value="0">Для всех</option>
                        <option value="1">Для админа</option>
                    </select>
                    </div>
                </div>
                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="name" class="col-md-4 control-label">Название раздела</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                        <?php if($errors->has('name')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                    <label for="description" class="col-md-4 control-label">Описание раздела</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control" name="description" value="<?php echo e(old('description')); ?>" required autofocus>

                        <?php if($errors->has('description')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('description')); ?></strong>
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