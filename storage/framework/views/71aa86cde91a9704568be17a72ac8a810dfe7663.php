<?php echo e(Form::open(['url' => 'branchsalestargets'])); ?>

<div class="modal-body">
<div class="form-group">
    <?php echo e(Form::label('month', __('Month'),['class' => 'col-form-label'])); ?>

    <?php echo e(Form::text('month', null, ['class' => 'form-control', 'placeholder' => __('Select Month'), 'readonly' => ''])); ?>

</div>

<?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="form-group">
        <?php echo e(Form::label('branch_'.$key, ucfirst($branch),['class' => 'col-form-label'])); ?>

        <?php echo e(Form::hidden('branches[]', $key)); ?>

        <?php echo e(Form::number('amount[]', null, ['class' => 'form-control', 'id'=>'branch_'.$key, 'placeholder' => __('Enter Target Amount'), 'step' => '0.01'])); ?>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input class="btn btn-primary" type="submit" value="<?php echo e(__('Create')); ?>">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\wamp65\www\pos\resources\views/branchsalestargets/create.blade.php ENDPATH**/ ?>