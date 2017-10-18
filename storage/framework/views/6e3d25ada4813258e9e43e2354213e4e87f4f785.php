 <?php $__env->startSection('title'); ?> <?php echo e('Payment and Collection'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
    <li class="active">Utilites</li>
</ol> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div>
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="box box-solid box-default">
        <div class="box-body">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border"> </div>
                    <div>
                        <div class="box-body">
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2">
                                    <label>Utility Type</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="utilityType" name="utilityType">
                                        <option selected disabled>------</option>
                                        <option value="1">Electricty</option>
                                        <option value="2">Water</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2">
                                    <label>Date From:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="dateFrom" id="date_from" readonly disabled> </div>
                                <div class="col-md-1">
                                    <label>Date To:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="dateTo" id="date_to" readonly disabled> </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-8" style="text-align: center; font-size: 20px;">
                                    <label>Total Bill</label>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2">
                                    <label>Previous Reading</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control reading" name="prevRead" id="prev_read" disabled> </div>
                                <div class="col-md-2">
                                    <label>Present Reading</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control reading" name="presRead" id="pres_read" disabled> </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-2">
                                    <label>Total Bill Amount:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control money" name="totalBill" id="total_bill" disabled> </div>
                                <div class="col-md-2">
                                    <label>Rate:</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control money" name="multiplierAmt" id="multiplier_amt" disabled> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8" style="margin-top: 20px;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Stall Code</th>
                                                <th>Previous Reading</th>
                                                <th>Present Reading</th>
                                                <th>Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody class="stallList"> </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" id="save" name="save">Save</button>
                                    <a href="<?php echo e(url('/Utilities')); ?>">
                                        <button class="btn btn-danger">Cancel</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/utility.js')); ?>"></script>
<script type="text/javascript">
    $(".reading").inputmask("9999999", {
        numericInput: true
        , placeholder: "0"
        , clearMaskOnLostFocus: false
    });
    $(".money").inputmask('currency', {
        rightAlign: true
        , prefix: 'Php '
    , });
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>