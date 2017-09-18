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
                      <th>Frequency</th>
                    </tr>
                  </thead>
                  <tbody>
                 
                    <tr>
                      <td>Security Deposit</td>
                      <td>
                        <input type="text" name="sec_amount" class="form-control" id="secAmount"  pattern='^\d+(?:\.\d{0,2})$' disabled>
                      </td>
                      <td>
                        One Time
                      </td>
                    </tr>
                       <tr>
                      <td>Maintenance Fee</td>
                      <td>
                        <input type="text" name="main_amount" class="form-control" id="mainAmount" disabled>
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
    $("#secAmount").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php '
  });
  $("#mainAmount").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php '
  });
   $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
    });

  $(document).on('click', '#edit', function(){
    document.getElementById('secAmount').disabled= false;
    document.getElementById('mainAmount').disabled= false;
    document.getElementById('save').disabled =false;
  })
  $(document).on('change', '#secFreq', function(){
    freq = $('#secFreq').val();
    if(freq==0){
       document.getElementById('secAmount').disabled= true;
      document.getElementById('secDate').disabled= true;
    }
    else{
      document.getElementById('secAmount').disabled= false;
      document.getElementById('secDate').disabled= false;
    }
  })

    $(document).on('change', '#mainFreq', function(){
    freq = $('#mainFreq').val();
    if(freq==0){
       document.getElementById('mainAmount').disabled= true;
      document.getElementById('mainDate').disabled= true;
    }
    else{
      document.getElementById('mainAmount').disabled= false;
      document.getElementById('mainDate').disabled= false;
    }
  })

  $(document).on('click','#save', function(){
    id= $(this).attr('data-id');
    console.log(id);
    var _token = $("input[name='_token']").val();
    var tempSec_amount = $("input[name='sec_amount']").val();
    var tempMain_amount = $("input[name='main_amount']").val();
    secValid = tempSec_amount.replace("Php ", "");
    sec_amount = secValid.replace(",", "");

    mainValid = tempMain_amount.replace("Php ", "");
    main_amount = mainValid.replace(",", "");
    
    
     $.ajax({
      type: "PUT",
      url: "/InitialFee/"+id,
      data: { 
        '_token' : $('input[name=_token]').val(),
        'sec_amount': sec_amount,
        'main_amount': main_amount,
       
      },
      success: function(data) {
        if($.isEmptyObject(data.error)){
          toastr.success('Initial Fee Updated');
                location.reload();
                
                }
                else{
                  toastr.error(data.error);
                }
        }


     }); 

  })

 @foreach($utils as $util)          
  $('#secAmount').val('{{$util->secAmount}}');
  $('#mainAmount').val('{{$util->mainAmount}}');
 
@endforeach


</script>
@stop 