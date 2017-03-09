<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Редактировать пост</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/discuss/channels/'. $slug_channel .'/'. $slug_theme .'/'. $post->id .'/edit-post')); ?>">
                <?php echo e(csrf_field()); ?>


                <input id="id_post" type="hidden" class="form-control" name="id_post" value="<?php echo e($post->id); ?>">

                <div class="form-group<?php echo e($errors->has('text') ? ' has-error' : ''); ?>">
                    <label for="text" class="col-md-4 control-label">Текст сообщения</label>

                    <div class="col-md-6">
                        <textarea id="text" class="form-control" name="text" required autofocus><?php echo e($post->text); ?></textarea>

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
                            Редактировать
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>