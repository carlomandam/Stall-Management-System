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
                                        <label for="bday"><b>Birthday</b></label><span class="required">&nbsp*</span>
                                        <div class="form-inline">
                                            <select class="form-control" name="DOBMonth" id="DOBMonth">
                                                <option disabled="" selected=""> - Month - </option>
                                                <option value="01">January</option>
                                                <option value="02">Febuary</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <select class="form-control" name="DOBDay" id="DOBDay">
                                                <option disabled="" selected=""> - Day - </option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                            <select class="form-control" name="DOBYear" id="DOBYear">
                                                <option disabled="" selected=""> - Year - </option>
                                            </select>
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
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <div class='btn-group dropup'>
                                            <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                            <ul class='dropdown-menu pull-right' role='menu'>
                                                <center>
                                                    <h4>Are You Sure?</h4>
                                                    <li class='divider'></li>
                                                    <li><a href='#' onclick='deleteTennant("<?php echo e($tennant->stallHID); ?>");return false;'>YES</a></li>
                                                    <li><a href='#' onclick='return false'>NO</a></li>
                                                </center>
                                            </ul>
                                        </div>
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
<?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('js/multipleAddinArea.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        
        var select = $('#DOBYear');
        var leastYr = 1900;
        var nowYr = new Date().getFullYear();
        for (var v = nowYr; v >= leastYr; v--) {
            $('#DOBYear').append('<option value ="' + v + '">' + v + '</option');
        }
        
        $('#DOBMonth').change(function () {
            if ($(this).val() == 4 || $(this).val() == 6 || $(this).val() == 9 || $(this).val() == 11) {
                $('#DOBDay option[value =31]').remove();
                if ($("#DOBDay option[value='30']").length == 0) {
                    $('#DOBDay').append('<option value="' + 30 + '">' + 30 + '</option>');
                }
            }
            else if ($(this).val() == 2) {
                $('#DOBDay option[value =30]').remove();
                $('#DOBDay option[value =31]').remove();
            }
            else {
                if ($("#DOBDay option[value='30']").length == 0) {
                    $('#DOBDay').append('<option value="' + 30 + '">' + 30 + '</option>');
                    $('#DOBDay').append('<option value="' + 31 + '">' + 31 + '</option>');
                }
                else if ($("#DOBDay option[value = '31']").length == 0) {
                    $('#DOBDay').append('<option value="' + 31 + '">' + 31 + '</option>');
                }
            }
        });

        $('#DOBYear,#DOBMonth,#DOBDay').on('change', function () {
            var day = $('#DOBDay').val();
            var month = $('#DOBMonth').val();
            var year = $('#DOBYear').val();
            var today = new Date();
            var birthDate = new Date(year, month, day);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() + 1 - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $('#age').val(age);
        });
        $('#DOBMonth').val("<?php echo e(date('m',strtotime($tennant->stallHBday))); ?>").trigger('change');
        $('#DOBDay').val("<?php echo e(date('d',strtotime($tennant->stallHBday))); ?>").trigger('change');
        $('#DOBYear').val("<?php echo e(date('Y',strtotime($tennant->stallHBday))); ?>").trigger('change');

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
                    if(data == 'true')
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