<?php $__env->startSection('title'); ?>
    <?php echo e('Building Archive'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
            <li class="active">Building</li>
        </ol>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>


   
<div class = "box box-primary">
        <div class = "box-body">

            <div class="table-responsive">
              <div  class = "defaultNewButton">
               <a href="<?php echo e(url('/Building')); ?>" class="btn btn-primary btn-flat" ><span class='fa fa-arrow-left'></span>&nbspBack</a>
              </div>
          
                <table id="prodtbl" class="table table-bordered table-striped" role="grid" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th style="width: 100px;">No. of Floors</th>
                            <th>Description</th>
                            <th style="width: 280px;">Actions</th>
                        </tr>
                    </thead>
                        <tr>
                        <td>Building 3</td>
                        <td>BLDG3</td>
                        <td>4</td>
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