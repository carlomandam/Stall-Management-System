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
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<div class="box box-solid box-default">
      <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                      <div class="box-header with-border">
                            <label>View Request Details</label>
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
                                             <div class="col-md-2">
                                              <label>Requet Status</label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control" name="" readonly>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Stall Holder:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <input type="text" class="form-control" name="" readonly>
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Type:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="" readonly>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;" id="typeTransfer">
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
                                                    </tbody>
                                                </table> 
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;" id="typeCancel">
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
                                            <div class="col-md-4">
                                             <textarea class="form-control"></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Status</label>
                                            </div>
                                           
                                            <div class="col-md-4">
                                              <input type="radio"  name="Status">
                                              <label>Approved</label>
                                              <input type="radio"  name="Status">
                                              <label>Disapproved</label>
                                              <input type="radio"  name="Status">
                                              <label>Pending</label>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Remarks:</label>
                                            </div>
                                            <div class="col-md-4">
                                              <textarea class="form-control"></textarea>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src ="{{ URL::asset('assets/select2/select2.js')}}"></script>
<script type="text/javascript">
  $("#stallHolder").select2();
  $("#stallTo").select2();
  


</script>

@stop