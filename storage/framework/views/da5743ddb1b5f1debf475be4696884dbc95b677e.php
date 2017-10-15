 <?php $__env->startSection('title'); ?> <?php echo e('Dashboard'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List of Stalls</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Stall Code</th>
                    <th>Stall Type</th>
                    <th>Location</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-right">Register StallHolder</a>
            </div>
            <!-- /.box-footer -->
          </div>



 <?php $__env->stopSection(); ?>
  <?php $__env->startSection('script'); ?>

 <?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>