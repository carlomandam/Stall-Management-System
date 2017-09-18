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
    <li class="active">Collection Status</li>
</ol> 
  @stop

  @section('content')
 
   <div class="row">
    <!--left table-->

        <div class = "col-md-12">
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Utilities - Colletion Status</b></h3>
            </div>
          
          <div class = "box-body">

            <div class = "col-md-12">
              <div class="callout callout-info">
                  <h4>Info</h4>
                   
              </div>
            </div>

            <div class="col-md-8">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Range From:</th>
                      <th>Range To:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="primary">
                      <td>Collect</td>
                      <td><input type="text" name="collectFrom" class="form-control" value="0.00" readonly></td>
                      <td> <input type="text" name="collectTo" class="form-control" id="collect" disabled></td>
                    </tr>
                    <tr class="success">
                      <td>Reminder</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="reminder" disabled></td>
                    </tr>
                    <tr class="warning">
                      <td>Warning</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="warning" disabled></td>
                    </tr>
                    <tr class="">
                      <td>Lock</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="lock" disabled></td>
                    </tr>
                    <tr class="danger">
                      <td>Terminate</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="terminate" disabled></td>
                    </tr>
                  </tbody>
              </table>
            </div>

            
          </div>
        <div class = "box-footer">
        <div class = "pull-right" style="margin-right: 20px;">
          <button class = "btn btn-flat btn-info" id="edit">Edit</button>
          <button id="save"  class = "btn btn-flat btn-primary" data-id='util_market_days' disabled>Save Changes</button>
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
  $(document).on('click', '#edit', function(){
    document.getElementById('collect').disabled=false;
    document.getElementById('save').disabled =false;
  })
  var collectFrom = $("input[name='collectFrom']").val();
  var collectTo = $("input[name='collectTo']").val();
 
 
  $(document).on('change','#collect', function(){
   
   
  })
  $(document).on('click','#save', function(){
     console.log(collectTo);
      
  })
</script>
@stop 