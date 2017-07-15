@extends('layout.app')
@section('content-header')
<style>
.col-md-12 column {  
   text-align:center;
}
.col-md-12 column form {
   display:inline-block;
}

#tenant_no{

    margin-bottom: 30px;
}
legend{
    margin-left: 10px;
    color: #3c8dbc;
}

#last_fieldset,#final_fieldset
{
    display: none;
}
#btn-last{
    margin-bottom: 30px;
}
.disabled:hover {
    cursor: not-allowed;
}
.required {
    color: red;
} 


</style>

<h1>Registration</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registration</li>
      </ol>
  @stop

  @section('content')
   <div class="row">
        <!-- left column -->
        <form class ="form-horizontal" id="applyForm" method ="post" action = "{{url('/AddVendor')}} " >
        <input type="hidden" id="_token" name="_token" value="{{csrf_token() }}">
        <div class="col-md-12">
        	<div class ="box box-primary">
             <fieldset>
        		<div class= "box-header">
                      
        				<legend> <b>Stall Holder Details</b></legend>

                </div> 
                <!--/.box-header-->
                        
        				<div class ="box-body">

                        <div class = "col-md-12 form-group ">
                            <div class = "col-md-12">
                              <select class="js-example-multiple-limit" style="width: 100%;  " id = "ven_name" name = "ven_name">

                              </select>
                            </div>       
                          
                        </div>
                        <div class = "col-md-12 form-group row" id = "stallhold">
                            <div class = "col-md-4">
                            <label><b>Stall Holder No:</b></label>
                        
                            <input type = "text" class = "form-control" id = "vendor_no" value = "{{ $nextId }}" disabled=""  />
                            
                            </div>

                            <div class = "col-md-8">
                              
                            </div>
                            
                        </div>
                            <div class = "col-md-12 form-group row">
                            <div class = "col-md-12">
                            <label for = "org">Name of Group/Organization<i><b>&nbsp&nbsp(If Applicable)</i></b></label>
                            <input type = "text" class = "form-control" id = "orgname" name = "orgname" />
                        </div>
                        </div>
        					<div class="col-md-12 form-group row">

        						<div class="col-md-4">

        							<label for="firstName"><b>First Name</b></label><span class="required">&nbsp*</span>
        						
        							<input type="text" class="form-control" id="fname" name ="fname" placeholder="E.G. Jose Protacio">
        						</div>
                                <div class="col-md-4">
                                    <label for="middleName"><b>Middle Name</b></label>
                                
                                    <input type="text" class="form-control" id="mname" name="mname" placeholder="E.G. Alonso Realonda">
                                </div>
                                <div class="col-md-4">
                                    <label for="lastname"><b>Last Name</b></label><span class="required">&nbsp*</span>
                                
                                    <input type="text" class="form-control" id="lname" name="lname"  placeholder="E.G. Mercado Rizal">
                                </div>
        					</div>
        					
        					
        					<div class=" col-md-12 form-group row">
        						<div class="col-md-3">
        							<label for="sex"><b>Sex</b></label><span class="required">&nbsp*</span>
        						
        						<div class="radio" style="margin-left: 30px;">
        							<label><input type="radio" name="sex" value="1" checked="checked"><b>Male</b></label>
        							<label><input type="radio" name="sex" value="0"><b>Female</b></label>
        						</div>
                                </div>

                                <div class = "col-md-3">
                                <label for="bday"><b>Birthday</b></label><span class="required">&nbsp*</span>
                                <div class= "form-inline">
                                <select name="DOBMonth" id = "DOBMonth">
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

<select name="DOBDay" id = "DOBDay">
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
    <option value="31" >31</option>
</select>

<select name="DOBYear" id = "DOBYear">
    <option disabled="" selected=""> - Year - </option>
    
    
