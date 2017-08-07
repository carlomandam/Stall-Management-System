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
        <form class ="form-horizontal" id="applyForm" method ="post" action = " " >
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
                        
                            <input type = "text" class = "form-control" id = "vendor_no" value = "" disabled=""  />
                            
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
        							<label><input type="radio" name="sex" id = "sex1" value="1" checked="checked"><b>Male</b></label>
        							<label><input type="radio" name="sex" id = "sex0" value="0"><b>Female</b></label>
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
<script type="text/javascript">
      $('#applyForm #btn-next').on('click', function () {

                  $('#applyForm fieldset :first-child').fadeIn('slow');
            var parent_fieldset = $(this).parents('fieldset');
            var next_step = true;
           
                 

            if (next_step) {
                parent_fieldset.fadeOut(400, function () {
                    $(this).next().fadeIn();
                });
            }
        });
</script>
  @stop 