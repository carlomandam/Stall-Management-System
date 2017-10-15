 <?php $__env->startSection('title'); ?> <?php echo e('Payment and Collection'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
    <li class="active">Billing</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div>
    <div class="box box-solid box-default">
        <div class="box-body">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"></h4> </div>
                    <div>
                        <div class="box-body">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="stallList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                        <thead>
                                            <tr>
                                                <th>Stall Code</th>
                                                <th>Stall Holder</th>
                                                <th>Action/s</th>
                                            </tr>
                                        </thead>
                                        <tbody> <?php $__currentLoopData = $stalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($stall->stallID); ?></td>
                                                <td><?php echo e($stall->StallHolder->stallHFName); ?>&nbsp<?php echo e($stall->StallHolder->stallHMName); ?>&nbsp<?php echo e($stall->StallHolder->stallHLName); ?></td>
                                                <td>
                                                    <form method="get" action="/ViewBill">
                                                        <?php echo e(csrf_field()); ?>

                                                        <button class="btn btn-success" name="id" value="<?php echo e($stall->contractID); ?>">View</button>
                                                    </form>
                                                </td>
                                            </tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/billing.js')); ?>"></script>
<script type="text/javascript">
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>