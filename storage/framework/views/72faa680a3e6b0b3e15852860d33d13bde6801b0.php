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
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                              <h4 class="box-title">Monthly Reading List</h4>
                        </div>
                        <div>
                              <div class="box-body">
                                  <a href="<?php echo e(url('/Utilities/create')); ?>">
                                     <button type="submit" class="btn btn-primary  pull-left" id="create"><span class='glyphicon glyphicon-plus'></span>&nbspNew Reading
                                    </button>
                                  </a>
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 
                                           <table id="monthlyList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No.</th>
                                                    <th>Utility Type</th>
                                                    <th>Date From:</th>
                                                    <th>Date To:</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $monthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <tr>
                                                        <td><?php echo e(++ $key); ?></td>
                                                        <td>
                                                          <?php if($mon->utilType==1): ?>
                                                            Electricity
                                                          <?php elseif($mon->utilType==2): ?>
                                                            Water
                                                          <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e(\Carbon\Carbon::parse($mon->readingFrom)->format('F d, Y')); ?></td>
                                                        <td><?php echo e(\Carbon\Carbon::parse($mon->readingTo)->format('F d, Y')); ?></td>
                                                        <td>
                                                          <?php if($mon->isFinalize==null): ?>
                                                          <button class="btn btn-primary" data-id ="<?php echo e($mon->readingID); ?>" id="view">View</button>
                                                          <button class="btn btn-info" data-id ="<?php echo e($mon->readingID); ?>" id="finalize">Finalize</button>
                                                          <!-- <button>Update</button> -->
                                                          <?php elseif($mon->isFinalize==1): ?>
                                                           <button class="btn btn-primary" data-id ="<?php echo e($mon->readingID); ?>" id="view">View</button>
                                                          <?php endif; ?>
                                                        </td>
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
<script type="text/javascript" src ="js/utility.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>