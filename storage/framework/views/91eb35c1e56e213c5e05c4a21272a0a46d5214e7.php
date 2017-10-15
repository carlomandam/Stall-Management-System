 <?php $__env->startSection('title'); ?> <?php echo e('Bill Lists'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
    <li class="active">Billing</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="defaultNewButton">
    <a href="<?php echo e(URL::previous()); ?>">
        <input type="hidden" name="id" value="">
        <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</button>
    </a>
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <form method="get" action="/createBill">
                    <?php echo e(csrf_field()); ?>

                    <button name="id" value="<?php echo e($contract->contractID); ?>" class="btn btn-primary btn-flat"><span class='fa fa-plus'></span>&nbspCreate Bill</button>
                </form>
            </div>
            <table id="billList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Bill ID</th>
                        <th>Billing Period</th
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $billID; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e(date("Ymd000",strtotime($bill->created_at)).$bill->billDetID); ?></th>
                        <th><?php echo e(date("F d, Y",strtotime($bill->Billing->billDateFrom))." - ".date("F d, Y",strtotime($bill->Billing->billDateTo))); ?></th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/billing.js')); ?>"></script>
<script type="text/javascript">
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>