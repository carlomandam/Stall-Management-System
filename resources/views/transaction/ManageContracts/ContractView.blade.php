@extends('layout.app') @section('title') {{ 'Registration'}} @stop @section('content-header')
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
    
    #sub {
        margin: 20px;
        width: 120px;
    }
</style>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Transactions </li>
    <li><a href="{{ url('/StallHolderList') }}">Manage Contracts</a></li>
    <li>Registration</li>
</ol>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/square/blue.css')}}"> @stop @section('content')
<form id="applyForm" method="post">
    <input type="hidden" name="rateid" id="rateid" />
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul id="error-new"></ul>
            </div>
        </div>
        <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="{{ url('/StallHolderList') }}" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbsp Back to StallHolder List</a> </div>
        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Contract Details</b></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Code</label>
                                <input type="text" class="form-control" readonly name="dispStallID" id="dispStallID" value="{{$stall->stallID}}">
                                <label>Stall Rate</label>
                                <input type="text" class="form-control" readonly name="rate" id="dispStallID" value="{{'₱'.$stall->StallType->StallRate->dblRate}}">
                                <label>Peak Days Additional Rate</label>
                                <input type="text" class="form-control" readonly name="rate" id="dispStallID" value="{{($stall->StallType->StallRate->peakRateType == 1) ? '₱'.$stall->StallType->StallRate->dblPeakRate : $stall->StallType->StallRate->dblPeakRate.'%'}}">
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type</label>
                                <input type="text" class="form-control" disabled="" name="dispStallType" id="dispStallType" readonly="" value=" {{$stall->StallType->StallType->stypeName }} ({{$stall->StallType->StallTypeSize->stypeArea}} m&sup2) " />
                                <label>Location</label>
                                <textarea type="text" class="form-control" disabled="" name="dispStallLocation" id="dispStallLocation" readonly="">{{(($stall->Floor->floorLevel == '1') ? $stall->Floor->floorLevel.'st' : (($stall->Floor->floorLevel == '2') ? $stall->Floor->floorLevel.'nd' : (($stall->Floor->floorLevel == '3') ? $stall->Floor->floorLevel.'rd' : $stall->Floor->floorLevel.'th'))).' Floor'}}, {{$stall->Floor->Building->bldgName}} Building</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="contracttype">Contract Type</label> <span class="required">&nbsp*</span>
                            <label>
                                <input type="radio" name="ctype" id="ctype" value="1" checked="checked"><b>Fixed</b></label>
                            <label>
                                <input type="radio" name="ctype" id="ctype" value="0"><b>At-Will</b></label>
                        </div>
                        <div class="col-md-6" id="changeClass">
                            <label for="startdate">Start Date </label><span class="required">&nbsp*</span>
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input type="text" class="form-control pull-right" id="sdate" name="startDate"> </div>
                        </div>
                        <div class="col-md-6">
                            <label for="startdate">End Date </label><span class="required">&nbsp*</span>
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input type="text" class="form-control pull-right" id="edate" name="endDate"> </div>
                        </div>
                        <div class="col-md-12">
                            <label for="bussiname">Business Name</label>
                            <input type="text" class="form-control" id="businessName" name="businessName" /> </div>
                        <div class="col-md-12">
                            <label for="address"><b>List of Products</b></label><span class="required">&nbsp*</span>
                            <select class="js-example-basic-multiple js-states form-control" name="products[]" id="products" multiple="multiple">
                                <?php
                                    foreach($prod as $x){
                                        echo "<option value='".$x['productID']."'>".$x['productName']."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                            <br>
                            <input id="new-product" class='form-control' type="text" style='width:40%' />
                            <button type="button" id="btn-add-product">Add Product</button>
                        </div>
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary btn-flat pull-right" id="sub">Save</button>
                            <p class="small text-danger">Fields with asterisks(*) are required</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/icheck.js')}}">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var stall = JSON.parse("{{json_encode($stall)}}".replace(/&quot;/g, '"'));
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
        });
        $('#rateid').val(stall.stall_type.stall_rate.stallRateID);
        $("#applyForm").validate({
            rules: {
                fname: 'required'
                , lname: 'required'
                , sex: 'required'
                , DOBDay: 'required'
                , DOBMonth: 'required'
                , DOBYear: 'required'
                , email: 'required'
                , "contact[]": 'required'
                , address: 'required'
                , ctype: 'required'
                , startDate: 'required'
                , businessName: 'required'
                , "products[]": 'required'
            }
            , messages: {
                fname: 'First Name is required'
                , lname: 'Last Name is required'
                , sex: 'Sex is required'
                , DOBDay: 'Day of Birth is required'
                , DOBMonth: 'Month of Birth is required'
                , DOBYear: 'Year of Birth is required'
                , email: 'Email is required'
                , "contact[]": 'Enter atleast 1 contact number'
                , address: 'Address is required'
                , ctype: 'Select contract type'
                , startDate: 'Start Date is required'
                , businessName: 'Business Name is required'
                , "products[]": 'Specify products'
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , highlight: function (element, errorClass, validClass) {
                $(element).removeClass(validClass).addClass(errorClass);
                $('#applyForm .print-error-msg').css('display', 'block');
            }
            , unhighlight: function (element, errorClass, validClass) {
                var i = 0;
                $('#applyForm .print-error-msg ul').find('li').each(function () {
                    if ($(this).css('display') != 'none') i++;
                });
                if (i == 0) $('#applyForm .print-error-msg').css('display', 'none');
                $(element).removeClass(errorClass).addClass(validClass);
            }
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#applyForm .print-error-msg ul');
            }
            , submitHandler: function (form) {
                var formData = new FormData(form);
                $.ajax({
                    type: "POST"
                    , url: '/AddVendor'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        if (data == 'exist') {
                            toastr.warning("User's application already exist");
                            return;
                        }
                        toastr.success('Successfully Registered!');
                        window.location = data;
                    }
                });
            }
        });

        $("#sdate").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "{{$contract->contractStart}}"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
        
        $("#edate").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "{{$contract->contractEnd}}"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
        
        $('input[name=ctype]').change(function () {
            var value = $('input[name=ctype]:checked').val();
            if (value == 0) {
                $('#datepicker_end').prop('disabled', true);
            }
            else {
                $('#datepicker_end').removeAttr('disabled', true);
            }
        });

        $("#btn-add-product").on("click", function () {
            var newProdVal = $("#new-product").val();
            
            if ($("#products").find("option[value='" + newProdVal + "']").length) {
                $("#products").val(newProdVal).trigger("change");
            }
            else {
                var newState = new Option(newProdVal, newProdVal, true, true);
                $("#products").append(newState).trigger('change');
            }
        });
        $('textarea').each(function () {
            textAreaAdjust(this);
        });
    });

    function textAreaAdjust(o) {
        o.style.height = '1px';
        o.style.height = (25 + o.scrollHeight) + "px";
    }
</script>
<script src="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
<script src="{{ URL::asset('js/phone-ru.js')}}"></script>
<script src="{{ URL::asset('js/phone-be.js')}}"></script>
<script src="{{ URL::asset('js/phone.js')}}"></script> @stop