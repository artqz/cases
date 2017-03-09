<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Добавить игру</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/admin/games/create-game')); ?>">
                <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('game_id') ? ' has-error' : ''); ?>">
                    <label for="game_id" class="col-md-4 control-label">ID игры</label>

                    <div class="col-md-6">
                        <input id="game_id" type="text" class="form-control" name="game_id" value="<?php echo e(old('game_id')); ?>" required autofocus>

                        <?php if($errors->has('game_id')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('game_id')); ?></strong>
                                </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('price') ? ' has-error' : ''); ?>">
                    <label for="price" class="col-md-4 control-label">Цена в кликах</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control" name="price" value="<?php echo e(old('price')); ?>" required autofocus>

                        <?php if($errors->has('price')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('price')); ?></strong>
                                </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('data') ? ' has-error' : ''); ?>">
                    <label for="data" class="col-md-4 control-label">Сылка на гифт или ключ</label>

                    <div class="col-md-6">
                        <input id="data" type="text" class="form-control" name="data" value="<?php echo e(old('data')); ?>" required autofocus>

                        <?php if($errors->has('data')): ?>
                            <span class="help-block">
                                    <strong><?php echo e($errors->first('data')); ?></strong>
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