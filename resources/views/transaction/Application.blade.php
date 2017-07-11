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
.select2-results__option[aria-selected=true] { 
color: red; }
#last_fieldset
{
    display: none;
}
#btn-last{
    margin-bottom: 30px;
}
.disabled:hover {
    cursor: not-allowed;
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
        <form class ="form-horizontal" id="applyForm" method ="post" action = "{{url('/Registration')}} " role:'form'>
        <input type="hidden" id="_token" name="_token" value="{{csrf_token() }}">
        <div class="col-md-12">
        	<div class ="box box-primary">
             <fieldset>
        		<div class= "box-header">
                      
        				<legend> <b>Stall Holder Details</b></legend>
                </div> 
                <!--/.box-header-->
                        
        				<div class ="box-body">

                        <div class = "col-md-12 form-group row">
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

        							<label for="firstName"><b>*First Name:</b></label>
        						
        							<input type="text" class="form-control" id="fname" name ="fname" required>
        						</div>
                                <div class="col-md-4">
                                    <label for="middleName"><b>Middle Name:</b></label>
                                
                                    <input type="text" class="form-control" id="mname" name="mname" >
                                </div>
                                <div class="col-md-4">
                                    <label for="lastname"><b>*Last Name:</b></label>
                                
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                </div>
        					</div>
        					
        					
        					<div class=" col-md-12 form-group row">
        						<div class="col-md-3">
        							<label for="sex"><b>*Sex:</b></label>
        						
        						<div class="radio" style="margin-left: 30px;">
        							<label><input type="radio" name="sex" value="1" checked="checked"><b>Male</b></label>
        							<label><input type="radio" name="sex" value="0"><b>Female</b></label>
        						</div>
                                </div>

                                <div class = "col-md-3">
                                <label for="bday"><b>*Birthday:</b></label>
                                <div class= "form-inline">
                                <select name="DOBMonth" id = "DOBMonth">
    <option> - Month - </option>
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
    <option> - Day - </option>
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
    <option> - Year - </option>
    
    
</select>
                                </div>
                                </div>
                                <div class = "col-md-3">
                                        <label for = "email">*Email Address:</label>
                                        <input type = "email" class = "form-control" id = "email" name = "email"/>
                                </div>

                                <div class="col-md-3">
                                    <label for="phone"><b>* Mobile:</b></label>
                                    <input type="text" class="form-control" id="mob" name="mob"required>
                                 </div>



                            </div>

                            <div class="col-md-12 form-group row">
                                <div class = "col-md-12">
                                    <label for="address"><b>*Home Address:</b></label>
                            
                                    <textarea rows="4" class="form-control" id="address" name="address"></textarea>
                                </div>
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
                                    
                                    <div class="col-md-10">
                                        <label for="lastname"><b>*Stall No:</b></label>
                                      <select class="js-example-placeholder-multiple" multiple="multiple" style="width: 100%; " id = "stallno" name = "stallno_name">

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

                                    <div class = "col-md-10">    
                                  
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
        <label for="startdate">* Starting Date: </label>
        <input type="text" class="form-control" id='datepicker' /> </div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-12">
        <label for="bussiname">Business Name:</label>
        <input type="text" class="form-control" id="businessName" /> </div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-6">
        <label class="checkbox-inline">
            <input type="checkbox" id="check_assoc"><b>Associate Stall Holder(s)</b> <small>(Maximum of 2 people)</small></label>
    </div>
</div>
<div class="col-md-12 form-group row" id="assoc_hold">
    <div class="col-md-6">
        <label for="assoc1"><b>Associate 1:</b></label>
        <input type="text" class="form-control" placeholder="Full Name" id="assoc_one"> </div>
    <div class="col-md-6">
        <label for="assoc2"><b>Associate 2:</b></label>
        <input type="text" class="form-control" / placeholder="Full Name" id="assoc_two"> </div>
</div>
<div class="col-md-12 form-group row">
    <div class="col-md-12">
        <label for="address"><b>*List of Products:</b></label>
        <textarea rows="4" class="form-control" id="address" name="address"></textarea>
    </div>
</div>
<div class="pull-right" id="btn-last">
    <button type="button" class="btn btn-primary" style="font-size: 16px; margin-right: 50px; width: 100px; margin-right: 20px;" id="btn-prev">Previous</button>
    <button type="submit" class="btn btn-primary" style="font-size: 16px; width: 100px; margin-right: 50px;">Submit</button>
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
<!-- Modal -->
<div class="modal fade" id="table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <button class="modal-title" id="myModalLabel">Stall Name</h4>
            </div>
            <div class="modal-body">
                <p> Choose desired stall</p>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Stall Name</th>
                            <th>Type</th>
                            <th>Floor no.</th>
                            <th>Stall Rate</th>
                            <th>Rate per Day</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Done</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div> @stop @section('script')
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
        // MULTI-STEP FORM///
        $('#applyForm fieldset :first-child').fadeIn('slow');
        $('#applyForm #btn-next').on('click', function () {
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
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
    // MULTIPLE SELECT2 ///
    $(function () {
        $(".js-example-placeholder-multiple").select2({
            placeholder: 'Select Stall'
        });
    });
    $("#datepicker").datepicker({
        showOtherMonths: true
        , selectOtherMonths: true
        , changeMonth: true
        , changeYear: true
        , autoclose: true
        , startDate: "dateToday"
        , todayHighlight: true
        , orientation: 'bottom'
    });
    
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
                for(var i = 0 ; i < stall.stall_util.length; i++){
                    util += stall.stall_util[i].utility.utilName;
                    if(stall.stall_util[i].RateType == 1)
                        util += '(Monthly Reading)';
                    else
                        util += '(Php.'+stall.stall_util[i].Rate+'/Month)';
                    if(i < stall.stall_util.length - 1)
                        util += ', ';
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
    /* 
     $('#stallno').on('change',function(){
         $stallid = $('select[name = 'stallno_name']').val();

         $.ajax({
             url:'/Registration/StallDetails',
             data:{stallid:$stallid},
             cache:false,
             type:'POST',
              beforeSend: function (xhr) {
             var token = $('meta[name="csrf_token"]').attr('content');

         if (token) {
             return xhr.setRequestHeader('X-CSRF-TOKEN', token);
         }
     },
           success:function(data){ 
         console.log(data);
         $('#result_container').html(data); 
     }
         });


     });

     */
    /*
///submit form////
$('#applyForm').submit(function (e)
{  
    e.preventDefault();
    
    var formData = new FormData($(this)[0]);

    $.ajax({

        type:'post'
        , url: '/Registration'
        ,data: formData
        ,processData: false
        ,context: this
        ,success: function (data)
        {
            toastr.success('Successfully Registered!');
          
        }

    });
});


  ////validate form/////
    $('#applyForm').validate({
        rules:{
            venFName:{
                required:true,
                remote:{

                ,type:'post'
                data : {
                    venFName:function(){
                        return $('#applyForm').find("input[name=fname]").val();
                    },
                     _token: function()
                    {
                        return $("#_token").val();
                    }
                }
            }
            }
        },

        messages: {
            venFName: {
                required: "Enter First Name"
            }
        }
        
    });

   */
</script> @stop