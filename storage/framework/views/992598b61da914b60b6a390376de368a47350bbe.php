<div class="card-body">
    <div class="table-responsive p-2">
        <table class="table table-bordered mt-1">
            <tbody>

                <tr>
                    <td class="fw-bold"><?php echo e(__('Title')); ?></td>
                    <td class="text-right"><?php echo e(!empty($current_month_event->title) ? $current_month_event->title : '-'); ?>

                    </td>
                </tr>
                <tr>
                    <td class="fw-bold"><?php echo e(__('Description')); ?></td>
                    <td class="text-right">
                        <?php echo e(!empty($current_month_event->description) ? $current_month_event->description : '-'); ?></td>
                </tr>
                <tr>
                    <td class="fw-bold"><?php echo e(__('Start Date')); ?></td>
                    <td class="text-right">
                        <?php echo e(date('d F Y', strtotime($current_month_event->start))); ?></td>
                </tr>
                <tr>
                    <td class="fw-bold"><?php echo e(__('End Date')); ?></td>
                    <td class="text-right">
                        <?php echo e(date('d F Y', strtotime($current_month_event->end))); ?></td>
                </tr>

            </tbody>
        </table>

    </div>
</div>
<?php /**PATH C:\wamp65\www\pos\resources\views/calendars/show.blade.php ENDPATH**/ ?>