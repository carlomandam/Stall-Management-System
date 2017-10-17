 <?php $__env->startSection('title'); ?> <?php echo e('Registration'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<style>
    .tabcontent {
        display: none
    }
    
    .active {
        display: block;
        transition: 1s;
    }
    
    label {
        margin-top: 10px;
    }
    
    p {
        margin-left: 14px;
    }
</style>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Transactions </li>
    <li><a href="<?php echo e(url('/StallHolderList')); ?>">Manage Contracts</a></li>
    <li>Registration</li>
</ol>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/square/blue.css')); ?>"> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="row">
    <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="/StallHolderList" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbsp; Back to StallHolder List</a></div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border" style="text-align: center;">
                <h3 class="box-title"><b><?php echo e($stall->stallID); ?> Current Submeter Reading</b></h3> </div>
            <div class="box-body">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Utility</th>
                                <th>Current Reading</th>
                                <th>Reading Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="reading" method="post" action="/UpdateReading">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($contract->contractID); ?>">
                            <?php if(count($stall->StallUtility->where('utilityType','1')) != 0): ?>
                            <tr>
                                <td>Electricity</td>
                                <td>
                                    <input type="hidden" name="elecID" value="<?php echo e((count($stall->StallUtility->where('utilityType','1')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->subMeterID : ''); ?>">
                                    <input type="hidden" name="elecUtil" value="<?php echo e($stall->StallUtility->where('utilityType','1')->first()->stallUtilityID); ?>">
                                    <input type="text" name="electricity" class="form-control money" id="sec_amount" disabled value="<?php echo e((count($stall->StallUtility->where('utilityType','1')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->presRead : ''); ?>"> </td>
                                <td>
                                    <input type="text" name="secDate" class="form-control datepicker" id="sec_date" disabled value="<?php echo e((count($stall->StallUtility->where('utilityType','1')->first()->Submeter) > 0) ? date('F d, Y',strtotime($stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->updated_at)) : ''); ?>" style="text-align: center"> </td>
                            </tr>
                            <?php endif; ?>
                            <?php if(count($stall->StallUtility->where('utilityType','2')) != 0): ?>
                            <tr>
                                <td>Water</td>
                                <td>
                                    <input type="hidden" name="waterID" value="<?php echo e((count($stall->StallUtility->where('utilityType','2')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','2')->first()->Submeter()->latest()->first()->subMeterID : ''); ?>">
                                    <input type="hidden" name="waterUtil" value="<?php echo e($stall->StallUtility->where('utilityType','2')->first()->stallUtilityID); ?>">
                                    <input type="text" name="water" class="form-control money" id="main_amount" value="<?php echo e((count($stall->StallUtility->where('utilityType','2')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','2')->first()->Submeter()->latest()->first()->presRead : ''); ?>" disabled> </td>
                                <td>
                                    <input type="text" name="mainDate" class="form-control datepicker" id="main_date"  value="<?php echo e((count($stall->StallUtility->where('utilityType','2')->first()->Submeter) > 0) ? date('F d, Y',strtotime($stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->updated_at)) : ''); ?>" style="text-align: center" disabled> </td>
                            </tr>
                            <?php endif; ?>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <div class = "col-md-6"></div>
                <div class = "col-md-4" style="text-align: right;">
                    <button class = "btn btn-flat btn-info" id="edit">Edit</button>
                    <button id="save" onclick="$('#reading').submit()" class = "btn btn-flat btn-primary" data-id='util_initial_fee' disabled>Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/multipleAddinArea.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/icheck.js')); ?>">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#edit').on('click', function(){
            $('#sec_amount').prop("disabled",false);
            $('#main_amount').prop("disabled",false);
            $('#save').prop("disabled",false);
        });

        $(".money").inputmask("9999999", { numericInput: true, placeholder: "0",clearMaskOnLostFocus: false});
    });
</script>
<script src="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/phone-ru.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/phone-be.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/phone.js')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>