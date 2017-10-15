<?php $__env->startSection('title'); ?>
<?php echo e('Payment and Collection'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Utilites</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
 <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                             
                        </div>
                        <div>
                             
                              
                            
                                <div class="box-body">
                                  <?php $__currentLoopData = $reading; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $read): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Utility Type</label>
                                      </div>

                                      <div class="col-md-2">
                                        <?php if($read->utilType==1): ?>
                                          <input type="text" class="form-control" data-id="<?php echo e($read->utilType); ?>" value="Electricity" name="utilityType" readonly>
                                         <?php elseif($read->utilType==2): ?>
                                          <input type="text" class="form-control" data-id="<?php echo e($read->utilType); ?>" value="Water" name="utilityType"readonly >
                                          <?php endif; ?> 
                                      </div>

                                  </div>

                                     <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Date From:</label>
                                      </div>

                                      <div class="col-md-2">
                                         <input type="text" class="form-control" name="dateFrom" id="date_from" value="<?php echo e(\Carbon\Carbon::parse($read->readingFrom)->format('Y-m-d')); ?>" readonly>
                                      </div>

                                      <div class="col-md-1">
                                          <label>Date To:</label>
                                      </div>

                                      <div class="col-md-2">
                                         <input type="text" class="form-control" name="dateTo" id="date_to" value="<?php echo e(\Carbon\Carbon::parse($read->readingTo)->format('Y-m-d')); ?>" readonly>
                                      </div>
                                  </div> 

                                     <div class="row" style="margin-top: 15px;">
                                      <div class="col-md-8" style="text-align: center; font-size: 20px;">
                                          <label>Total Bill</label>
                                      </div>
                                  </div>

                                   <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Previous Reading</label>
                                      </div>
                                      <div class="col-md-2">
                                        <input type="text" class="form-control reading" name="prevRead" id="prev_read" value="<?php echo e($read->prevReading); ?>" disabled>
                                      </div>

                                       <div class="col-md-2">
                                          <label>Present Reading</label>
                                      </div>
                                      <div class="col-md-2">
                                        <input type="text" class="form-control reading" name="presRead" id="pres_read" value="<?php echo e($read->presReading); ?>" >
                                      </div>
                                  </div>

                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Total Bill Amount:</label>
                                      </div>
                                      <div class="col-md-2">
                                          <input type="text" class="form-control money" name="totalBill" id="total_bill" value="<?php echo e($read->totalBillAmount); ?>"  >
                                      </div>

                                       <div class="col-md-2">
                                          <label>Rate:</label>
                                      </div>
                                      <div class="col-md-2">
                                          <input type="text" class="form-control money" name="multiplierAmt" id="multiplier_amt" value="<?php echo e($read->multiplier); ?>" disabled>
                                      </div>
                                  </div>

                                  <div class="row">
                                       <div class="col-md-8" style="margin-top: 20px;">
                                      <table class="table table-bordered">
                                          <thead>
                                              <tr>
                                                  <th>Stall Code</th>
                                                  <th>Previous Reading</th>
                                                  <th>Present Reading</th>
                                                  <th>Total Amount</th>
                                              </tr>
                                          </thead>
                                          <tbody class="stallList">
                                           
                                          </tbody>
                                      </table>
                                  </div>
                                  </div>

                                  <div class="row" style="margin-top: 20px;">
                                      <div class="col-md-4">
                                          <button class="btn btn-success" id="isFinalize" data-id="<?php echo e($read->readingID); ?>" >Finalize</button>
                                          <button class="btn btn-primary" id="update" data-id="<?php echo e($read->readingID); ?>" >Update</button>
                                          <a href="<?php echo e(url('/Utilities')); ?>"><button class="btn btn-danger">Cancel</button></a>
                                      </div>
                                  </div>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                             
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/utility.js')); ?>"></script>

<script type="text/javascript">
  
 $(".collectTo").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php ',
  });
   $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        endDate: 'today'
      });
   $(".reading").inputmask("9999999", { numericInput: true, placeholder: "0",clearMaskOnLostFocus: false});
    $(".money").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php ',
  });


<?php foreach ($subMeter as $sub): ?>

        $('.stallList').append('<tr><td><?php echo e($sub->stall); ?></td><td><input type="text" value="<?php echo e($sub->prev); ?>" class="form-control reading2" id="sub_prev" name="subPrev" disabled></td><td><input type="text" class="form-control reading2" id="sub_pres" name="subPres" value = "<?php echo e($sub->pres); ?>"  ></td><td><input type="text" class="form-control money2" id="total_amt" name="totalAmt" value = "<?php echo e($sub->amount); ?>" disabled></td><td><input type="hidden" name="subMeterID" value="<?php echo e($sub->subID); ?>"></td><td><input type="hidden" name="meterID" value="<?php echo e($sub->metID); ?>"></td></tr>');  

<?php endforeach ?>  
 $(".reading2").inputmask("9999999", { numericInput: true, placeholder: "0",clearMaskOnLostFocus: false});
$(".money2").inputmask('currency', {rightAlign: true, prefix: 'Php '});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>