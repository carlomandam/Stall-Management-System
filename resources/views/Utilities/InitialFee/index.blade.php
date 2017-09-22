@extends('layout.app')
@section('title')
{{ 'Utilities'}}
@stop
@section('content-header')
<style>
.col-md-12, .col-md-10 {  
   
   margin-top: 10px;
}
.col-md-12 column form {
   display:inline-block;
}

.btn{
  width: 120px;
}

</style>
 <ol class="breadcrumb">
    <li><i class="fa fa-cogs"></i>Utilities</li>
    <li class="active">Initial Fee</li>
</ol> 
  @stop

  @section('content')
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities - Initial Fee</b></h3>
            </div>
          
          <div class = "box-body">
            
            <div class = "col-md-12">
              <div class="callout callout-info">
                  <h4>Info</h4>
                   
              </div>
            </div>

            <div class="col-md-10">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Effectivity Date</th> 
                      <th>Frequency</th>

                    </tr>
                  </thead>
                  <tbody>
                 
                    <tr>
                   
                      <td>Security Deposit</td>
                      <td>
                        <input type="text" name="secAmount" class="form-control money" id="sec_amount"    disabled>
                      </td>
                      <td>
                         <input type="text" name="secDate" class="form-control datepicker"  id="sec_date"  disabled>
                      </td>
                      <td>
                        One Time
                      </td>
                      
                    </tr>
                       <tr>
                      <td>Maintenance Fee</td>
                      <td>
                        <input type="text" name="mainAmount" class="form-control money" id="main_amount" disabled>
                      </td>
                       <td>
                         <input type="text" name="mainDate" class="form-control datepicker" id="main_date" disabled>
                      </td>
                   
                      <td>
                        Yearly
                      </td>
                    </tr>
                  
                  </tbody>
              </table>
            </div>

            
          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-info" id="edit">Edit</button>
          <button id="save"  class = "btn btn-flat btn-primary" data-id='util_initial_fee' disabled>Save Changes</button>
        </div>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Description</th>
                      <th>Recently Amount</th>
                      <th>Date Changed</th>
                      
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    @foreach($oldSecurity as $security)
                    <td>
                      Security  Deposit
                    </td>
                    <td>
                     
                      <input type="text" name="recSecAmount" id="rec_secAmount" class="form-control money" value="{{$security->initAmt}}" readonly>
                      
                    </td>
                    <td>
                     
                      <input type="text" name="recSecDate" id="rec_secDate" class="form-control"  disabled>
                      
                    </td>
                     @endforeach
                  </tr>
                 
                  <tr>
                    @foreach($oldMain as $main)
                    <td>
                      Maintenance Fee
                    </td>
                    <td>
                      <input type="text" name="recMainAmount" id="rec_mainAmount" class="form-control money" readonly value="{{$main->initAmt}}">
                    </td>
                    <td>
                      <input type="text" name="recMainDate" id="rec_mainDate" class="form-control" disabled="">
                    </td>
                    @endforeach
                  </tr>
              </tbody>
          </table>
        </div>
        </div>
        </div>
        <!--box primary-->
  </div>

<!-- /.row -->

@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/jquery.inputmask.bundle.js') }}"></script>
<!-- <script type="text/javascript" src ="{{ URL::asset('js/jquery.inputmask.numeric.extensions.js') }}"></script>
<script type="text/javascript" src ="{{ URL::asset('js/jquery.inputmask.extensions.js') }}"></script> -->
<script type="text/javascript">
   $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      startDate: new Date(),
      todayHighlight:true

    });
  $(".money").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php '
  });
  $(document).on('click', '#edit', function(){
    document.getElementById('sec_amount').disabled= false;
    document.getElementById('main_amount').disabled= false;
    document.getElementById('save').disabled =false;

  })
