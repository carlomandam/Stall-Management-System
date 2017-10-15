<?php $__env->startSection('title'); ?>
<?php echo e('Registration'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>
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
label{
    margin-top: 10px;
}


</style>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Transactions</a></li>
        <li>Manage Contracts</li>
        <li><a href = "/StallList">Stall List</a></li>
        <li class="active">Registration</li>
      </ol>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/zepto.js')); ?>"> </script>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/icheck.js')); ?>"> </script>
  <?php $__env->stopSection(); ?>

  <?php $__env->startSection('content'); ?>
   <div class="row">
        <div style="margin-left: 20px; margin-bottom: 10px;">
               <a href="<?php echo e(url('/RegistrationList')); ?>" class="btn btn-primary btn-flat" ><span class='fa fa-arrow-left'></span>&nbspBack to Registration List</a>
        </div>

    <!--left table-->

        <div class = "col-md-6">
        <div class="box box-primary ">
        <div class="box-header with-border">
          <h3 class="box-title">Stall Holder Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
              <input type="checkbox" name="search">Search for Existing Record
                <input type="text" name="" class = "form-control" placeholder="Enter First Name / Last Name ..." disabled="" />
                <label for = "org">Name of Group/Organization<i><b>&nbsp&nbsp(If Applicable)</i></b></label>
                <input type = "text" class = "form-control" id = "orgname" name = "orgname" />

                <label for="firstName"><b>First Name</b></label><span class="required">&nbsp*</span>
                <input type="text" class="form-control" id="fname" name ="fname" placeholder="E.G. Jose Protacio" value ="<?php echo e($stallHolderDetails->stallHFName); ?>">

                <label for="middleName"><b>Middle Name</b></label>
                <input type="text" class="form-control" id="mname" name="mname" placeholder="E.G. Alonso Realonda" value ="<?php echo e($stallHolderDetails->stallHMName); ?>">

                <label for="lastname"><b>Last Name</b></label><span class="required">&nbsp*</span>
                <input type="text" class="form-control" id="lname" name="lname"  placeholder="E.G. Mercado Rizal" value ="<?php echo e($stallHolderDetails->stallHLName); ?>">

                <label for="sex"><b>Sex</b></label><span class="required">&nbsp*</span>
                <?php if($stallHolderDetails->stallHSex == 0): ?>
                
                  <label><input type="radio" name="sex" id = "sex0" value="0"  ><b>Male</b></label>
                  <label><input type="radio" name="sex" id = "sex0" value="0" checked ><b>Female</b></label>
                
                <?php else: ?>
                  <label><input type="radio" name="sex" id = "sex0" value="0" checked=""><b>Male</b></label>
                    <label><input type="radio" name="iCheck" id = "sex1" value="1"><b>Female</b></label>
                    
                <?php endif; ?>
                <div class="form-inline">
                <label for="bday"><b>Birthday</b></label><span class="required">&nbsp*</span>
                    
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

                        <label for = "age" style="margin-left: 20px;">Age</label>
                        <input type = "text" class = "form-control" id = "age" name = "age"  placeholder="" disabled="" style="width: 230px;" />
                    </div>
                    
                         
                    
                     
                    <label for = "email">Email Address</label><span class="required">&nbsp*</span>
                    <input type = "text" class = "form-control" id = "email" name = "email"  placeholder="email@domain.com" value = "<?php echo e($stallHolderDetails->stallHEmail); ?>"/>

                    <label for="phone"><b>Mobile Number</b></label><span class="required">&nbsp*</span>
                    <input type="text" class="form-control" id="mob" name="mob"  placeholder="09xxxxxxxxx">

                    <label for="address"><b>Home Address</b></label><span class="required">&nbsp*</span>
                    <textarea rows="4" class="form-control" id="address" name="address"><?php echo e($stallHolderDetails->stallHAddress); ?></textarea>

              </div>
                   
             
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
     
      </div>

    </div>
    <!--/right table-->
        <div class = "col-md-6">
        <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Stall Details</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                 <label>Stall Code</label>
                 <input type="text" class="form-control" disabled="" value ="<?php echo e($stallDetails->stallID); ?>" />
           
                 <label>Stall Rate</label>
                 <textarea type="text" class="form-control" disabled=""></textarea>
                           
              </div>

             
            </div>
            <!-- /.col-md-6 -->

            <div class="col-md-6">
                <div class="form-group">
                    <label>Stall Type</label>
                    <input type="text" class="form-control" disabled=""   value = " <?php echo e($stallDetails->stypeName); ?> (<?php echo e($stallDetails->stypeArea); ?> m&sup2) " />

                    <label>Location</label>
                    <textarea type="text" class="form-control" disabled=""  />Floor <?php echo e($stallDetails->floorLevel); ?>,<?php echo e($stallDetails->bldgName); ?> Building</textarea>

                </div>
                <div class="col-md-12">
                <div class="pull-right" style="margin-top: 30px; ">
                <button type = "button" class="btn btn-flat btn-primary" style="width: 100px;" onclick = "window.location= '<?php echo e((url('/StallList'))); ?>'">Edit</button>
                </div>
            </div>

            </div>
            <!--/.col-md-6 -->

            <div class="col-md-12">
                <label for="bussiname">Business Name</label>
                <input type="text" class="form-control" id="businessName" name ="businessName" value = "<?php echo e($stallrental->businessName); ?>"/>
            </div>

            <div class="col-md-12">
                <label for="startdate">Starting Date </label><span class="required">&nbsp*</span>
                <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                <input type="text" class="form-control pull-right" id="datepicker">
                </div>
            </div>

            <div class="col-md-12">
                <label class="checkbox-inline">
                <input type="checkbox" id="check_assoc"><b>Associate Stall Holder(s)</b> <small>(Maximum of 2 people)</small></label>
            </div>

            <div id = "assoc_hold">
            <div class="col-md-6">
                <label for="assoc1"><b>Associate 1</b></label>
                <input type="text" class="form-control" placeholder="Full Name" id="assoc_one" name ="assoc_one"> 
            </div>

            <div class="col-md-6">
                <label for="assoc2"><b>Associate 2</b></label>
                <input type="text" class="form-control" / placeholder="Full Name" id="assoc_two" name ="assoc_two"> 
            </div>
            </div>

            <div class="col-md-12">
                <label for="address"><b>List of Products</b></label><span class="required">&nbsp*</span>
                <textarea rows="4" class="form-control" id="prods" name="prods"></textarea>
            </div>

            <p class="small text-danger" style="margin-left: 20px;">Fields with asterisks(*) are required</p>

            <div class="col-md-12">
                <div class="pull-right" style="margin-top: 30px; ">
                <button type = "submit" class="btn btn-flat btn-primary" style="width: 100px;">Save</button>
                </div>
            </div>

          </div>
          <!-- /.row -->
        </div>
     
      </div>

    </div>



  </div>
