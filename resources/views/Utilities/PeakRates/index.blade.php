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
    <li class="active">Peak Rates</li>
</ol> 
  @stop

  @section('content')
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities - Peak Rates</b></h3>
            </div>
          
          <div class = "box-body">

            <div class = "col-md-12">
              <div class="callout callout-info">
                  <h4>Info</h4>
                   <p>Peak Rates determined the addional rate could possible be added at stall rates.</p>
                   <p>This utility can affect the stall rates maintenance in declaring the stall rates.</p>
                   <p>Determine if the peak rate type is fixed, percentage or multiplier.</p>
                   <p>Fixed - input specified amount</p>
                   <p>Percentage - input the percentage of the normal stall rates</p>
                   <p>Multiplier - input the multiplier of stall rates</p>
              </div>
            </div>

            <div class="col-md-5">
            @foreach($utils as $util)
                <div class="row">
                  <div class="col-md-3">
                     <label>Peak Type</label> 
                  </div>
                  <div class="col-md-8">
                    
                      @if($util->peakType==0)
                      <select class="form-control" disabled id="ptype" name="peakType">
                      <option value="0" selected>Fixed</option>
                      <option value="1">Percatage</option>
                      <option value="2">Multiplier</option>
                    </select>
                    @elseif($util->peakType==1)
                    <select class="form-control" disabled id="ptype" name="peakType">
                      <option value="0">Fixed</option>
                      <option value="1" selected>Percatage</option>
                      <option value="2">Multiplier</option>
                    </select>
                    @elseif($util->peakType==2)
                    <select class="form-control" disabled id="ptype" name="peakType">
                      <option value="0">Fixed</option>
                      <option value="1">Percatage</option>
                      <option value="2" selected>Multiplier</option>
                    </select>
                   @endif
                    
                  </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                      <label>Rate</label>
                    </div>
                    <div class="col-md-5">
                      <input type="text" name="rate" class="form-control" value="{{$util->peakQuan}}" onkeypress="validate(event)" disabled id="rate">
                    </div>
                </div>
                 @endforeach
            </div>
          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-info" id="edit">Edit</button>
          <button id="save"  class = "btn btn-flat btn-primary" data-id='2' disabled>Save Changes</button>
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
  $(document).on('click','#edit', function(){
    document.getElementById('ptype').disabled=false;
    document.getElementById('rate').disabled=false;
    document.getElementById('save').disabled=false;
  })

  $(document).on('click','#save',function(){
  id = $(this).attr('data-id');
  console.log(id);
  var peakType = $("select[name='peakType']").val();
  var rate = $("input[name='rate']").val();

  
  console.log(peakType);
  console.log(rate);
  $.ajax({
      type: "PUT",
      url: "/PeakRates/"+id,
      data: { 
        '_token' : $('input[name=_token]').val(),
        'peakType': peakType,
        'rate': rate,
      },
      success: function(data) {
        if($.isEmptyObject(data.error)){
          toastr.success('Peak Days Updated');
                location.reload();
                
                }
                else{
                  toastr.error(data.error);
                }
        }


     });
});
  function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
@stop 