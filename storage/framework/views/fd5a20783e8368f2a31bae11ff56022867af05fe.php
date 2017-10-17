 <?php $__env->startSection('title'); ?> <?php echo e('Payment'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/panel-tab.css')); ?>">
<style type="text/css">
    .col-md-12,
    .row {
        margin-top: 10px;
    }
    
    table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
        cursor: pointer;
    }
    
    #table2,
    #backButton {
        display: none;
    }
    
    .label {
        font-size: 14px;
    }
</style> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="defaultNewButton">
            <a href="<?php echo e(url('/Payment')); ?>">
                <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</button>
            </a>
        </div>
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Payments</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Advance Collection</a></li>
                    <li><a href="#tab3" data-toggle="tab">Payment History</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="row">
                            <form id="paymentForm" method="post" action="/NewPaymentTransaction"> <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="contract" value="<?php echo e($contract->contractID); ?>">
                                <div class="col-md-5">
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <div class="row">
                                                <label class="col-md-3">
                                                    <label>Payment No.</label>
                                                </label>
                                                <div class="col-md-9">
                                                    <lable class="form-control"><?php echo e($payID); ?></lable>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3">Stall Code</label>
                                                <div class="col-md-9">
                                                    <label class="form-control"><?php echo e($contract->stallID); ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3">Tenant Name</label>
                                                <div class="col-md-9">
                                                    <label class="form-control"><?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHFName)); ?> <?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHMName)); ?> <?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHLName)); ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3">Balance</label>
                                                <div class="col-md-9">
                                                    <label class="form-control">Php <?php if(isset($totalUnpaid)): ?><?php echo e(number_format($totalUnpaid,2)); ?><?php endif; ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3">Collection Status</label>
                                                <div class="col-md-9"> <?php if(isset($status)): ?> <?php if($status == 'COLLECT'): ?> <span class="label bg-primary"><?php echo e($status); ?></span> <?php elseif($status == 'REMINDER'): ?> <span class="label bg-green form-control"><label><?php echo e($status); ?></label></span> <?php elseif($status == 'WARNING'): ?> <span class="label yellow form-control"><label><?php echo e($status); ?></label></span> <?php elseif($status == 'LOCK'): ?> <span class="label bg-orange"><label><?php echo e($status); ?></label></span> <?php elseif($status == 'TERMINATE'): ?> <span class="label bg-red"><label><?php echo e($status); ?></label></span> <?php endif; ?> <?php endif; ?> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="box box-primary">
                                        <div class="box box-body">
                                            <div id="newEC" class="alert alert-danger print-error-msg" style="display:none">
                                                <ul></ul>
                                            </div>
                                            <div class="row"> <?php if(count($bills) > 0 || count($unpaidCollections) > 0 || count($contract->UnpaidInitial) > 0): ?>
                                                <div class="col-md-12">
                                                    <div class="pull-right" style="margin-right:5%">
                                                        <label>Amount</label>
                                                    </div>
                                                </div> <?php endif; ?>
                                                <?php $total = 0;?> <?php if(count($contract->UnpaidInitial) > 0): ?>
                                                    <div class="col-md-12">
                                                        <label>Initial Fee</label>
                                                        <ul id="initList" style="list-style:none"> <?php $__currentLoopData = $contract->UnpaidInitial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <div class="cblable" style="width:50% !important;display:inline !important">
                                                                    <label style="font-weight: normal">
                                                                        <input name="initCB[]" style="width: 15px;height: 15px;display:none" type="checkbox" value="<?php echo e($i->initDetID); ?>" disabled><?php echo e($i->InitialFee->initDesc); ?>

                                                                        <input type="hidden" name="init[]" value="<?php echo e($i->initDetID); ?>"> </label>
                                                                </div>
                                                                <div class="pull-right" style="margin-right:5%">₱ <?php echo e(number_format($i->InitialFee->initAmt,2,'.',',')); ?></div>
                                                            </li>
                                                            <?php $total += $i->InitialFee->initAmt;?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul>
                                                    </div> <?php endif; ?> <?php if(isset($unpaidCollections) && count($unpaidCollections) > 0): ?>
                                                    <div class="col-md-12">
                                                        <label>Unpaid Collection</label>
                                                        <ul style="list-style:none"> <?php $__currentLoopData = $unpaidCollections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <div class="checkbox" style="display:inline !important">
                                                                    <label>
                                                                        <input name="unpaid[]" style="width: 15px;height: 15px" type="checkbox" value="<?php echo e($u['detID']); ?>" checked> <?php echo e($u['date']); ?> - <?php echo e(date("l",strtotime($u['date']))); ?> </label>
                                                                </div>
                                                                <div class="pull-right" style="margin-right:5%;display:inline !important">₱ <?php echo e(number_format($u['amount'],2,'.',',')); ?> </div>
                                                            </li>
                                                            <?php $total += $u['amount']; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul>
                                                    </div> <?php endif; ?> <?php if(isset($bills) && count($bills) > 0): ?>
                                                    <div class="col-md-12">
                                                        <label>Unpaid Bills</label>
                                                        <ul style="list-style:none"> <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <div class="checkbox" style="display:inline !important">
                                                                    <label>
                                                                        <input name="bills[]" style="width: 15px;height: 15px" type="checkbox" value="<?php echo e($u->billDetID); ?>" checked> <?php echo e(date("Ymd000",strtotime($u->created_at)).$u->billDetID); ?> </label>
                                                                </div>
                                                                <ul> <?php $__currentLoopData = $u->Billing_Utilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $util): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li> <?php echo e(($util->MonthlyReading->utilType == 1) ? "Electric Bill" : (($util->MonthlyReading->utilType == 2) ? "Water":"Unknown Utility Type")); ?>

                                                                        <div class="pull-right" style="margin-right:5%;display:inline !important">₱ <?php echo e(number_format($util->utilityAmt,2,'.',',')); ?> </div>
                                                                        <?php $total += $util->utilityAmt;?>
                                                                    </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php $__currentLoopData = $u->Charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li> <?php echo e(($charge->chargeID == null) ? $charge->chargeDesc : $charge->Charges->chargeName); ?>

                                                                        <div class="pull-right" style="margin-right:5%;display:inline !important">₱ <?php echo e(number_format(($charge->chargeID == null) ? $charge->chargeAmt : $charge->Charges->chargeAmount,2,'.',',')); ?> </div>
                                                                        <?php $total += number_format(($charge->chargeID == null) ? $charge->chargeAmt : $charge->Charges->chargeAmount,2,'.',',');?>
                                                                    </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul>
                                                            </li> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </ul>
                                                    </div> <?php endif; ?> <?php if(count($bills) > 0 || count($unpaidCollections) > 0 || count($contract->UnpaidInitial) > 0): ?>
                                                    <div class="col-md-12">
                                                        <hr style="border-color:black"> </div>
                                                    <div class="col-md-12" style="text-align:right">
                                                        <label class="" style="margin-right :0%;display:inline !important">Total Amount:</label>
                                                        <div class="" style="margin-right:5%;width:25%;display:inline-block !important">&nbsp; ₱ <?php echo e(number_format($total,2,'.',',')); ?></div>
                                                    </div>
                                                    <div class="col-md-12" style="text-align:right">
                                                        <div class="form-group form-inline" style="display:inline">
                                                            <label class="" style="margin-right :0%;display:inline">Amount Received:</label>
                                                            <div class="input-group" style="width:25%;"> <span class="input-group-addon">₱</span>
                                                                <input class="form-control money" type="text" name="amtReceived" id="amtReceived" style="text-align: right" /> </div>
                                                        </div>
                                                    </div>
                                            <?php else: ?>
                                            <div class="col-md-12">
                                                <center>
                                                    <label>Nothing to pay</label>
                                                </center>
                                            </div> <?php endif; ?></div>  
                                        </div>
                                    </div>
                                </div> <?php if(count($bills) > 0 || count($unpaidCollections) > 0 || count($contract->UnpaidInitial) > 0): ?>
                                <div class="pull-right">
                                    <div class="defaultBtnSet col-md-12">
                                        <button type="button" class="btn btn-danger btn-flat" id="voidbtn"> Void Items</button>
                                        <button type="submit" class="btn btn-primary btn-flat" id="paymentbtn"> <i class="fa fa-save"></i> Save</button>
                                    </div>
                                    <div class="voidBtnSet col-md-12" style="display:none">
                                        <button type="button" class="btn btn-danger btn-flat" id="cancelVoid">Cancel</button>
                                        <button class="btn btn-primary btn-flat" id="save"> <i class="fa fa-save"></i> Save</button>
                                    </div>
                                </div> <?php endif; ?>
                                <!-- box box-primary -->
                            </form>
                        </div>
                    </div>
                    <!-- tab1primary -->
                    <div class="tab-pane fade" id="tab2primary">
                        <form>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Payment Number:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-control"><?php echo e($payID); ?></label>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top: 10px;">
                                        <label class="form-control">Tenant Name:</label>
                                        <label class="form-control"><?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHFName)); ?> <?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHMName)); ?> <?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHLName)); ?></label>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                            <label>Stall Code:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-control"><?php echo e($contract->stallID); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Business Name:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-control"> <?php echo e(\Illuminate\Support\Str::upper($contract->businessName)); ?></label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                            <label>Date From:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label id="dateFrom" name="dateFrom" class="form-control"> <?php if(isset($dateFrom)): ?> <?php echo e($dateFrom); ?></label> <?php endif; ?> </div>
                                        <div class="col-md-2">
                                            <label>Date To:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="datepicker form-control" id='dateTo' name='dateTo' readonly="true" style="cursor:pointer; background-color: #FFFFFF;" /> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box  box-primary" style="margin-top:30px;">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="tbladpay" class="table table-bordered table-striped display select" role="grid">
                                            <thead>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" style="text-align: right; ">Total Amount:</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-3"></div>
                                        <label class="col-md-3">Amount to be Paid:</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" id="sum" disabled="" /> </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-3"></div>
                                        <label class="col-md-3">Amount Received:</label>
                                        <div class="col-md-3">
                                            <div class="input-group"> <span class="input-group-addon">₱</span>
                                                <input class="form-control money" type="text" id="amtPaid" name="amtPaid" style="text-align: right" /> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="col-md-12">
                                    <a class="btn btn-primary btn-flat" id="adsave" style="width:100px; margin: 20px;"> <i class="fa fa-save"></i> Save</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <div class="box box-primary">
                            <div class="box box-body">
                                <div class="row">
                                    <label class="col-md-3">Stall Code</label>
                                    <div class="col-md-3">
                                        <label class="form-control"><?php echo e($contract->stallID); ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3">Tenant Name</label>
                                    <div class="col-md-3">
                                        <label class="form-control"><?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHFName)); ?> <?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHMName)); ?> <?php echo e(\Illuminate\Support\Str::upper($contract->StallHolder->stallHLName)); ?></label>
                                    </div>
                                    <label class="col-md-3">Collection Status</label>
                                    <div class="col-md-3"> <?php if(isset($status)): ?> <?php if($status == 'COLLECT'): ?> <span class="label bg-primary"><?php echo e($status); ?></span> <?php elseif($status == 'REMINDER'): ?> <span class="label bg-green form-control"><label><?php echo e($status); ?></label></span> <?php elseif($status == 'WARNING'): ?> <span class="label yellow form-control"><label><?php echo e($status); ?></label></span> <?php elseif($status == 'LOCK'): ?> <span class="label bg-orange"><label><?php echo e($status); ?></label></span> <?php elseif($status == 'TERMINATE'): ?> <span class="label bg-red"><label><?php echo e($status); ?></label></span> <?php endif; ?> <?php endif; ?> </div>
                                </div>
                            </div>
                        </div>
                        <div class="box  box-primary" style="margin-top:30px;">
                            <div class="box-body">
                                <div class="table-responsive" id="tableHistory">
                                    <table id="tblhistory" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0" role="grid">
                                        <thead>
                                            <th>Payment Number</th>
                                            <th>Date Paid</th>
                                            <th>Amount Paid</th>
                                            <th>Action/s</th>
                                        </thead>
                                    </table>
                                </div>
                                <div class="defaultNewButton" id="backButton">
                                    <button class="btn btn-primary btn-flat" id="backPH"><span class='fa fa-arrow-left'></span>&nbsp;Back to Payment History</button>
                                </div>
                                <div class="table-responsive" id="table2">
                                    <table id="tblviewDetails" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0" role="grid">
                                        <thead>
                                            <th>Description</th>
                                            <th>Amount</th>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th colspan="1" style="text-align: right; ">Total Amount:</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th colspan="1" style="text-align: right; ">Total Amount Paid:</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
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
<!-- col-md-12-->
<!-- row--><?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script type="text/javascript">
    var totalAmt = 0;
    var sum = 0;
    var array = [];
    $(document).on('ready', function () {
        $.validator.addMethod('hasToPay', function () {
            $val = [];
            $("input[name=unpaid\\[\\]]:checked").each(function () {
                $val.push($(this).val());
            });
            if ($val.length == 0 && $("input[name=unpaid\\[\\]]").length != 0) return false;
            else return true;
        });
        $.validator.addMethod('pay', function (valu, elem, param) {
            var amt = parseFloat(elem.value.replace(",", ''));
            alert(amt);
            if (amt < <?php echo e($total); ?>) return false
            else return true;
        });
        $("#paymentForm").validate({
            rules: {
                amtReceived: {
                    "hasToPay": true
                    , "pay": true
                    , number: true
                }
            }
            , messages: {
                amtReceived: {
                    "hasToPay": "Nothing to pay"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('.print-error-msg ul');
            }
            , errorContainer: "#newEC"
        });
        $("#paymentbtn").on("click", function () {
            /* if (('#amtReceived').val().length == 0) {
                 toastr.error("Input amount received");
             }
             else {
                 
             }*/
            $("#paymentForm").submit();
        });
        $("#voidbtn").on("click", function () {
            $('.defaultBtnSet').fadeOut(function () {
                $('#initList li .cblable').addClass('checkbox');
                $('#initList li input[type=checkbox]').css('display', 'inline');
                $('#initList li input[type=checkbox]').prop('disabled', false);
                $('.voidBtnSet').fadeIn();
            });
        });
        $("#cancelVoid").on("click", function () {
            $('.voidBtnSet').fadeOut(function () {
                $('#initList li .cblable').removeClass('checkbox');
                $('#initList li input[type=checkbox]').css('display', 'none');
                $('#initList li input[type=checkbox]').prop('disabled', true);
                $('.defaultBtnSet').fadeIn();
            });
        });
        $(".datepicker").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: '<?php echo e($dateFrom); ?>'
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
        $('#tbladpay').dataTable({});
        $('#tblpay').dataTable({});
        var contractID = "<?php echo e($contract->contractID); ?>";
        $.ajax({
            type: "GET"
            , url: "/ViewPaymentHistory"
            , data: {
                '_token': $('input[name=_token]').val()
                , 'contractID': contractID
            }
        }).done(function (data) {
            if(!$.trim(data)){
                $('#tblhistory').DataTable({});
            }
            else{
            var table = $('#tblhistory').DataTable({
        
                "aaData": data
                , destroy: true
                , "columns": [
                    {
                        "data": "paymentID"
                        }
                        , {
                        "data": "paymentDate"
                        }
                        , {
                        "data": "totalAmt"
                        }

                        , {
                        "data": "actions"
                        }
               ]
            });
        }
        });
        var rows_selected = [];
        $("#dateTo").on('change', function () {
            sum = 0;
            $("#sum").val(sum);
            var dateFrom = $('#dateFrom').text();
            var contractID = "<?php echo e($contract->contractID); ?>";
            var dateTo = $("#dateTo").val();
            var rows_selected = [];
            $.ajax({
                type: "get"
                , url: "/collectionTable"
                , cache: false
                , data: {
                    dateFrom: dateFrom
                    , dateTo: dateTo
                    , contractID: contractID
                }
            }).done(function (data) {
                var table = $('#tbladpay').DataTable({
                    "aaData": data
                    , destroy: true
                    , "columns": [
                        {
                            "data": "date"
                        }
                        , {
                            "data": "desc"
                        }
                        , {
                            "data": "amount"
                        }
               ]
                });
                $('#tbladpay').dataTable({
                    destroy: true
                    , "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        /*
                         * Calculate the total market share for all browsers in this table (ie inc. outside
                         * the pagination)
                         */
                        var iTotalMarket = 0;
                        for (var i = 0; i < aaData.length; i++) {
                            iTotalMarket += parseFloat(aaData[i][2]) * 1;
                        }
                        /* Calculate the market share for browsers on this page */
                        var iPageMarket = 0;
                        for (var i = iStart; i < iEnd; i++) {
                            iPageMarket += parseFloat(aaData[aiDisplay[i]][2]) * 1;
                        }
                        /* Modify the footer row to match what we want */
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[1].innerHTML = "Php " + " " + parseFloat(iPageMarket).toFixed(2) + " (Php " + parseFloat(iTotalMarket).toFixed(2) + " total)";
                        $('#sum').val("Php " + " " + parseFloat(iTotalMarket).toFixed(2));
                        totalAmt = parseFloat(iTotalMarket).toFixed(2);
                    }
                });
            });
        });
    });
    $(document).on('click', '#adsave', function (e) {
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var dateFrom = $('#dateFrom').text();
        var contractID = "<?php echo e($contract->contractID); ?>";
        var dateTo = $("#dateTo").val();
        var amtPaid = $('#amtPaid').val();
        var temp3 = $('#amtPaid').val().replace("Php ", "", );
        var temp4 = temp3.replace(",", "", );
        var temp5 = Number(temp4);
        if (totalAmt > temp5) {
            toastr.error('Input sufficient Amount');
        }
        else if (dateTo.length == 0) {
            toastr.error("Choose Date");
        }
        else {
            $.ajax({
                type: "POST"
                , url: "/Collection"
                , data: {
                    '_token': $('input[name=_token]').val()
                    , 'contractID': contractID
                    , 'dateFrom': dateFrom
                    , 'dateTo': dateTo
                    , 'money': totalAmt
                }
                , success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        toastr.success(data.success);
                        window.location = '/ViewPayment/' + "<?php echo e($contract->contractID); ?>";
                    }
                    else {
                        printErrorMsg(data.error);
                    }
                }
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function (key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        }
    });

    function getDetails($id) {
        $('#table2').fadeIn();
        $('#backButton').fadeIn();
        $('#tableHistory').hide();
        $.ajax({
            type: "GET"
            , url: "/ViewPaymentDetails"
            , data: {
                '_token': $('input[name=_token]').val()
                , 'paymentID': $id
            }
        }).done(function (data) {
            var table = $('#tblviewDetails').DataTable({
                "aaData": data
                , destroy: true
                , "columns": [
                    {
                        "data": "description"
                        }
                        , {
                        "data": "amount"
                        }
               ]
            });
            $('#tblviewDetails').dataTable({
                destroy: true
                , "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                    /*
                     * Calculate the total market share for all browsers in this table (ie inc. outside
                     * the pagination)
                     */
                    var iTotalMarket = 0;
                    for (var i = 0; i < aaData.length; i++) {
                        iTotalMarket += parseFloat(aaData[i][1].replace(/,/g, '')) * 1;
                    }
                    /* Calculate the market share for browsers on this page */
                    var iPageMarket = 0;
                    for (var i = iStart; i < iEnd; i++) {
                        iPageMarket += parseFloat(aaData[aiDisplay[i]][1].replace(/,/g, '')) * 1;
                    }
                    /* Modify the footer row to match what we want */
                    var nCells = nRow.getElementsByTagName('th');
                    nCells[1].innerHTML = "Php " + " " + parseFloat(iPageMarket).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
            });
        });
        return false;
    }
    $('#backPH').on('click', function () {
        location.reload();
    });
    $(".money").inputmask('currency', {
        rightAlign: true
        , prefix: ''
    , });

    
</script>
 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>