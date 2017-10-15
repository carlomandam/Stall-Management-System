<?php $__env->startSection('title'); ?>
<?php echo e('Stall Status Report'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Reports</li>
  <li class="active">Stall Status Report</li>
</ol>

<style>
    .yellow{
      background-color: #f7e64c;
      color:black;
    }
    .label{
      font-size:14px;
    }
    th,td{
      text-align: center;
    }
    
</style>
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
                                          <div class="table-responsive"> 
                                           <table id="tblStatus" class="table table-bordered table-striped table-responsive" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>Collection Status</th>
                                                    <th>No. of Stall/s</th>
                                                    <th>Total Amount</th>
                                                  </tr>
                                                </thead>  
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
 $('#stallList').dataTable({
    responsive:true,
    autoWidth:false,
    destroy:true
 });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>