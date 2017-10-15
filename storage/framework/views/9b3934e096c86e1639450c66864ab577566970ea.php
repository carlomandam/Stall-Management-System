<?php $__env->startSection('title'); ?>
<?php echo e('Payment'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('assets/bootstrap/css/panel-tab.css')); ?>">
<style type="text/css">
    .col-md-12{
        margin-top: 10px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Bills</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Payments</a></li>
                                   
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                  <div class="table-striped-responsive">
                                      <div class="defaultNewButton">
                                          <a class="btn btn-primary btn-flat" href="<?php echo e(url('/CreateBill')); ?>"><span class='fa fa-plus'></span>&nbspRecord Utilities Bill</a>
                                         
                                      </div>
                                        <table id="tblstall" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Bill Number</th>
                                                <th>Bill Date</th>
                                                <th>StallHolder Name</th>
                                                <th>Billing Period</th>
                                                <th>Billed By</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- box box-primary -->
                    </div>
                    <!-- tab1primary -->
                    <div class="tab-pane fade" id="tab2primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-striped-responsive">
                                       <div class="defaultNewButton">
                                          <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#new_payment" ><span class='fa fa-plus'></span>&nbspAdd Bulk Payments</a>
                                         
                                      </div>
                                        <table id="tblreg" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>StallHolder Name</th>
                                                <th>Stall Code</th>
                                                <th>Collection Status</th>
                                                <th>Current Balance</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <!-- tab2primary -->
                </div>
                <!-- tab content-->
            </div>
            <!-- panel body-->
        </div>
        <!-- panel with-nav-tabs-->
    </div>
    <!-- col-md-12 -->
</div>
<!-- row -->

<div class = "modal fade" id = "new_payment"  role="dialog">
  <div class="modal-dialog modal-md" role="document">
   <form class="billing" action="" method="post" id="bulk_payment">
     <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
     <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Bulk Payments</h4> </div>
                    <div class="modal-body">
              

                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-3">
                                    <label for="billto">Select Stallholder</label>
                                    </div>
                                    <div class = "col-md-9">
                                         <select class="js-example-placeholder-multiple" style="width: 100%;  " id="ven_name" name="ven_name"> </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class = "col-md-3">
                                    <label for="billperiod">Amount Paid</label>
                                    </div>
                                    <div class = "col-md-9">
                                          <input type='text' class='form-control money' name='' >
                                    </div>
                                </div>
                            </div>
                        </div>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src ="<?php echo e(URL::asset('js/jquery.inputmask.bundle.js')); ?>"></script>
<script src ="<?php echo e(URL::asset('js/phone-ru.js')); ?>"></script>
<script src ="<?php echo e(URL::asset('js/phone-be.js')); ?>"></script>
<script src ="<?php echo e(URL::asset('js/phone.js')); ?>"></script>
    <script type="text/javascript">
     $(document).ready(function(){
        $('.js-example-placeholder-multiple').select2({
            width: 'resolve'
        });

    Inputmask().mask(document.querySelectorAll("input"));

    $(".money").inputmask("currency",{radixPoint: '.', 
                                      prefix: "₱ "});

    var timeOutId = 0;
    var ajaxFn = function () {
        $.ajax({
            url: '/CheckBillingRecords',
            success: function (response) {
                if (response == 0) {
                    alert('none');
                } else {
                    timeOutId = setTimeout(ajaxFn, 1000);
                    alert(response);
                   
                }
            }
            });
}

    ajaxFn();

     });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>