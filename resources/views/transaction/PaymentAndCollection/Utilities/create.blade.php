@extends('layout.app')

@section('title')
{{'Payment and Collection'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Utilites</li>
</ol>
@stop

@section('content')
<div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                             
                        </div>
                        <div>
                              <div class="box-body">

                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Utility Type</label>
                                      </div>

                                      <div class="col-md-2">
                                         <select class="form-control" id="utilityType">
                                            <option selected disabled>------</option>
                                            <option value="1">Electricty</option>
                                            <option value="2">Water</option>
                                         </select>
                                      </div>
                                  </div>

                                     <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Date From:</label>
                                      </div>

                                      <div class="col-md-2">
                                         <input type="text" class="form-control datepicker" name="">
                                      </div>

                                      <div class="col-md-1">
                                          <label>Date To:</label>
                                      </div>

                                      <div class="col-md-2">
                                         <input type="text" class="form-control datepicker" name="">
                                      </div>
                                  </div> 

                                     <div class="row" style="margin-top: 15px;">
                                      <div class="col-md-8" style="text-align: center; font-size: 20px;">
                                          <label>Total Bill</label>
                                      </div>
                                  </div>

                                   <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Previos Reading</label>
                                      </div>
                                      <div class="col-md-2">
                                        <input type="text" class="form-control" name="">
                                      </div>

                                       <div class="col-md-2">
                                          <label>Present Reading</label>
                                      </div>
                                      <div class="col-md-2">
                                        <input type="text" class="form-control" name="">
                                      </div>
                                  </div>

                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-2">
                                          <label>Total Bill Amount:</label>
                                      </div>
                                      <div class="col-md-2">
                                          <input type="text" class="form-control" name="">
                                      </div>

                                       <div class="col-md-2">
                                          <label>Kwh/Cubic Meter:</label>
                                      </div>
                                      <div class="col-md-2">
                                          <input type="text" class="form-control" name="" disabled>
                                      </div>
                                  </div>

                                  <div class="row">
                                       <div class="col-md-8" style="margin-top: 20px;">
                                      <table class="table table-bordered">
                                          <thead>
                                              <tr>
                                                  <th>Stall Code</th>
                                                  <th>Previous Reading</th>
                                                  <th>Present Reading</th>
                                                  <th>Total Amount</th>
                                              </tr>
                                          </thead>
                                          <tbody class="stallList">
                                              
                                          </tbody>
                                      </table>
                                  </div>
                                  </div>

                                  <div class="row" style="margin-top: 20px;">
                                      <div class="col-md-4">
                                          <button class="btn btn-primary">Save</button>
                                          <a href="{{url('/Utilities')}}"><button class="btn btn-danger">Cancel</button></a>
                                      </div>
                                  </div>


                              </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/utility.js') }}"></script>
<script type="text/javascript" src ="{{ URL::asset('js/jquery.inputmask.bundle.js') }}"></script>
<script type="text/javascript">
  
 $(".collectTo").inputmask('currency', {
  rightAlign: true,
  prefix: 'Php ',
});

 $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      startDate: new Date(),
      todayHighlight:true

    });
</script>
@stop