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
    
    p {
        margin-left: 14px;
    }
    
    .text {
        border: 0px solid #000000;
        border-bottom-width: 1px;
        background-color: transparent !important;
    }
    
    input,
    span:not(.selection, .select2-selection) {
        background-color: transparent !important;
    }
</style>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Transactions </li>
    <li>Manage Contracts</li>
    <li><a href="/StallList">Stall List</a></li>
    <li class="active">Registration</li>
</ol>
<script type="text/javascript" src="{{ URL::asset('js/zepto.js')}}">
</script>
<script type="text/javascript" src="{{ URL::asset('js/icheck.js')}}">
</script> @stop @section('content')
<div class="row">
    <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="{{ url('/StallHolderList') }}" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbsp;Back</a> </div>
    <div class="col-md-12">
        <div class="box box-primary ">
            <div class="col-md-12">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul id="error-new"></ul>
                </div>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Stall Holder Details &nbsp;<a href="/getTennant/{{$stallHolderDetails->stallHID}}" style="font-size:11px"><span class='fa fa-pencil'></span>Update</a></h3> </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="firstName"><b>StallHolder Name</b></label>
                            <p> {{$stallHolderDetails->stallHFName.' '.$stallHolderDetails->stallHLName}}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="address"><b>Home Address</b></label>
                            <p>{{$stallHolderDetails->stallHAddress}}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="bday"><b>Birthday</b></label>
                            <p>
                                <?php
                                            $today = date("Y-m-d");
                                            $diff = date_diff(date_create($stallHolderDetails->stallHBday), date_create($today));

                                            echo date('F',strtotime($stallHolderDetails->stallHBday)).' '.date('d',strtotime($stallHolderDetails->stallHBday)).', '.date('Y',strtotime($stallHolderDetails->stallHBday)).' ('.$diff->format('%y').' years old)';
                                        ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="sex"><b>Gender</b></label>
                            <p>{{($stallHolderDetails->stallHSex == 1) ? 'Male' : 'Female'}}</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label for="email">Email Address</label>
                            <p>{{$stallHolderDetails->stallHEmail}}</p>
                        </div>
                        <div class="col-md-6">
                            <label for="phone"><b>Contact Number/s:</b></label>
                            <ul> @foreach($stallHolderDetails->ContactNo as $contact)
                                <li>{{$contact->contactNumber}}</li> @endforeach </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Contract Details</h3> </div>
            <div class="box-body">
                <div class="row">
                    <form id="applyForm" method="post">
                        <div class="col-md-12">
                            <div id="newEC" class="alert alert-danger print-error-msg" style="display:none">
                                <ul id="error-new"></ul>
                            </div>
                        </div>
                        <input type="hidden" id="contract" name="contract" value="<?php echo $contract->contractID ?>">
                        <div id="contract">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Stall Code</label>
                                    <p>{{$stallDetails->stallID}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label>Stall Type</label>
                                    <p>{{$stallDetails->stypeName}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Location</label>
                                    <p>{{(($stallDetails->floorLevel == '1') ? $stallDetails->floorLevel.'st' : (($stallDetails->floorLevel == '2') ? $stallDetails->floorLevel.'nd' : (($stallDetails->floorLevel == '3') ? $stallDetails->floorLevel.'rd' : $stallDetails->floorLevel.'th'))).' Floor'}}, {{$stallDetails->bldgName}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label for="org">Name of Group/Organization<i><b>&nbsp&nbsp(If Applicable)</b></i> </label>
                                    <input type="text" class="form-control" id="orgname" name="orgname" value="{{$contract->orgName}}" /> </div>
                                <div class="col-md-6">
                                    <label for="bussiname">Business Name</label>
                                    <input type="text" class="form-control" id="businessName" name="businessName" value="{{$contract->businessName}}" /> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label for="address"><b>Products</b></label><span class="required">&nbsp*</span>
                                    <select class="form-control" name="products[]" id="products" multiple="multiple">
                                        <?php
                                            foreach($prod as $x){
                                                echo "<option value='".$x['productID']."'>".$x['productName']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div> @if(count($req) > 0)
                                <div class="col-md-6">
                                    <br>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><b>Requirements</b></div>
                                        <div class="panel-body">
                                            <div class="row"> @foreach($req as $r)
                                                <div class="col-md-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="req[]" style="width: 15px;height: 15px" type="checkbox" value="{{$r->reqID}}" @if($stallHolderDetails->Requirement->contains($r))defaultChecked="true" checked=""@endif>{{$r->reqName}}</label>
                                                    </div>
                                                </div> @endforeach </div>
                                        </div>
                                    </div>
                                </div> @endif
                                <div class="col-md-12">
                                    <p class="small text-danger" style="margin-left: 20px;">Fields with asterisks(*) are required</p>
                                </div>
                            </div>
                            <div class="col-md-12" id="registerButtons">
                                <div class="pull-right">
                                    <button type='button' id='upbtn' onclick="updateContract(1)" class="btn btn-primary"><span class='fa fa-pencil'></span>&nbsp;Update</button>
                                    <button type="button" onclick="reject();" class="btn btn-danger">Cancel</button>
                                    <button type="button" class="btn btn-success" onclick="accept()">Proceed To Payment</button>
                                </div>
                            </div>
                            <div class="col-md-12" id="updateButtons" style="display:none">
                                <div class="pull-right">
                                    <button type="button" onclick="updateContract(2); $('#applyForm')[0].reset();" class="btn btn-danger">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
<script type="text/javascript">
    var selected = Array();
    $(document).ready(function () {
        $("input:checkbox").click(function () {
            return false;
        });
        $('#products').select2({
            width: 'resolve'
        });
        $product = JSON.parse("{{json_encode($contract->Product)}}".replace(/&quot;/g, '"'));
        for (var i = 0; i < $product.length; i++) {
            selected.push($product[i].productID);
        }
        $('#products').val(selected).trigger('change');
        $('input').attr('readonly', true);
        $('textarea,select,input[name=sex],input[name=ctype]').prop('disabled', true);
        $(".datepicker").each(function () {
            $(this).datepicker('remove');
            $(this).prop('disabled', true);
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
        $("#applyForm").validate({
            rules: {
                businessName: "required"
                , "products[]": 'required'
            }
            , messages: {
                businessName: 'Business Name is required'
                , "products[]": 'Specify products'
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , highlight: function (element, errorClass, validClass) {
                $(element).removeClass(validClass).addClass(errorClass);
                $('#applyForm .print-error-msg').css('display', 'block');
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
            , errorElement: "li"
            , errorPlacement: function (error) {
                error.appendTo('.print-error-msg ul');
            }
            , errorContainer: "#newEC"
            , submitHandler: function (form) {
                var formData = new FormData($('#applyForm')[0]);
                $.ajax({
                    type: "POST"
                    , url: '/updateApplication'
                    , data: formData
                    , processData: false
                    , contentType: false
                    , context: this
                    , success: function (data) {
                        toastr.success('Updated!');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                });
            }
        });
    });

    function reject() {
        $.ajax({
            type: "POST"
            , url: '/rejectRental'
            , data: {
                "rental": $('#rental').val()
            }
            , success: function (data) {
                toastr.warning('Rental Declined');
                //window.location;
            }
        });
    }

    function updateContract(x) {
        if (x == 1) {
            $('#registerButtons').fadeOut(function () {
                $('#updateButtons').fadeIn();
                $('#addProd').fadeIn();
                $('#contract input,#contract input textarea,#contract input select').attr('readonly', false);
                $(".datepicker").datepicker({
                    showOtherMonths: true
                    , selectOtherMonths: true
                    , changeMonth: true
                    , changeYear: true
                    , autoclose: true
                    , startDate: "dateToday"
                    , todayHighlight: true
                    , orientation: 'bottom'
                    , format: 'yyyy-mm-dd'
                });
                $(".datepicker > .form-control").prop('disabled', false);
                $('#contract input[name=ctype], #contract select').prop('disabled', false);
                $("input:checkbox").unbind('click');
            });
        }
        else {
            $('#updateButtons, #addProd').fadeOut(function () {
                $('#registerButtons').fadeIn();
                $('#contract select').prop('disabled', true);
                $('#products').val(selected).trigger('change');
            });
        }
    }

    function accept() {
        if ($('input[type=checkbox]:checked').length != $('input[type=checkbox]').length) {
            toastr.error('All requirements must be submitted');
            return;
        }
        var formData = new FormData($('#applyForm')[0]);
        $.ajax({
            type: "POST"
            , url: '/acceptRental'
            , data: formData
            , processData: false
            , contentType: false
            , context: this
            , success: function (data) {
                if (data.trim() == "init") {
                    toastr.error('Initial Fees not set');
                }
                else {
                    toastr.success('Successfully Registered!');
                    $("#applyForm")[0].reset();
                    window.location = "goToPayment/" + data;
                }
            }
        });
    }
</script> @stop