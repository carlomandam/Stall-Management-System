 <?php $__env->startSection('title'); ?> <?php echo e('Payment'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/panel-tab.css')); ?>">
<style type="text/css">
    .col-md-12,
    .row {
        margin-top: 10px;
    }
    
    table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
        cursor: pointer;
    }
    
    #table2,
    #backButton {
        display: none;
    }
</style> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 style="display: inline !important;">MySeoul</h4>
                <div class="pull-right" style="display: inline !important;">
                    <h4 style="display: inline !important;">Receipt</h4> </div>
            </div>
            <div class="box-body">
                <div class="col-md-9">
                    <label>Transaction ID:</label> #00001 </div>
                <div class="col-md-3">
                    <label>Date:</label> <?php echo e(date("F d, Y")); ?> </div>
                <div class="col-md-9">
                    <label>Customer Name:</label> <?php echo e($contract->StallHolder->stallHFName." ".strtoupper($contract->StallHolder->stallHMName[0]).". ".$contract->StallHolder->stallHLName); ?></div>
                <div class="col-md-3">
                    <label>Stall No.:</label> <?php echo e($contract->stallID); ?> </div>
                <div class="col-md-12">
                    <label>Customer Address:</label> <?php echo e($contract->StallHolder->stallHAddress); ?> </div>
                <div class="col-md-12">
                    <label>Contact No:</label> <?php for($i = 0;$i < count($contract->StallHolder->ContactNo);$i++){ echo $contract->StallHolder->ContactNo[$i]->contactNumber; if($i < count($contract->StallHolder->ContactNo) - 1) echo ", ";}?> </div>
                <div class="col-md-12">
                    <label>Email: </label> <?php echo e($contract->StallHolder->stallHEmail); ?>

                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:80%">Description</th>
                                <th style="width:20%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0?>
                            <?php if(isset($init)): ?>
                            <?php $__currentLoopData = $init; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td>
                                <?php echo e($i->InitialFee->initDesc); ?>

                            </td>
                            <td>
                                ₱ <?php echo e(number_format($i->InitialFee->initAmt,2,'.',',')); ?>

                            </td>
                            <?php $total += $i->InitialFee->initAmt;?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(isset($pc)): ?>
                            <tr>
                                <td><label>Collections</label> </td>
                                <td></td>
                            </tr>
                            <?php $__currentLoopData = $pc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($p['date']); ?> - <?php echo e(date("l",strtotime($p['date']))); ?> </td>
                                <td> ₱ <?php echo e(number_format($p['amount'],2,'.',',')); ?> </td>
                                <?php $total += $p['amount'];?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(isset($bill)): ?>
                            <tr>
                                <td><label>Bills</label> </td>
                                <td></td>
                            </tr>
                            <?php $__currentLoopData = $bill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e(date("Ymd000",strtotime($b->created_at)).$b->billDetID); ?> 
                                </td>
                                <td>
                                </td>
                            </tr>
                            <?php $__currentLoopData = $b->Billing_Utilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $util): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td>
                                <?php echo e(($util->MonthlyReading->utilType == 1) ? "Electric Bill" : (($util->MonthlyReading->utilType == 2) ? "Water":"Unknown Utility Type")); ?> 
                            </td>                                                               
                            <td>
                                ₱ <?php echo e(number_format($util->utilityAmt,2,'.',',')); ?>

                            </td>
                            </tr>
                            <?php $total += $util->utilityAmt;?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $b->Charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td>
                                <?php echo e(($charge->chargeID == null) ? $charge->chargeDesc : $charge->Charges->chargeName); ?>

                            </td>
                            <td>
                                ₱ <?php echo e(number_format(($charge->chargeID == null) ? $charge->chargeAmt : $charge->Charges->chargeAmount,2,'.',',')); ?>

                                <?php $total += number_format(($charge->chargeID == null) ? $charge->chargeAmt : $charge->Charges->chargeAmount,2,'.',',');?>
                            </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 pull-right">
                <lable>Total:</lable>  ₱ <?php echo e(number_format($total,2,'.',',')); ?>

                <br>
                <lable>Amount Paid:</lable>
                <br> </div>
            </div>
        </div>
        <div class="defaultNewButton pull-right">
            <a href="<?php echo e(url('/Payment')); ?>">
                <button class="btn btn-primary btn-flat"><span class='glyphicon glyphicon-print'></span>&nbsp;Print PDF</button>
            </a>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).on('ready', function () {
       
    });
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>