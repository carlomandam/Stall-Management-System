<?php $__env->startSection('title'); ?>
<?php echo e('Payments'); ?>

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
         <h4 class="box-title">Payments</h4>
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
                          <button type="" class="btn btn-primary" onclick="window.location='<?php echo e(url('/ViewPayment')); ?>'">Proceed
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

<div class="modal fade" id="new" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form class="building" action="" method="post" id="newform">
                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Add Charge/s StallHolders</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Charge Type</label><span class="required">&nbsp*</span>
                                    <select class="form-control"></select> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgCode">Charge Amount</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control"  /> </div>
                            </div>

                            

                             <div class="col-md-12">
                              <label>Applicable to:<span class="required">&nbsp*</span></label>
                              <select class="form-control">
                                <option>All Active StallHolders</option>
                                <option>All Stalls</option>
                                <option>Selected StallHolders</option>
                              </select> 
                            </div>

                          
                        </div>
                           <p class="small text-danger">All fields are required</p>
                    </div>
                 
                    <div class="modal-footer">
                        <!-- <label style="float:left">All labels with "*" are required</label> -->
                        <div class="pull-right">
                            <button class="btn btn-primary btn-flat"><span class='fa fa-save'></span>&nbspSave</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>