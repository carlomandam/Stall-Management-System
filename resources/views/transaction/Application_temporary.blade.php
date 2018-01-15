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
    
    p {
        margin-left: 14px;
    }
</style>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Transactions </li>
    <li><a href="{{ url('/StallHolderList') }}">Manage Contracts</a></li>
    <li>Registration</li>
</ol>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/square/blue.css')}}"> @stop @section('content')
<form id="applyForm" method="post">
    <input type="hidden" name="rateid" id="rateid" value="{{$stall->StallType->StallRate->stallRateID}}" />
    <input type="hidden" name="stallid" id="stallid" value="{{$stall->stallID}}" />
    <div class="row">
        <div class="col-md-12">
            <div id="newEC" class="alert alert-danger print-error-msg" style="display:none">
                <ul id="error-new"></ul>
            </div>
        </div>
        <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="{{ url('/StallHolderList') }}#tab1primary" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbsp; Back to StallHolder List</a> </div>
        <div class="col-md-6">
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Stall Holder Details</b></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="js-example-multiple-limit" style="width: 100%;  " id="ven_name" name="ven_name"> </select>
                                <label for="org">Name of Group/Organization<i><b>&nbsp;&nbsp;(If Applicable)</b></i> </label>
                                <input type="text" class="form-control" id="orgname" name="orgname" />
                                <label for="firstName"><b>First Name</b></label><span class="required">&nbsp;*</span>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="E.G. Jose Protacio">
                                <label for="middleName"><b>Middle Name</b></label>
                                <input type="text" class="form-control" id="mname" name="mname" placeholder="E.G. Alonso Realonda">
                                <label for="lastname"><b>Last Name</b></label><span class="required">&nbsp;*</span>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="E.G. Mercado Rizal">
                                <label for="sex"><b>Sex</b></label><span class="required">&nbsp;*</span>
                                <div class="col-md-12">
                                    <label>
                                        <input type="radio" name="sex" value="1" checked="checked"><b>Male</b></label>
                                    <label>
                                        <input type="radio" name="sex" value="0"><b>Female</b></label>
                                </div>
                                <br>
                                <div class="col-md-6" style="padding:0px">
                                    <label>Date of Birth</label>
                                    <div class="input-group date datepicker">
                                        <input type="text" class="form-control" id="DOB" name="DOB" style="cursor:pointer;background-color:#FFFFFF" readonly>
                                        <div class="input-group-addon"> <span class="glyphicon glyphicon-th"></span></div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-left: 5px">
                                    <label>Age</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="age" style="cursor:pointer;background-color:#FFFFFF" readonly>
                                    </div>
                                </div>
                                <label for="email">Email Address</label><span class="required">&nbsp;*</span>
                                <input type="text" class="form-control email" id="email" name="email" placeholder="email@domain.com" />
                                <label for="phone"><b>Contact Number/s:</b></label><span class="required">&nbsp;*</span>
                                <div class="form-group input-group removable">
                                    <input type="text" name="numbers[]" class="form-control" placeholder="" required> <span class="input-group-btn"><button type="button" class="btn btn-primary btn-add">+</button></span> </div>
                                <label for="address"><b>Home Address</b></label><span class="required">&nbsp;*</span>
                                <textarea rows="4" class="form-control" id="address" name="address"></textarea>
                            </div>
                        </div>
                    </div> @if(count($req) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>Requirements</b></div>
                        <div class="panel-body">
                            <div class="row"> @foreach($req as $r)
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input name="req[]" style="width: 15px;height: 15px" type="checkbox" value="{{$r->reqID}}">{{$r->reqName}}</label>
                                    </div>
                                </div> @endforeach </div>
                        </div>
                    </div> @endif </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Contract Details</b></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Code</label>
                                <p>{{$stall->stallID}}</p>
                                <label>Stall Rate</label>
                                <p>{{'₱'.$stall->StallType->StallRate->dblRate}}</p>
                                <label>Peak Days Additional Rate</label>
                                <p>{{($stall->StallType->StallRate->peakRateType == 1) ? '₱ '.number_format($stall->StallType->StallRate->dblPeakAdditional,2,'.',',') : $stall->StallType->StallRate->dblPeakAdditional.'% (₱ '.number_format(($stall->StallType->StallRate->dblRate * ($stall->StallType->StallRate->dblPeakAdditional / 100)),2,'.',',').')'}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stall Type</label>
                                <p>{{$stall->StallType->StallType->stypeName }} ({{$stall->StallType->StallTypeSize->stypeArea}}m&sup2;)</p>
                                <label>Location</label>
                                <p>{{(($stall->Floor->floorLevel == '1') ? $stall->Floor->floorLevel.'st' : (($stall->Floor->floorLevel == '2') ? $stall->Floor->floorLevel.'nd' : (($stall->Floor->floorLevel == '3') ? $stall->Floor->floorLevel.'rd' : $stall->Floor->floorLevel.'th'))).' Floor'}}, {{$stall->Floor->Building->bldgName}}</p>
                                <label>Utilities</label>
                                <p>@for($i=0;$i < count($stall->StallUtility);$i++)
                                    {{($stall->StallUtility[$i]->utilityType == 1) ? "Electricity":(($stall->StallUtility[$i]->utilityType == 2) ? "Water" : "Unkown Utility")}}@if($i < count($stall->StallUtility)-1), @endif
                                    @endfor
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="bussiname">Business Name</label>
                            <input type="text" class="form-control" id="businessName" name="businessName" /> </div>
                        <div class="col-md-12">
                            <label for="address"><b>Products</b></label><span class="required">&nbsp;*</span>
                            <select class="js-example-basic-multiple js-states form-control" name="products[]" id="products" multiple="multiple">
                                <?php
                                    foreach($prod as $x){
                                        echo "<option value='".$x['productID']."'>".$x['productName']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12"> <span class="small text-danger">Fields with asterisks(*) are required</span> </div>
                        <div class="col-md-12 ">
                            <button type="submit" class="btn btn-primary btn-flat pull-right" id="sub">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/icheck.js')}}">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var stall = JSON.parse("{{json_encode($stall)}}".replace(/&quot;/g, '"'));
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
        $("#applyForm").validate({
            rules: {
                fname: 'required'
                , lname: 'required'
                , sex: 'required'
                , DOB: 'required'
                , email: 'required'
                , "numbers[]": 'required'
                , address: 'required'
                , "products[]": 'required'
                , businessName:"required"
            }
            , messages: {
                fname: 'First Name is required'
                , lname: 'Last Name is required'
                , sex: 'Sex is required'
                , DOB: 'Day of Birth is required'
                , email: 'Email is required'
                , "numbers[]":{required : 'Enter atleast 1 contact number'}
                , address: 'Address is required'
                , "products[]": 'Specify products'
                , businessName:"Business Name is required"
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('#newEC ul');
            }
            , errorContainer: "#newEC"
            , submitHandler: function (form) {
                $body.addClass("loading");
                var formData = new FormData(form);
                $.ajax({
                    type: "POST"
                    , url: '/AddVendor'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        $body.removeClass("loading");
                        if (data.trim() == 'exist') {
                            toastr.warning("User's application already exist");
                            return;
                        }
                        toastr.success('Successfully Registered!');
                        window.location = data;
                    }
                });
            }
        });
        $("#ven_name").select2({
            minimumInputLength: 2
            , allowClear: true
            , placeholder: 'Select Existing Record'
            , ajax: {
                url: '/searchVendor'
                , dataType: 'json'
                , processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.stallHFName + " " + item.stallHLName
                                , id: item.stallHID
                            }
                        })
                    };
                }
                , cache: true
            }
        });
        $("#ven_name").on('change', function () {
            if ($(this).val() != null) $.ajax({
                type: "POST"
                , url: '/getVendorData'
                , data: {
                    "id": $(this).val()
                }
                , context: this
                , success: function (data) {
                    var item = data;
                    $('#fname').val(item.stallHFName);
                    $('#mname').val(item.stallHMName);
                    $('#lname').val(item.stallHLName);
                    var parts = item.stallHBday.split('-');
                    $("#DOB").datepicker("setDate",item.DOB);
                    $('form input[name=sex][value=' + item.stallHSex + ']').click();
                    $('#email').val(item.stallHEmail);
                    $('#address').val(item.stallHAddress);
                    if (item.contact_no.length != 0) {
                        for (var i = $('input[name="numbers[]"]').length; i < item.contact_no.length; i++) {
                            $('input[name="numbers[]"]').last().next().find('button').click();
                        }
                        var j = 0;
                        $('input[name="numbers[]"]').each(function () {
                            $(this).val(item.contact_no[j].contactNumber);
                            j++;
                        });
                    }
                }
            });
            else $('form input,select').val("");
        });
        $('#assoc_hold').hide();
        $(document).on('click', '#check_assoc', function () {
            if ($('#check_assoc').prop('checked') == true) {
                $('#assoc_hold').fadeIn();
            }
            else {
                $('#assoc_hold').fadeOut();
            }
        });
        Inputmask().mask(document.querySelectorAll("input"));
        $(".email").inputmask("email");
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
            , closeOnSelect: false
        });
        $(".select2").on('keyup', 'li.select2-search input.select2-search__field', function (e) {
            if (e.keyCode == 13 && $("li.select2-results__option").not('.select2-results__message').length == 0 && $(this).val() != '') {
                e.preventDefault();
                var isnew = true;
                var newProdVal = $(this).val();
                $("#products").find("option").each(function () {
                    if ($(this).html() == newProdVal) {
                        $(this).prop('selected', true);
                        $("#products").trigger('change');
                        isnew = false;
                    }
                });
                if (isnew) {
                    var newProd = new Option(newProdVal, newProdVal, true, true);
                    $("#products").append(newProd).trigger('change');
                }
                $(this).val('');
            }
        });
    });
</script>
<script src="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
<script src="{{ URL::asset('js/phone-ru.js')}}"></script>
<script src="{{ URL::asset('js/phone-be.js')}}"></script>
<script src="{{ URL::asset('js/phone.js')}}"></script> @stop