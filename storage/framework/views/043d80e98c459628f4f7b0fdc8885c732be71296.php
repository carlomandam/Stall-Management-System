 <?php $__env->startSection('title'); ?> <?php echo e('Requirements'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Requirements</li>
    <li class="active">Archive</li>
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
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <a href="/requirements">
                    <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>Back </button>
                </a>
            </div>
            <table id="reqList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Desc</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody> <?php $__currentLoopData = $req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($r->reqName); ?></td>
                        <td><?php echo e($r->reqDesc); ?></td>
                        <td>
                            <div class='btn-group'>
                                <button type='button' class='btn btn-primary btn-flat dropdown-toggle' data-toggle='dropdown'><span class='fa fa-check'></span> Reactivate</button>
                                </button>
                                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                    <center>
                                        <h4>Are You Sure?</h4>
                                        <li class='divider'></li>
                                        <li><a href='#' data-id="<?php echo e($r->reqID); ?>" id="act">YES</a></li>
                                        <li><a href='#'>NO</a></li>
                                    </center>
                                </ul>
                            </div>
                        </td>
                    </tr> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </tbody>
            </table>
        </div>
    </div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/floor_js.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/requirements.js')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>