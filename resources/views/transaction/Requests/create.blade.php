@extends('layout.app')
@section('title')
{{ 'New Request'}}
@stop
@section('content-header')
<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Manage Requests</li>
  <li class="active">New Request</li>
</ol>
@stop
@section('content')

<style>
  #floortbl td{
   padding-bottom:5px;
 }
 #floortbl th, #floortbl td{
  text-align: center;
}
</style>
<div class="box box-solid box-default">
      <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                      <div class="box-header with-border">
                            <label>Create Request</label>
                      </div>
                      <div>
                          <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form>
                                         <div class="col-md-12">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requet No.</label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control" disabled=""> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Stall Holder:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control" style="width: 100%;" id="stallHolder">
                                                      <option disabled selected="selected">--Select--</option>
                                                     
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Type:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-control requestType" style="width: 100%;">
                                                      <option disabled selected="selected">--Select--</option>
                                                      <option value="1">Transfer Request</option>
                                                      <option value="2">Cancel Contract</option>
                                                      <option value="3">Others</option>
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="typeTransfer">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Select stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>From:</th>
                                                        <th>To:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                          <td>Stall 1</td>
                                                          <td>
                                                          <select class="form-control" style="width: 100%;" id="stallTo">
                                                              <option disabled selected="selected">--Select--</option>

                                                            </select> 
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td>Stall 1</td>
                                                          <td>
                                                          <select class="form-control" style="width: 100%;" id="stallTo">
                                                              <option disabled selected="selected">--Select--</option>

                                                            </select> 
                                                          </td>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px; display: none;" id="typeCancel">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Select stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th></th>
                                                        <th>Stall Code:</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                          <td>
                                                            <input type="checkbox" name="">
                                                          </td>
                                                          <td>
                                                            Stall A001
                                                          </td>
                                                        </tr>
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Description:</label>
                                            </div>
                                            <div class="col-md-6">
                                              <input type="textarea" class="form-control" style="height: 200px;">
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="pull-right">
                                                <button class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                 <button class="btn btn-danger"><a href="/requestList">Cancel</a> </button>
                                            </div>
                                        </div>

                                    </form>
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
<script src ="{{ URL::asset('assets/select2/select2.js')}}"></script>
<script type="text/javascript">
  $("#stallHolder").select2();
  $("#stallTo").select2();
  


</script>

@stop