<!-- /.row -->

 <?php $__env->stopSection(); ?>
  <?php $__env->startSection('script'); ?>
<script type="text/javascript">
      $(document).ready(function(){
        //POPULATE YEAR DROPDOWN FOR BIRTHDAY///
        var select = $('#DOBYear');
        var leastYr = 1960;
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

      //DISPLAY AGE//
      $('#DOBYear').on('change',function(){
        var day = $('#DOBDay').val();
        var month = $('#DOBMonth').val();
        var year = $('#DOBYear').val();
        var today = new Date();
        var birthday = new Date(year,month,day);
        var age = today.getFullYear() - birthday.getFullYear();
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
        ,format: 'mm-dd-yyyy'
       });
      //BIRTHDAY SELECTED//
      var bday = <?php echo json_encode($stallHolderDetails->toArray(), JSON_HEX_TAG); ?>;
          $splitDate = bday["stallHBday"].split("-");
          $('#DOBYear').val($splitDate[0]).attr('selected', true).siblings('option').removeAttr('selected');
          $('#DOBMonth').val($splitDate[1]).attr('selected', true).siblings('option').removeAttr('selected');
          $('#DOBDay').val($splitDate[2]).attr('selected', true).siblings('option').removeAttr('selected');  

        var day = $('#DOBDay').val();
        var month = $('#DOBMonth').val();
        var year = $('#DOBYear').val();
        var today = new Date();
        var birthday = new Date(year,month,day);
        var age = today.getFullYear() - birthday.getFullYear();
        $('#age').val(age);  
      });
</script>
  <?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>