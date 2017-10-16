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
        <div class="tabcontent active" id="1">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b><?php echo e($contract->Stall->stallID); ?> Current Submeter Reading</b></h3> </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Utilities <a href="/initialReading/<?php echo e($contract->contractID); ?>" style="font-size: 12px">Change Current Reading</a></label>
                            <p><?php for($i=0;$i < count($contract->stall->StallUtility);$i++): ?>
                                <?php echo e(($contract->stall->StallUtility[$i]->utilityType == 1) ? "Electricity":(($contract->stall->StallUtility[$i]->utilityType == 2) ? "Water" : "Unkown Utility")); ?><?php if($i < count($contract->stall->StallUtility)-1): ?>, <?php endif; ?>
                                <?php endfor; ?>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger btn-flat">Terminate</button>
                                <button type="button" class="btn btn-primary btn-flat tablinks" onclick="openTab('#1', '#2');">Extend</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/multipleAddinArea.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(URL::asset('js/icheck.js')); ?>">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".datepicker").datepicker({
                showOtherMonths: true
                , selectOtherMonths: true
                , changeMonth: true
                , changeYear: true
                , autoclose: true
                , startDate: "dateToday"
                , todayHighlight: true
                , orientation: 'bottom'
                , format: 'mm/dd/yyyy'
            });
            
            $('#ammend').submit(function(e){
                e.preventDefault();
                var formdata = new FormData($(this)[0]);
                $.ajax({
                    type: "POST"
                    , url: '/ammendContract'
                    , data: formdata
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        if (data == "same") {
                            toastr.warning('Nothing Change');
                        }
                        else {
                            toastr.success('Contract Ammended');
                            setTimeout(function () {
                                window.location = "/ViewContract/" + data;
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>
    <script src="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/phone-ru.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/phone-be.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/phone.js')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>