</select>
                                </div>
                                </div>
                                <div class = "col-md-3">
                                        <label for = "email">Email Address</label><span class="required">&nbsp*</span>
                                        <input type = "text" class = "form-control" id = "email" name = "email"  placeholder="email@domain.com"/>
                                </div>

                                <div class="col-md-3">
                                    <label for="phone"><b>Mobile Number</b></label><span class="required">&nbsp*</span>
                                    <input type="text" class="form-control" id="mob" name="mob"  placeholder="09xxxxxxxxx">
                                 </div>



                            </div>

                            <div class="col-md-12 form-group row">
                                <div class = "col-md-12">
                                    <label for="address"><b>Home Address</b></label><span class="required">&nbsp*</span>
                            
                                    <textarea rows="4" class="form-control" id="address" name="address"></textarea>
                                </div>
                                 <p class="small text-danger" style="margin-left: 20px;">Fields with asterisks(*) are required</p>
                            </div>
                           
                                <div class = "pull-right">
                            
                                <button type="button" class="btn btn-primary" style="font-size: 16px; margin-right: 50px; width: 100px;" id = 'btn-next'>Next</button>
                          
                                </div>
                            </fieldset>
                  <fieldset id = "last_fieldset">
                      <div class = "box-header">
                        <legend> <b>Stall Details </b></legend>
                      </div>
                      <div class="col-md-12 form-group row">
                                    
                                    <div class="col-md-12">
                                        <label for="lastname"><b>Stall No</b></label><span class="required">&nbsp*</span>
                    <select class="js-example-basic-multiple" style="width: 100%; " id = "stallno" name = "stallno_name[]" multiple = "multiple">

                                        @for($i = 0; $i < $buildingCount; $i++)
                                        {<optgroup label = '{{$buildingNames[$i]}}'>
                                            @foreach($stall as $Stall)
                                            {
                                                @if($buildingNames[$i] == $Stall->floor->building->bldgName)
                                                {
                                                    
                                                        <option value = "{{$Stall->stallID}}">{{$Stall->stallID.'( Floor '. $Stall->floor->floorNo. ', '.$Stall->stalltype->stypeName.')' }}</option>
                                                 
                                                }@endif
                                                      
                                            }
                                             </optgroup>
                                            @endforeach
                                            
                                        }
                                        @endfor
                                      
                                      
                                        </select>

                                    </div> 

                                </div>
                            <div class ="col-md-12 form-group row">

                                    <div class = "col-md-12">    
                                  
<!-- /.box-header -->
<div class="box-body no-padding">
    <label>Rate</label>
    <table id='selectedtbl' class="table table-striped">
        <tbody>
            <tr>
                <th>Stall</th>
                <th>Type</th>
                <th>Utilities</th>
                <th>Location</th>
            </tr>
        </tbody>
    </table>
</div>
<!-- /.box-body -->
</div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-12">
        <label for="startdate">Starting Date </label><span class="required">&nbsp*</span>
        <input type="text" class="form-control" id='datepicker' name='datepicker'  readonly="readonly"  style=" cursor:pointer;background:white;"/> </div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-12">
        <label for="bussiname">Business Name</label>
        <input type="text" class="form-control" id="businessName" name ="businessName" /> </div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-6">
        <label class="checkbox-inline">
            <input type="checkbox" id="check_assoc"><b>Associate Stall Holder(s)</b> <small>(Maximum of 2 people)</small></label>
    </div>
</div>
<div class="col-md-12 form-group row" id="assoc_hold">
    <div class="col-md-6">
        <label for="assoc1"><b>Associate 1</b></label>
        <input type="text" class="form-control" placeholder="Full Name" id="assoc_one" name ="assoc_one"> </div>
    <div class="col-md-6">
        <label for="assoc2"><b>Associate 2</b></label>
        <input type="text" class="form-control" / placeholder="Full Name" id="assoc_two" name ="assoc_two"> </div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-12">
        <label for="address"><b>List of Products</b></label><span class="required">&nbsp*</span>
        <textarea rows="4" class="form-control" id="prods" name="prods"></textarea>
    </div>
     <p class="small text-danger" style="margin-left: 20px;">Fields with asterisks(*) are required</p>
</div>

