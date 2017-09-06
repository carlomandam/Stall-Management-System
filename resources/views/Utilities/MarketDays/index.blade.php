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
    <li class="active">Market Days</li>
</ol> 
  @stop

  @section('content')
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities - Market Days</b></h3>
            </div>
          
          <div class = "box-body">

            <div class = "col-md-12">
              <div class="callout callout-info">
                  <h4>Info</h4>
                   <p>Market Days determine the days the business were open.</p>
                   <p>This utility will affect the stall rates maintenance in declaring the stall rates.</p>
                   <p>Paki checkan kung bukas ba ung business ng gantong araw.</p>
              </div>
            </div>

            <div class="col-md-6">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Market Days</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[0]" name="day" value="sun" disabled>
                            </td>
                            <td><b>Sunday</b></td>
                        </tr>
                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[1]" name="day" value="mon" disabled >
                            </td>
                            <td><b>Monday</b></td>
                        </tr>
                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[2]" name="day" value="tue" disabled >
                            </td>
                            <td><b>Tuesday</b></td>
                        </tr>
                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[3]" name="day"  value="wed"disabled >
                            </td>
                            <td><b>Wednesday</b></td>
                        </tr>
                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[4]" name="day"  value="thur"disabled>
                            </td>
                            <td><b>Thursday</b></td>
                        </tr>
                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[5]" name="day"  value="fri"disabled >
                            </td>
                            <td><b>Friday</b></td>
                        </tr>
                        <tr>
                            <td>
                              <input type="checkbox" id="mDays[6]" name="day" value="sat"disabled >
                            </td>
                            <td><b>Saturday</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-info" id="edit">Edit</button>
          <button id="save"  class = "btn btn-flat btn-primary" data-id='1' disabled>Save Changes</button>
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
$(document).ready(function() {
    $('tr').click(function(event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });
});

$(document).on('click','#edit', function(){
  document.getElementById('mDays[0]').disabled = false;
  document.getElementById('mDays[1]').disabled = false;
  document.getElementById('mDays[2]').disabled = false;
  document.getElementById('mDays[3]').disabled = false;
  document.getElementById('mDays[4]').disabled = false;
  document.getElementById('mDays[5]').disabled = false;
  document.getElementById('mDays[6]').disabled = false;
  document.getElementById('save').disabled = false;
});
$(document).on('click','#save',function(){
  id = $(this).attr('data-id');
  console.log(id);
  var days = [];  
  for (var i = 0; i < 7; i++) {
      $("input[name='day']:checked").each(function (i) {
                days[i] = $(this).val();
      });
  }
  marketDays = days.toString();
  
  console.log(marketDays);
  $.ajax({
      type: "PUT",
      url: "/MarketDays/"+id,
      data: { 
        '_token' : $('input[name=_token]').val(),
        'days': marketDays,
      },
      success: function(data) {
        if($.isEmptyObject(data.error)){
          toastr.success('Market Days Updated');
                location.reload();
                
                }
                else{
                  toastr.error(data.error);
                }
        }


     });
});
//Pagkuha ng Array sa Controller
var marketD = [];//variable ng market days
 @foreach($utils as $util)
      @foreach(explode(',', $util->utilitiesDesc) as $days)
       marketD.push('{{$days}}');
      @endforeach                
  @endforeach
  // console.log(marketD.length);
  var  tempdays = [];
  for (var i = 0; i < 7; i++) {
      $("input[name='day']").each(function (i) {
                tempdays[i] = $(this).val();

      });
  }
  for (var i = 0; i < 7; i++) {
          for (var j = 0; j < marketD.length+1; j++) {
              if(tempdays[i]==marketD[j]){
                  if(i==0){
                      document.getElementById('mDays[0]').checked = true;
                  }
                  else if(i==1){
                    document.getElementById('mDays[1]').checked = true;
                  }
                  else if(i==2){
                    document.getElementById('mDays[2]').checked = true;
                  }
                  else if(i==3){
                    document.getElementById('mDays[3]').checked = true;
                  }
                  else if(i==4){
                    document.getElementById('mDays[4]').checked = true;
                  }
                  else if(i==5){
                    document.getElementById('mDays[5]').checked = true;
                  }
                  else if(i==6){
                    document.getElementById('mDays[6]').checked = true;
                  }
              }
          }
  }
</script>


@stop 