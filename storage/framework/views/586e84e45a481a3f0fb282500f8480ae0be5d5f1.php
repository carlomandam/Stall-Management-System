 <?php $__env->startSection('title'); ?> <?php echo e('Registration'); ?> <?php $__env->stopSection(); ?> <?php $__env->startSection('content-header'); ?>
<style>
    .col-md-12 column {
        text-align: center;
    }
    
    .col-md-12 column form {
        display: inline-block;
    }
    
    #tenant_no {
        margin-bottom: 30px;
    }
    
    legend {
        margin-left: 10px;
        color: #3c8dbc;
    }
    
    textarea {
        resize: vertical;
        overflow: hidden;
    }
    
    #last_fieldset,
    #final_fieldset {
        display: none;
    }
    
    #btn-last {
        margin-bottom: 30px;
    }
    
    .disabled:hover {
        cursor: not-allowed;
    }
    
    .required {
        color: red;
    }
    
    label {
        margin-top: 10px;
    }
</style>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Transactions </li>
    <li>Manage Contracts</li>
    <li><a href="/StallList">Tennants</a></li>
    <li class="active">Tennant View</li>
</ol>
<script type="text/javascript" src="<?php echo e(URL::asset('js/zepto.js')); ?>">
</script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/icheck.js')); ?>">
</script> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="row">
    <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="<?php echo e(URL::previous()); ?>" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</a> </div>
    <div class="col-md-12">
        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Tennant's Details</h3>
            </div>
            <form id="applyForm" method="post">
                <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" id="tennant" name="tennant" value="<?php echo $tennant->stallHID ?>">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="firstName"><b>StallHolder First Name</b></label><span class="required">&nbsp*</span>
                                        <input type="text" class="form-control" name="fname" value="<?php echo e($tennant->stallHFName); ?>" placeholder="" required> </div>
                                    <div class="col-md-6">
                                        <label for="firstName"><b>StallHolder Middle Name</b></label><span class="required">&nbsp*</span>
                                        <input type="text" class="form-control" name="mname" value="<?php echo e($tennant->stallHMName); ?>" placeholder=""> </div>
                                    <div class="col-md-6">
                                        <label for="firstName"><b>StallHolder Last Name</b></label><span class="required">&nbsp*</span>
                                        <input type="text" class="form-control" name="lname" value="<?php echo e($tennant->stallHLName); ?>" placeholder="" required> </div>
                                    <div class="col-md-6">
                                        <label for="address"><b>Home Address</b></label><span class="required">&nbsp*</span>
                                        <textarea class="form-control" name="address"><?php echo e($tennant->stallHAddress); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Date of Birth</label>
                                        <div class="input-group date datepicker">
                                            <input type="text" class="form-control" id="DOB" name="DOB" style="cursor:pointer;background-color:#FFFFFF" readonly>
                                            <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="age">Age</label>
                                        <input type="text" class="form-control" id="age" name="age" placeholder="" readonly/> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="sex"><b>Sex</b></label><span class="required">&nbsp*</span>
                                        <input type="radio" name="sex" id="sex" value="1" checked="checked"><b>Male</b>
                                        <input type="radio" name="sex" id="sex" value="0"><b>Female</b> </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label for="email">Email Address</label><span class="required">&nbsp*</span>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo e($tennant->stallHEmail); ?>" placeholder="email@domain.com" /> </div>
                                    <div class="col-md-6">
                                        <label for="phone"><b>Contact Number/s:</b></label><span class="required">&nbsp*</span>
                                        <div class="form-group input-group removable">
                                            <input type="text" name="numbers[]" class="form-control" placeholder="" required> <span class="input-group-btn"><button type="button" class="btn btn-primary btn-add">+</button></span> </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="registerButtons">
                                    <div class="pull-right">
                                        <button type="button" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger">Remove</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Rejection</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to delete records of <b><?php echo e($tennant->stallHFName.' '.$tennant->stallHLName); ?></b>, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" onclick='deleteTennant("<?php echo e($tennant->stallHID); ?>");' data-dismiss="modal">Proceed</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/multipleAddinArea.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        
        $("#DOB").on("change", function(){
            var birthDate = new Date($(this).val());
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() + 1 - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $('#age').val(age);
        });
        $("#DOB").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "01/01/1900"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'MM dd, yyyy'
        });
        $("#DOB").datepicker("setDate","<?php echo e(date("F d, Y",strtotime($tennant->stallHBday))); ?>");

        $("#applyForm").submit(function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/updateTennant'
                , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if(data.trim() == 'true')
                    toastr.success('Successfully Updated!');
                }
            });
        });
        $('form input[name=sex][value=' + <?php echo e($tennant -> stallHSex); ?> + ']').click();
        var contacts = JSON.parse("<?php echo e(json_encode($tennant->ContactNo)); ?>".replace(/&quot;/g, '"'));
        for (var i = $('input[name="numbers[]"]').length; i < contacts.length; i++) {
            $('input[name="numbers[]"').last().next().find('button').click();
        }
        var j = 0;
        $('input[name="numbers[]"]').each(function () {
            $(this).val(contacts[j].contactNumber);
            j++;
        });
        
        $('textarea').each(function () {
            textAreaAdjust(this);
        });
        
        $.validator.addMethod("custom_email", function(value, element) {
          var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(value);
        }, 'Input valid email address');

         $.validator.addMethod("custom_mobno", function(value, element) {
          var pattern = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
         return pattern.test(value);
         }, 'Input valid mobile number');        
    });

    function textAreaAdjust(o) {
        o.style.height = '1px';
        o.style.height = (25 + o.scrollHeight) + "px";
    }
    
    function deleteTennant(id){
        $.ajax({
            type: "POST"
            , url: '/deleteTennant'
            , data: {
                "_token" : "<?php echo csrf_token();?>"
                , "id" : id
            }
            , context: this
            , success: function (data) {
                toastr.success('Tennant Deactivated!');
                window.location = "/StallHolderList";
            }
        });
    }
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>