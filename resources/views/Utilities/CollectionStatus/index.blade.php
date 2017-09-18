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
              <table class="table table-strippedr">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Range From:</th>
                      <th>Range To:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="bg-primary">
                      <td>Collect</td>
                      <td><input type="text" name="collectFrom" class="form-control collectTo" value="0.00" readonly></td>
                      <td> <input type="text" name="" class="form-control collectFrom" id="collect" disabled></td>
                    </tr>
                    <tr style="background-color: green;">
                      <td style="color: white;">Reminder</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="reminder" disabled></td>
                    </tr>
                    <tr style="background-color: yellow;">
                      <td>Warning</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="warning" disabled></td>
                    </tr>
                    <tr style="background-color: orange;">
                      <td style="color: white;">Lock</td>
                      <td><input type="text" name="" class="form-control" readonly></td>
                      <td> <input type="text" name="" class="form-control" id="lock" disabled></td>
                    </tr>
                    <tr style="background-color: red;">
                      <td style="color: white;">Terminate</td>
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
<script type="text/javascript" src ="{{ URL::asset('js/jquery.inputmask.bundle.js') }}"></script>

<script type="text/javascript">
  $(document).on('click', '#edit', function(){
    document.getElementById('collect').disabled=false;
    document.getElementById('save').disabled =false;
  })

   $(".collectTo").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php '
  });
   $(".collectFrom").inputmask('currency', {
    rightAlign: true,
    prefix: 'Php '
  });

</script>
@stop 