var secIsDisable='true';
var mainIsDisable ='true';
var newSecAmount;
var newMainAmount;

  $("#sec_amount").bind("change paste keydown keyup click", function() {
    tempAmount = ($(this).val()).replace("Php ", "",);
    temp2 = tempAmount.replace(",", "",);
    newAmount = Number(temp2);
    newSecAmount = newAmount;
    var oldAmount;

    <?php foreach ($newSecurity as $security): ?>
      <?php if ($newSecurity->first()== $security): ?>
        oldAmount = {{$security->initAmt}};
        oldSecAmount =oldAmount;
      <?php endif ?>
    <?php endforeach ?>
    if(oldAmount!= newAmount){
    document.getElementById('sec_date').disabled = false;
    secIsDisable = false;
   }
   else if(oldAmount = newAmount) {
    document.getElementById('sec_date').disabled = true;
    secIsDisable = true;
   }
});

$("#main_amount").bind("change paste keydown keyup click", function() {
    tempAmount = ($(this).val()).replace("Php ", "",);
    temp2 = tempAmount.replace(",", "",);
    newAmount = Number(temp2);
    newMainAmount = newAmount;
    var oldAmount;
    <?php foreach ($newMain as $main): ?>
       <?php if ($newMain->first()== $main): ?>
         oldAmount = {{$main->initAmt}};
         oldMainAmount = oldAmount;
      <?php endif ?>
    <?php endforeach ?>
     if(oldAmount!= newAmount){
    document.getElementById('main_date').disabled = false;
    mainIsDisable = false;

   }
   else {
    document.getElementById('main_date').disabled = true;
    mainIsDisable = true;
   } 
});  

<?php foreach ($newSecurity as $security): ?>
  <?php if ($newSecurity->first()== $security): ?>
    $('#sec_amount').val('{{$security->initAmt}}');
    $('#sec_date').val('{{ Carbon\Carbon::parse($security->initEffectiveDate)->format('m-d-Y ') }}');
    $('#rec_secDate').val('{{ Carbon\Carbon::parse($security->created_at)->format('m-d-Y ') }}');
  <?php endif ?>
<?php endforeach ?>

<?php foreach ($newMain as $main): ?>
  <?php if ($newMain->first()== $main): ?>
    $('#main_amount').val('{{$main->initAmt}}');
    $('#main_date').val('{{ Carbon\Carbon::parse($main->initEffectiveDate)->format('m-d-Y ') }}');
    $('#rec_mainDate').val('{{ Carbon\Carbon::parse($main->created_at)->format('m-d-Y ') }}');
  <?php endif ?>
<?php endforeach ?>

$(document).on('click','#save', function(e){
    e.preventDefault();
    var error=[];
  
    if( (secIsDisable == false) || (mainIsDisable == false)){

        if(secIsDisable == false){
            var secDate = $("input[name='secDate']").val();
            var secDesc = 'Security Deposit';
             $.ajax({
              type: "POST",
              url: "/InitialFee",
              data: { 
                '_token' : $('input[name=_token]').val(),
                'Amount': newSecAmount,
                'Date': secDate,
                'Desc': secDesc

              },
              success: function(data) {
                if($.isEmptyObject(data.error)){
                toastr.success('Security Deposit Updated');
               
        
                }
                else{
                  alert(data.error);
                  
                  
                }
              }

            });
            
        }

        if(mainIsDisable == false){
          var mainDate = $("input[name='mainDate']").val();
          var mainDesc = 'Maintenance Fee';
          var mainAmount = Math.abs(newMainAmount);
            
             $.ajax({
              type: "POST",
              url: "/InitialFee",
              data: { 
                '_token' : $('input[name=_token]').val(),
                'Amount': newMainAmount,
                'Date': mainDate,
                'Desc': mainDesc

              },
              success: function(data) {
                if($.isEmptyObject(data.error)){
                  toastr.success('Maintenance Fee Updated');
                  
                  

                }
                else{
                  alert(data.error);
                 
                }
              }

            });

        }
       
            location.reload();
    }

 


})






</script>
@stop 