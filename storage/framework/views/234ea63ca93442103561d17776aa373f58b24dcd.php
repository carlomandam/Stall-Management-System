<?php $__env->startSection('title'); ?>
<?php echo e('Request'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Manage Request</li>
  <li class="active">Request List</li>
</ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="box box-solid box-default">
  <div class="box-body" >
    <div class="col-md-12">
      <div class="box box-solid box-primary">
        <div class="box-header with-border">
          <h4 class="box-title">List of Requests</h4>
        </div>
        <div>

          <div class="box-body">


            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary pull-left" onclick = "window.location='<?php echo e(url('/NewRequest')); ?>'"><span class='glyphicon glyphicon-plus'></span>&nbspNew Request</button>
                <div class="table-responsive">

                  <table id="prodtbl" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                    <thead>
                      <tr>
                        <th>Request No.</th>
                        <th>Stall Holder Name</th>
                        <th>Request Type</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Action/s</th>
                      </tr>
                    </thead>
                    <tr>
                      <th>A001</th>
                      <th>Stall Rate</th>
                      <th>03/21/2017</th>
                      <th><span class="label label-warning">Pending</span></th>
                      <th>100</th>
                      <th><button type="" class="btn btn-success">Update
                        <button type="" class="btn btn-warning">Cancel
                        <button type="" class="btn btn-primary">Print
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