<div class="pull-right" id="btn-last">
    <button type="button" class="btn btn-primary" style="font-size: 16px; margin-right: 50px; width: 100px; margin-right: 20px;" id="btn-prev">Previous</button>
    <button type="button" id = "btn-next2" class="btn btn-primary" style="font-size: 16px; width: 100px; margin-right: 50px;">Next</button>
</div>
</fieldset>
       <fieldset id = "final_fieldset">
                      <div class = "box-header">
                        <legend> <b>Contract Details</b></legend>
                      </div>


                      <div class="col-md-12 form-group row">
                        <div class = "col-md-2">
                        <label for = "length">Length of Contract</label><span class="required">&nbsp*</span>
                        </div>
                        <div class = "col-md-4">
                        <input type = "text" id = "specific_no" name = "specific_no" placeholder="" />
                       
                        
                        <select name = "length" id = "length" style="width: 50%">
                           @foreach($contract_period as $period)
                           {
                            <option value = "{{$period['contract_periodID']}}">{{$period['contract_periodDesc']}}</option>
                           }
                        @endforeach
                        </select>

                        </div>

                      </div>
                      <div class = "col-md-12 form-group row">
                        <div class = "col-md-12">
                        <p class="small text-danger" >Fields with asterisks(*) are required</p>
                        </div>
                       </div>           
<div class="pull-right" id="btn-last">
    <button type="button" class="btn btn-primary" style="font-size: 16px; margin-right: 50px; width: 100px; margin-right: 20px;" id="btn-prev">Previous</button>
    <button type="arf" id = "btn-submit" class="btn btn-primary" style="font-size: 16px; width: 100px; margin-right: 50px;">Submit</button>
</div>
</fieldset>
</div>
<!--/.box-body-->
</div>
<!--/.box-primary-->
</div>
<!--/.col-md-12-->
</form>
</div>
<!-- /.row -->

 @stop
  @section('script')
