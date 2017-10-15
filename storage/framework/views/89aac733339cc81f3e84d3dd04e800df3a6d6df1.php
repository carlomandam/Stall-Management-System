<?php $__env->startSection('title'); ?>
<?php echo e('Collections'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Collections</li>
</ol>
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
                                     <div class="defaultNewButton">
                                          <a href="<?php echo e(url('/CreateCollection/'.$storeID)); ?>"> <button class="btn btn-primary btn-flat"><span class='fa fa-plus'></span>&nbspCreate Collections</button></a>
               
                                     </div>
                                          <div class="table-responsive"> 
                                           <table id="stallList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Created At</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                      <td><?php echo e(++ $key); ?></td>
                                                      <td><?php echo e(date('M d,Y',strtotime($collection->firstDate))); ?> (<i><?php echo e(date('l',strtotime($collection->firstDate))); ?></i>) to <?php echo e(date('M d,Y',strtotime($collection->lastDate))); ?> (<i><?php echo e(date('l',strtotime($collection->lastDate))); ?></i>)</td>
                                                      <td><?php echo e($collection->created_at); ?></td>
                                                      <td><a href="/ViewCollectionDetails/<?php echo e($firstID); ?>/end/<?php echo e($lastID); ?>"><button class="btn btn-success">View Details</button></a></td>
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