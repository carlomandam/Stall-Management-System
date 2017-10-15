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
                                  <div class="row">
                                      <div class="col-md-2">
                                        <label>Request Type</label>
                                      </div>
                                      <div class="col-md-2">
                                        <select class="form-control" name="requestType" id="requestType">
                                           <option selected disabled>---/----</option>
                                            <option value="1">Transfer Stall</option>
                                            <option value="2">Leave Stall</option>
                                        </select>
                                      </div>
                                  </div>

                                  <div class="transferStall" id="transferStall" style="display: none">

                                      <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                              <label>Name:</label>
                                          </div>
                                          <div  class="col-md-1">
                                              <select id="tenantTS" name="tenantTS" >
                                                  <option selected disabled>Choose Tenants Name</option>
                                                  <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($tenant->id); ?>"><?php echo e($tenant->firstName); ?> <?php echo e($tenant->middleName); ?> <?php echo e($tenant->lastName); ?></option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Stall:</label>
                                        </div>
                                        <div  class="col-md-4">
                                         
                                            <table class="table table-bordered">
                                              <thead>
                                                  <tr>
                                                      <th>Current Stall</th>
                                                      <th>Desired Stall</th>
                                                  </tr>
                                              </thead>
                                              <tbody class="currentStallTS">
                                                
                                              </tbody>
                                              
                                            </table>
                                        </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Reason:</label>
                                        </div>
                                        <div  class="col-md-4">
                                          <textarea class="form-control" name="transferReasonTS" rows="5"> </textarea>
                                        </div>
                                      </div>

                                       <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                          <button class="btn btn-primary" id="saveTransferStall">Save</button>
                                          <button class="btn btn-danger">Cancel</button>
                                        </div>
                                       
                                      </div>

                                  </div>
                                  <!-- Transafer Stall -->

                                  <div class="leaveStall" id="leaveStall" style="display: none;">

                                      <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                              <label>Name:</label>
                                          </div>
                                          <div  class="col-md-1">
                                              <select id="tenantLS" name="tenantLS" >
                                                  <option selected disabled>Choose Tenants Name</option>
                                                  <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option value="<?php echo e($tenant->id); ?>"><?php echo e($tenant->firstName); ?> <?php echo e($tenant->middleName); ?> <?php echo e($tenant->lastName); ?></option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Stall:</label>
                                        </div>
                                        <div  class="col-md-4">
                                         
                                            <table class="table table-bordered">
                                              <thead>
                                                  <tr>
                                                      <th>Current Stall</th>
                                                      <th>Desired Stall</th>
                                                  </tr>
                                              </thead>
                                              <tbody class="currentStallLS">
                                                
                                              </tbody>
                                              
                                            </table>
                                        </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Reason:</label>
                                        </div>
                                        <div  class="col-md-4">
                                          <textarea class="form-control" name="transferReasonLS" rows="5"> </textarea>
                                        </div>
                                      </div>

                                       <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                          <button class="btn btn-primary" id="saveLeaveStall">Save</button>
                                          <button class="btn btn-danger">Cancel</button>
                                        </div>
                                       
                                      </div>

                                  </div>
                                  <!-- Leaving the Stall -->


                            </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
 <script type="text/javascript" src="<?php echo e(URL::asset('js/request.js')); ?>"></script>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>