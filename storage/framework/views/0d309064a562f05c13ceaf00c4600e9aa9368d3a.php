 
<?php $__env->startSection('title'); ?> 
<?php echo e('Borrow'); ?> 
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Equipments</li>
</ol> 
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<style>
    #floortbl td {
        padding-bottom: 5px;
    }

    #floortbl th,
    #floortbl td {
        text-align: center;
    }
</style>
<div class="panel panel-primary">
<div class="panel-heading">
    <h4>Borrowed Equipment</h4>
</div>
    <div class="panel-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class='fa fa-plus'></span>&nbspBorrow Equipment</button>
                
                
            <table id="borrowList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Stall Code</th>
                        <th>Equipment</th>
                        <th>Quantity</th>
                        <th>Date Borrowed</th>
                        <th>Date Returned</th>
                        <th>Amount</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
               
                  <!--   <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class='btn btn-primary btn-flat' id="updateModal" data-id=''><span class='glyphicon glyphicon-pencil'></span> Update</button>

                            <div class='btn-group'>
                                <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                    <center>
                                        <h4>Are You Sure?</h4>
                                        <li class='divider'></li>
                                        <li><a href='#'>YES</a></li>
                                        <li><a href='#'>NO</a></li>
                                    </center>
                                </ul>
                            </div>
                        </td>
                    </tr> -->
                
                </tbody>
            </table>
        </div>
    </div>
<div class="modal fade" id="new" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form  action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Borrow Equipment</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Equipment</th>
                                    <th>Quantity Limit</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><input type="text" name="" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                                <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-flat" id="newSave"><span class='fa fa-save'></span>&nbspSave</button>
                                </div>
                            </div>
                    
                </div>

        </form>
    </div>
</div>


<div class="modal fade" id="update" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <form class="building" action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Equipment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" name="uEquipment" id="uName" 
                                     placeholder="Equipment Name" required /> 
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="bldgName">Daily Rate</label><span class="required">&nbsp*</span>
                                        <input type="text" name="uRate" class="form-control" onkeypress='validate(event)' id="uRate" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                     <label for="bldgName">Equpment Limit Per Stall</label><span class="required">&nbsp*</span>
                                     <input type="text" name="uLimit" class="form-control" onkeypress='validate(event)' id="uLimit">
                                 </div>
                                </div>
                                
                            </div>

                            <div class="col-md-12">
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                                <!-- <label style="float:left">All labels with "*" are required</label> -->
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-flat" id="uSave"><span class='fa fa-save'></span>&nbspSave</button>
                                </div>
                            </div>
                    
                </div>

        </form>
    </div>
</div>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/floor_js.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/borrow.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>