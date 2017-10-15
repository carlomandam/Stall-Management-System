<?php $__env->startSection('title'); ?>
    <?php echo e('Stall Rate Archive'); ?>

<style type="text/css">
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
            <li class="active">Stall Rate</li>
        </ol>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>



<div class = "box box-primary">
        <div class = "box-body">

            <div class="table-responsive">
              <div  class = "defaultNewButton">
               <a href="<?php echo e(url('/StallRate')); ?>" class="btn btn-primary btn-flat" ><span class='fa fa-arrow-left'></span>&nbspBack</a>
              </div>
          
                <table id="prodtbl" class="table table-bordered table-striped" role="grid" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Stall Type</th>
                            <th>Collection</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tr>
                        <td>Chuchu</td>
                        <td>ekek</td>
                        <td></td>
                        <td>  <button class="btn btn-primary btn-flat"><span class='fa fa-mail-reply'></span>&nbspReactivate </button></td>

                </table>
            </div>
       </div>
    
    
 </div>
<?php $__env->stopSection(); ?>

  <?php $__env->startSection('script'); ?>
  <script type="text/javascript">
   
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>