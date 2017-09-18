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
                        <input type="text" name="sec_amount" class="form-control" id="secAmount" disabled>
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

<script type="text/javascript">
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
    var sec_amount = $("input[name='sec_amount']").val();
    var main_amount = $("input[name='main_amount']").val();
  
    
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
  $('#secDate').val('{{$util->secDate}}');

  $('#mainAmount').val('{{$util->mainAmount}}');
 
@endforeach
</script>
@stop 