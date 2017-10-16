<?php $__env->startSection('title'); ?>
<?php echo e('Payment'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Payment</li>
</ol>

<style>
    .yellow{
      background-color: #f7e64c;
      color:black;
    }
    .label{
      font-size:14px;
    }
    th,td{
      text-align: center;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                              <h4 class="box-title"></h4>
                        </div>
                        <div>
                              <div class="box-body">
                               
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 
                                           <table id="stallList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>Stall Code</th>
                                                    <th>Tenant Name</th>
                                                    <th>Collection Status</th>
                                                    <th>Balance</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                
                                                 <?php $__currentLoopData = $stalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  
                                                  <tr>    
                                                     <td><?php echo e($stall->stallCode); ?></td>

                                                     <td><?php echo e($stall->tenantName); ?></td>

                                                    <td>
                                                    <center>
                                                      <?php if($totalUnpaid[$key]['status'] == 'COLLECT'): ?>
                                                          <label class="label bg-primary"><?php echo e($totalUnpaid[$key]['status']); ?></label>
                                                      <?php elseif($totalUnpaid[$key]['status'] == 'REMINDER'): ?>
                                                          <span class="label bg-green"><label><?php echo e($totalUnpaid[$key]['status']); ?></label></span>
                                                      <?php elseif($totalUnpaid[$key]['status'] == 'WARNING'): ?>
                                                          <span class="label yellow"><label><?php echo e($totalUnpaid[$key]['status']); ?></label></span>
                                                      <?php elseif($totalUnpaid[$key]['status'] == 'LOCK'): ?>
                                                          <span class="label bg-orange"><label><?php echo e($totalUnpaid[$key]['status']); ?></label></span>
                                                      <?php elseif($totalUnpaid[$key]['status'] == 'TERMINATE'): ?>
                                                          <span class="label bg-red"><label><?php echo e($totalUnpaid[$key]['status']); ?></label></span>
                                                    <?php endif; ?>
                                                    </center>
                                                    </td>

                                                     <td>₱ <?php echo e(number_format($totalUnpaid[$key]['amount'],2)); ?></td>

                                                     <td><a href="/ViewPayment/<?php echo e($stall->contractID); ?>"><button class="btn btn-primary">Proceed to Payment</button></a></td>
                                                  </tr>

                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            
                                            </table>
                                          </div>
                                    </div>  
                              </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/billing.js')); ?>"></script>
<script type="text/javascript">
 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>