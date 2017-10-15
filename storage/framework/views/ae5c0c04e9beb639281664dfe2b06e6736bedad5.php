<?php $__env->startSection('title'); ?>
<?php echo e('Pending Payments'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="box box-solid box-default">
  <div class="box-body" >
    <div class="col-md-12">
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
         <h4 class="box-title">Pending Payments</h4>
        </div>
        <div>

          <div class="box-body">
            <div class="col-xs-12">

             <button type="submit" class="btn btn-primary pull-left" style="margin-right: 2%" data-toggle="modal" data-target="#new"><span class='glyphicon glyphicon-plus'></span>Charge StallHolders</button>
              
                <div class="table-responsive">
                  <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">

                      <thead>
                        <tr>
                          <th>StallHolder Name</th>
                          <th>Stall Code</th>
                          <th>Status</th>
                          <th>Current Balance</th>
                          <th>Action/s</th>
                        </tr>
                      </thead>
                      <tr>
                        <th>Brixter Kim</th>
                        <th>A001</th>
                        <th><span class="label label-warning">Warning</span></th>
                        <th>Php 1000.00</th>
                        <th>
                          <button type="" class="btn btn-primary" onclick="window.location='<?php echo e(url('/ViewPayment')); ?>'">View
                          </th>
                        </tr>
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
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>