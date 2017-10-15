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
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                              <h4 class="box-title">Requests List</h4>
                        </div>
                        <div>
                              <div class="box-body">
                                <a href="<?php echo e(url('/Requests/create')); ?>">
                                  <button class="btn btn-primary  pull-left"><span class='glyphicon glyphicon-plus'></span>&nbspNew Request
                                  </button>
                                </a>
                                 
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 
                                           <table id="requestList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No.</th>
                                                    <th>Stall Holder</th>
                                                    <th>Request Type</th>
                                                    <th>Status</th>
                                                    <th>Date Submited</th>
                                                    <th>Date Approved</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                   <?php $__currentLoopData = $reqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <tr>
                                                      <td><?php echo e(++$key); ?></td>
                                                      <td><?php echo e($req->stallHFName); ?> <?php echo e($req->stallHMName); ?> <?php echo e($req->stallHLName); ?></td>
                                                      <?php if($req->requestType==1): ?>
                                                      <td>Transfer Stall</td>
                                                      <?php elseif($req->requestType ==2): ?>
                                                      <td>Leave Stall</td>
                                                      <?php endif; ?>
                                                      <?php if($req->status == 0): ?>
                                                      <td>Pending</td>
                                                      <?php elseif($req->status == 1): ?>
                                                      <td>Approved</td>
                                                      <?php elseif($req->status == 2): ?>
                                                      <td>Not Approved</td>
                                                      <?php endif; ?>
                                                    
                                                     <td><?php echo e(\Carbon\Carbon::parse($req->submitDate)->format('F d, Y')); ?>

                                                     </td>
                                                     <?php if($req->status == 1): ?>
                                                     <td><?php echo e(\Carbon\Carbon::parse($req->approvedDate)->format('F d, Y')); ?></td>
                                                     <?php else: ?>
                                                     <td> </td>
                                                     <?php endif; ?>   
                                                        
                                                      <?php if($req->status == 0): ?>
                                                      <td>
                                                        <button class="btn btn-info" id="view" data-id="<?php echo e($req->requestID); ?>">View</button>
                                                        <button class="btn btn-primary" data-id="<?php echo e($req->requestID); ?>">Update</button>
                                                      </td>
                                                      <?php elseif($req->status == 1): ?>
                                                      <td>
                                                        <button class="btn-info" id="view" data-id="<?php echo e($req->requestID); ?>">View</button>
                                                      </td>
                                                      <?php elseif($req->status == 2): ?>
                                                      <td>
                                                        <button class="btn-info" id="view" data-id="<?php echo e($req->requestID); ?>">View</button>
                                                      </td>
                                                      <?php endif; ?>
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
<script type="text/javascript" src ="js/request.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>