<script>
    function clearForm() {
        var store = $('#vendor_no').val();
        $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
        $(':checkbox').prop('checked', false);
        $('#vendor_no').val() = store;
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
    $(document).ready(function () {
        //Set selected value in length of contract//
        $("#length").val($("#length option:first").val());
        var placeholderValue;
   
                if($("#length option:selected").text().indexOf('Week') > -1)
                {
                    placeholderValue = "No. of Week/s";
                }
                else if($("#length option:selected").text().indexOf('Month') > -1)
                {
                    placeholderValue = "No. of Month/s";
                }
                else
                {
                    placeholderValue = "No. of Year/s";
                }
            $('#specific_no').attr('placeholder',""+placeholderValue);

        //POPULATE YEAR DROPDOWN FOR BIRTHDAY///
        var select = $('#DOBYear');
        var leastYr = 1960;
        var nowYr = 2017;
        for (var v = nowYr; v >= leastYr; v--) {
            $('#DOBYear').append('<option value ="' + v + '">' + v + '</option');
        }
        //HIDE ASSOCIATE HOLDERS WHICH IS OPTIONAL//
        $('#assoc_hold').hide();
        $(document).on('click', '#check_assoc', function () {
            if ($('#check_assoc').prop('checked') == true) {
                $('#assoc_hold').fadeIn();
            }
            else {
                $('#assoc_hold').fadeOut();
            }
        });

         //email validation//
         $.validator.addMethod("custom_email", function(value, element) {
          var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(value);
        }, 'Input valid email address');

         //mobile number validation//
          
         $.validator.addMethod("custom_mobno", function(value, element) {
          var pattern = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
         return pattern.test(value);
         }, 'Input valid mobile number');

         //end of validation//


        // MULTI-STEP FORM///
  
        $('#applyForm #btn-next').on('click', function () {

            $('#applyForm').validate({
                rules:{
                     fname: {required:true}
                    ,lname: {required:true}
                    ,sex:   {required:true }
                    ,address:{required:true}
                    ,mob:    {required:true,
                             custom_mobno:true,
                             maxlength: 11 }
                    ,email:  {required:true,
                           custom_email:true,
                        remote:{
                            url: '/checkEmail',
                            type: 'post',
                            data:{
                                email:function(){
                                    return $('#applyForm').find("input[name=email]").val();
                                },
                                _token: function(){
                                    return $('#_token').val();
                                }
                            }
                        }
                    }
                    ,stallno_name: {required:true}
                    ,prods: {required:true}
                    ,datepicker:   {required:true }
                    ,DOBDay :{ required:true}
                    ,DOBMonth: { required:true}
                    ,DOBYear: {required:true}
                    ,specific_no: {required:true,number:true}

                    



                }
                , messages:{
                    fname: {
                        required: "First Name is required"
                    },
                    lname: {
                        required: "Last Name is required"
                    },
                    address: {
                        required: "Home Address is required"
                    },
                    mob: {
                        required: "Mobile No. is required",
                        number: "Numbers only"
                    },
                    email: {
                        required: "Email Address is required"
                        ,remote: "Email is already taken"
                    },
                    stallno_name: {
                        required: "Select a Stall No."
                    },
                    prods: {
                        required: "List of products is required"
                    },
                    datepicker: {
                        required: "Starting Date is required"
                    },
                    DOBDay, DOBMonth, DOBYear:{
                        required: "Birthday is required"
                    }, 
                    specific_no:{
                        required: "Input specific number",
                        number: "Numbers only"
                    }

                  
                }
                ,errorClass: "error-class"
            , validClass: "valid-class"

            });  



            


            if ((!$('#applyForm').valid())) { //I added an extra parenthesis at the end
                           return false;
                 }


            $('#applyForm fieldset :first-child').fadeIn('slow');
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    $(this).next().fadeIn();
                });
            }
        });
    //SHOW CONTRACT DETAILS///
     $('#applyForm #btn-next2').on('click', function () {
           var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
               if ((!$('#applyForm').valid())) { //I added an extra parenthesis at the end
                           return false;
                 }

            if (next_step) {
                parent_fieldset.fadeOut(400, function () {

                    $(this).next().fadeIn();
                   
                });
            }
    });

        //CLICK PREVIOUS BUTTON///
        $('#applyForm #btn-prev').on('click', function () {
            $(this).parents('fieldset').fadeOut(400, function () {
                $(this).prev().fadeIn();
            });
        });
    });
   


     //LENGTH OF CONTRACT//

     $('#length').on('change',function(){
       var placeholderValue;
     if($("#length option:selected").text().indexOf("(") > -1)
        { 
                if($("#length option:selected").text().indexOf('Week') > -1)
                {
                    placeholderValue = "No. of Week/s";
                }
                else if($("#length option:selected").text().indexOf('Month') > -1)
                {
                    placeholderValue = "No. of Month/s";
                }
                else
                {
                    placeholderValue = "No. of Year/s";
                }
            $('#specific_no').attr('placeholder',""+placeholderValue);
            
             $('#specific_no').removeAttr('disabled',false);
            
             $('#specific_no').val('');
        }
        else{
            
             $('#specific_no').val('N/A');
             $('#specific_no').attr('disabled',true);
             $('#specific_no').removeAttr('placeholder',false);
        }
     })
     
     
     
     //END OF LENGTH OF CONTRACT//
    // MULTIPLE SELECT2 ///
    $(function () {
        $(".js-example-basic-multiple").select2({
            placeholder: 'Select Stall',
            theme : "bootstrap"
        });
    });
    $("#datepicker").datepicker({
        showOtherMonths: true
        , selectOtherMonths: true
        , changeMonth: true
        , changeYear: true
        , autoclose: true
        , startDate: "+1d"
        , todayHighlight: true
        , orientation: 'bottom'
        ,format:  "MM dd,yyyy" 
    });



    //SELECTED STALL ID AND ITS RATES
    var stalls = JSON.parse(("{{$stall}}").replace(/&quot;/g,'"'));
    var val;
    var sel = 0;
    $('#stallno').on('change',function(){
        var newVal = $(this).val();
        if($('#stallno').val() != null){
            if($('#stallno').val().length > sel){
                index = 0;

                for(var i=0; i<newVal.length; i++) {
                    if($.inArray(newVal[i], val) == -1)
                        index = i;
                }

                var stall = _.find(stalls,{'stallID': $('#stallno').val()[index]});
                var util = '';
                if(stall.stall_util != undefined){
                    for(var i = 0 ; i < stall.stall_util.length; i++){
                        util += stall.stall_util[i].utility.utilName;
                        if(stall.stall_util[i].RateType == 1)
                            util += '(Monthly Reading)';
                        else
                            util += '(Php.'+stall.stall_util[i].Rate+'/Month)';
                        if(i < stall.stall_util.length - 1)
                            util += ', ';
                    }
                }
                $('#selectedtbl tbody').append('<tr><td>'+stall.stallID+'</td><td>'+stall.stall_type.stypeName+'</td><td>'+util+'</td><td>Floor '+stall.floor.floorNo+', '+stall.floor.building.bldgName+'</td></tr>')
            }
            else if($('#stallno').val().length < sel){
                var id = val.filter(function(obj) { return newVal.indexOf(obj) == -1; });
                $("td").filter(function() {
                    return $(this).text() == id;
                }).closest("tr").remove();
            }
            sel = $('#stallno').val().length; 
        }else{
            $('#selectedtbl tbody td').remove();
            sel = 0;
        }
        val = newVal;
    });
 
    /// SUBMIT REGISTRATION//
    $("#applyForm").submit(function (e) {
            e.preventDefault();
            if (!$("#applyForm").valid()) return;
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                ,url:'/AddVendor'
             , data: formData
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    toastr.success('Successfully Registered!');
                    $("#applyForm")[0].reset();
                     location.reload();
                    
                }
            });
        });
   //SEARCH EXISTING STALL HOLDER//

   $("#ven_name").select2({

  minimumInputLength:2,
   allowClear: true,
  placeholder: 'Select Existing Record',
    ajax: {
           url: '/searchVendor',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.full_name,
                        id: item.venID
                    }
                })
            };
          },
          cache: true
        }
});
$('#ven_name').on('change',function(){
  
    if( !$('#ven_name').val()) {
         location.reload();
           
}
     else{
       var venid = $(this).val();
       $.ajax({
            method:'get',
            url: '/displaySearch',
            data: {
                    "_token" : "{{ csrf_token()}}"
                    ,"id":venid
            },success: function(data)
            {
                var obj = JSON.parse(data)[0];
               $leftval = "SH-" + 2017;
               $stallholderno = $leftval + String("00000" + obj.venID).slice(-5);
                 $('#applyForm').find('input[name=orgname]').val(obj.venOrgName);
              $('#vendor_no').val($stallholderno);  
              $('#fname').val(obj.venFName);
              $('#mname').val(obj.venMName);
              $('#lname').val(obj.venLName);
              if(obj.venSex==1)
                    {
                    $('#applyForm').find('input[name=sex][value = 1]').attr('checked', true);}
                    else{
                       $('#applyForm').find('input[name=sex][value = 0]').attr('checked', true);
                    }

                    $('#applyForm').find('input[name = email]').val(obj.venEmail);
                    $('#applyForm').find('input[name = mob]').val(obj.venContact);
                    var bday = obj.venBDay;
                   
                    $splitDate = bday.split("-");
                    $('#DOBYear').val($splitDate[0]).attr('selected',true).siblings('option').removeAttr('selected');
                  //  $('#DOBYear').selectmenu('refresh',true);
                    $('#DOBMonth').val($splitDate[1]).attr('selected',true).siblings('option').removeAttr('selected');
                    $('#DOBDay').val($splitDate[2]).attr('selected',true).siblings('option').removeAttr('selected');

                    $('#address').val(obj.venAddress);
              
              }


       });

    }
        
     
});
 

</script> 
  @stop 