 <?php $__env->startSection('title'); ?> <?php echo e('Requirements'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Requirements</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<style>
    #floortbl td {
        padding-bottom: 5px;
    }
    
    #floortbl th,
    #floortbl td {
        text-align: center;
    }
</style>
<div class="defaultNewButton">
    <button style="padding: 1px 10px 4px 3px; border-radius:50px;" class="btn icon-btn btn-primary" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new"><span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-primary" style="padding:7px; background:#ffffff; margin-right:4px;"></span>&nbspNew Requiements</button>

    <div class=" pull-right" id="archive"> <a <a style="padding: 2px 10px 3px 3px; border-radius:50px;" href="<?php echo e(url('/requirementsArchive')); ?>" class="btn btn-primary btn-flat"><span style="padding:7px; background:#ffffff; margin-right:4px;" class='fa fa-archive img-circle text-primary'></span>&nbspArchive</a> </div>
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <table id="reqList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Desc</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody> <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($req->reqName); ?></td>
                        <td><?php echo e($req->reqDesc); ?></td>
                        <td>
                            <button style="padding: 1px 10px 4px 3px; border-radius:50px;" class='btn btn-primary btn-flat' id="updateModal" data-id="<?php echo e($req->reqID); ?>"><span class="glyphicon btn-glyphicon glyphicon-pencil img-circle text-primary" style="padding:7px; background:#ffffff; margin-right:4px;"></span> Update</button>
                            <div class='btn-group'>
                                <button style="padding: 2px 10px 4px 3px; border-radius:50px;" type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger" style="padding:7px; background:#ffffff; margin-right:4px;"></span> Deactivate</button>
                            </button>
                            <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                <center>
                                    <h4>Are You Sure?</h4>
                                    <li class='divider'></li>
                                    <li><a href='#' data-id="<?php echo e($req->reqID); ?>" id="del">YES</a></li>
                                    <li><a href='#'>NO</a></li>
                                </center>
                            </ul>
                        </div>
                    </td>
                    </tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="new" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form class="building" action="" method="" id="">
                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Requirement</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Requirement Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" name="newReqName" id="newReqName" placeholder="Requirement Name" /> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Description</label>
                                    <input type="textarea" name="newReqDesc" class="form-control"> </div>
                            </div>
                            <div class="col-md-12">
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <label style="float:left">All labels with "*" are required</label> -->
                        <div class="pull-right">
                            <button class="btn btn-primary btn-flat" id="saveReq"><span class='fa fa-save'></span>&nbspSave</button>
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
                        <h4 class="modal-title">Update Requirement</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Requirement Name</label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" name="editReqName" id="uname" placeholder="Requirement Name" /> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bldgName">Description</label>
                                    <input type="textarea" name="editReqDesc" id="udesc" class="form-control"> </div>
                            </div>
                            <div>
                                <input type="text" name="dName" id="hName" hidden>
                                <input type="text" name="dDesc" id="hDesc" hidden>
                                <input type="text" name="dID" id="hID" hidden> </div>
                            <div class="col-md-12">
                                <p class="small text-danger">Fields with asterisks(*) are required</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="pull-right">
                            <button style="padding: 2px 10px 4px 3px; border-radius:50px;" class="btn btn-primary btn-flat" id="saveReq"><span class='glyphicon btn-glyphicon fa fa-save img-circle text-primary' style="padding:7px; background:#ffffff; margin-right:4px;"></span>&nbspSave</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/floor_js.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/requirements.js')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>