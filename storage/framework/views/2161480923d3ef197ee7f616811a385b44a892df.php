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
                    <h3 class="box-title"><b>Contract Details</b></h3> </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><span style="font-size:21px;font-weight: light">Stall Holder:</span> <?php echo e($contract->StallHolder->stallHFName.' '.$contract->StallHolder->stallHMName[0].'. '.$contract->StallHolder->stallHLName); ?> <a href="/getTennant/<?php echo e($contract->StallHolder->stallHID); ?>" style="font-size: 12px">View Details</a></h3> </div>
                        <div class="col-md-12">
                            <label for="bussiname" style="font-size:18px;font-weight: normal">Business Name: <span style="font-size:20px;font-weight: normal"><?php echo e($contract->businessName); ?></span> <a href="#" style="font-size: 12px"><span class='glyphicon glyphicon-pencil'></span>Rename</a></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Stall Code</label>
                            <p><?php echo e($stall->stallID); ?></p>
                        </div>
                        <div class="col-sm-3">
                            <label>Stall Type</label>
                            <p><?php echo e($stall->StallType->StallType->stypeName); ?> (<?php echo e($stall->StallType->StallTypeSize->stypeArea); ?> m&sup2)</p>
                        </div>
                        <div class="col-sm-3">
                            <label>Stall Rate</label>
                            <p><?php echo e('₱'.number_format($stall->StallType->StallRate->dblRate,2,'.',',')); ?></p>
                        </div>
                        <div class="col-sm-3">
                            <label>Peak Days Additional Rate</label>
                            <p><?php echo e(($stall->StallType->StallRate->peakRateType == 1) ? '₱'.$stall->StallType->StallRate->dblPeakRate : $stall->StallType->StallRate->dblPeakAdditional.'% (₱'.number_format(($stall->StallType->StallRate->dblRate * ($stall->StallType->StallRate->dblPeakAdditional / 100)),2,'.',',').')'); ?> </p>
                        </div>
                        <div class="col-md-6">
                            <label>Location</label>
                            <p><?php echo e((($stall->Floor->floorLevel == '1') ? $stall->Floor->floorLevel.'st' : (($stall->Floor->floorLevel == '2') ? $stall->Floor->floorLevel.'nd' : (($stall->Floor->floorLevel == '3') ? $stall->Floor->floorLevel.'rd' : $stall->Floor->floorLevel.'th'))).' Floor'); ?>, <?php echo e($stall->Floor->Building->bldgName); ?> Building</p>
                        </div>
                        <div class="col-md-3" id="changeClass">
                            <label for="startdate">Start Date </label>
                            <p><?php echo e($contract->contractStart); ?></p>
                        </div>
                        <div class="col-md-3">
                            <label for="startdate">End Date </label>
                            <p><?php echo e($contract->contractEnd); ?></p>
                        </div>
                        <div class="col-md-12">
                            <label for="address"><b>List of Products</b></label>
                            <ul>
                                <?php
                                    foreach($prod as $x){
                                        echo "<li>".$x['productName']."</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger btn-flat">Terminate</button>
                                <button type="button" class="btn btn-primary btn-flat tablinks" onclick="openTab('#1', '#2');">Ammend</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabcontent" id="2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Ammend Contract</b></h3> </div>
                <div class="box-body">
                    <div class="row" style="margin-top:20px;margin-left: 15px;">
                        <form id="ammend">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($contract->contractID); ?>">
                            <div class="col-md-6">
                                <label>End Date</label>
                                <br>
                                <div class="input-group date datepicker" style="width:300px">
                                    <input type="text" class="form-control" name="endDate">
                                    <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Stall Rate</label>
                                <br>
                                <select name="rate"> <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($rate->stallRateID); ?>"><?php echo e(date_format(date_create($rate->stallRateEffectivity),"F d, Y").' - '.'₱'.number_format($rate->dblRate,2,'.',',')); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success btn-flat tablinks" onclick="$('#ammend').submit();">Save</button>
                        <button type="button" class="btn btn-danger btn-flat tablinks" onclick="openTab('#2', '#1');">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div><?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
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

        function openTab(from, to) {
            $(from).fadeOut(function () {
                $(this).removeClass('active')
                $(to).fadeIn(function () {
                    $(this).addClass('active');
                })
            });
        }
    </script>
    <script src="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/phone-ru.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/phone-be.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/phone.js')); ?>"></script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>