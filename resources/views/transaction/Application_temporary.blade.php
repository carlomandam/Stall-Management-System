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
        <!--left table-->
        <div class="col-md-6">
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Stall Holder Details</b></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="js-example-multiple-limit" style="width: 100%;  " id="ven_name" name="ven_name"> </select>
                                <label for="org">Name of Group/Organization<i><b>&nbsp&nbsp(If Applicable)</i></b>
                                </label>
                                <input type="text" class="form-control" id="orgname" name="orgname" />
                                <label for="firstName"><b>First Name</b></label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control" id="fname" name="fname" placeholder="E.G. Jose Protacio">
                                <label for="middleName"><b>Middle Name</b></label>
                                <input type="text" class="form-control" id="mname" name="mname" placeholder="E.G. Alonso Realonda">
                                <label for="lastname"><b>Last Name</b></label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control" id="lname" name="lname" placeholder="E.G. Mercado Rizal">
                                <label for="sex"><b>Sex</b></label><span class="required">&nbsp*</span>
                                <label>
                                    <input type="radio" name="sex" value="1" checked="checked"><b>Male</b></label>
                                <label>
                                    <input type="radio" name="sex" value="0"><b>Female</b></label>
                                <div class="form-inline">
                                    <label for="bday"><b>Birthday</b></label><span class="required">&nbsp*</span>
                                    <select name="DOBMonth" id="DOBMonth">
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
                                    <select name="DOBDay" id="DOBDay">
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
                                    <select name="DOBYear" id="DOBYear">
                                        <option disabled="" selected=""> - Year - </option>
                                    </select>
                                    <label for="age" style="margin-left: 20px;">Age</label>
                                    <input type="text" class="form-control" id="age" name="age" placeholder="" disabled="" style="width: 230px;" /> </div>
                                <label for="email">Email Address</label><span class="required">&nbsp*</span>
                                <input type="text" class="form-control email" id="email" name="email" placeholder="email@domain.com" />
                                <label for="phone"><b>Contact Number/s:</b></label><span class="required">&nbsp*</span>
                                <div class="form-group input-group removable">
                                    <input type="text" name="numbers[]" class="form-control" placeholder="" required> <span class="input-group-btn"><button type="button" class="btn btn-primary btn-add">+</button></span> </div>
                                <label for="address"><b>Home Address</b></label><span class="required">&nbsp*</span>
                                <textarea rows="4" class="form-control" id="address" name="address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading"><b>Requirements</b></div>
                      <div class="panel-body">
                        <div class="row">
                        @foreach($req as $r)
                            <div class="col-md-6">
                                <div class="checkbox">
                                  <label><input name="req[]" style="width: 15px;height: 15px" type="checkbox" value="{{$r->reqID}}">{{$r->reqName}}</label>
                                </div>                 
                            </div>
                        @endforeach
                        </div>
                      </div>
                    </div>
                </div>
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
                        <!--/.col-md-6 -->
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
                                <input type="text" class="form-control pull-right" id="datepicker" name="startDate"> </div>
                        </div>
                        <div class="col-md-6">
                            <label for="startdate">End Date </label><span class="required">&nbsp*</span>
                            <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input type="text" class="form-control pull-right" id="datepicker_end" name="endDate"> </div>
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
        console.log(stall);
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
                        window.location = "{{url('StallHolderList')}}";
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
                , delay: 250
                , processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            $('#fname').val(item.stallHFName);
                            $('#mname').val(item.stallHMName);
                            $('#lname').val(item.stallHLName);
                            var parts = item.stallHBday.split('-');
                            $('#DOBMonth').val(parts[1]);
                            $('#DOBDay').val(parts[2]);
                            $('#DOBYear').val(parts[0]).trigger('change');
                            $('form input[name=sex][value=' + item.stallHSex + ']').click();
                            $('#email').val(item.stallHEmail);
                            $('#address').val(item.stallHAddress);
                            for (var i = $('input[name="numbers[]"]').length; i < item.contact_no.length; i++) {
                                $('input[name="numbers[]"]').last().next().find('button').click();
                            }
                            var j = 0;
                            $('input[name="numbers[]"]').each(function () {
                                $(this).val(item.contact_no[j].contactNumber);
                                j++;
                            });
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
            if ($(this).val() == null) {
                $('#fname').val('');
                $('#mname').val('');
                $('#lname').val('');
                $('#fname').val('');
                $('#DOBMonth')[0].selectedIndex = 0;
                $('#DOBDay')[0].selectedIndex = 0;
                $('#DOBYear')[0].selectedIndex = 0;
                $('#age').val('');
                $('form input[name=sex][value=1]').click();
            }
        });
        $("#ven_name").on('change', function () {});
        //POPULATE YEAR DROPDOWN FOR BIRTHDAY///
        var select = $('#DOBYear');
        var leastYr = 1900;
        var nowYr = new Date().getFullYear();
        for (var v = nowYr; v >= leastYr; v--) {
            $('#DOBYear').append('<option value ="' + v + '">' + v + '</option');
        }
        //HIDE ASSOCIATE HOLDERS//
        $('#assoc_hold').hide();
        $(document).on('click', '#check_assoc', function () {
            if ($('#check_assoc').prop('checked') == true) {
                $('#assoc_hold').fadeIn();
            }
            else {
                $('#assoc_hold').fadeOut();
            }
        });
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
        //DISPLAY AGE//
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
        //INITIALIZE DATEPICKER//
        $("#datepicker").datepicker({
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
        //INITIALIZE DATEPICKER//
        $("#datepicker_end").datepicker({
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
        //INPUTMASK INITIALIZATION//
        Inputmask().mask(document.querySelectorAll("input"));
        $(".email").inputmask("email");
        $('.js-example-basic-multiple').select2({
            width: 'resolve'
        });
        //CONTRACT TYPE//
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
            // Set the value, creating a new option if necessary
            if ($("#products").find("option[value='" + newProdVal + "']").length) {
                $("#products").val(newProdVal).trigger("change");
            }
            else {
                // Create the DOM option that is pre-selected by default
                var newState = new Option(newProdVal, newProdVal, true, true);
                // Append it to the select
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