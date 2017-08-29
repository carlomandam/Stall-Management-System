@extends('layout.app')

@section('title')
{{'Request'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Manage Request</li>
  <li class="active">Request List</li>
</ol>
@stop

@section('content')
<div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                              <h4 class="box-title">Requests List</h4>
                        </div>
                        <div>
                              <div class="box-body">
                                   <button type="submit" class="btn btn-primary  pull-left" onclick = "window.location='{{ url('/requestList/create') }}'"><span class='glyphicon glyphicon-plus'></span>&nbspNew Request
                                    </button>
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 
                                           <table id="requestList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No.</th>
                                                    <th>Stall Holder</th>
                                                    <th>Request Type</th>
                                                    <th>Status</th>
                                                    <th>Date Submited</th>
                                                    <th>Date Approved</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($reqs as $req)
                                                    <tr>
                                                        <td>{{$req->requestID}}</td>
                                                         <td>{{$req->Rental->StallHolder->stallHFName}}
                                                         {{$req->Rental->StallHolder->stallHMName}}
                                                         {{$req->Rental->StallHolder->stallHLName}}
                                                         </td>
                                                        @if(($req->requestType)==1)
                                                        <td>Transfer Stall</td>
                                                        @elseif(($req->requestType)==2)
                                                        <td>Cancel Contract</td>
                                                        @elseif(($req->requestType)==3)
                                                        <td>Others</td>
                                                        @endif

                                                        @if(($req->status)==0)
                                                          <td>Pending</td>
                                                        @elseif (($req->status)==1)
                                                          <td>Approved</td> 
                                                        @elseif (($req->status)==2) 
                                                          <td>Reject</td>
                                                        @endif
                                                       <td>
                                                            {{$req->created_at}}
                                                          </td>
                                                          <td>
                                                            {{$req->approvedDate}}
                                                          </td>
                                                          <td>
                                                          @if(($req->status)==0)
                                                          <button class='btn btn-primary btn-flat' id="updateModal" data-id="{{$req->requestID}}"><span class='glyphicon glyphicon-pencil'></span> Update</button>
                                                          @elseif (($req->status)==1)
                                                          <button class='btn btn-info btn-flat' id="viewModal" data-id="{{$req->requestID}}"><span class='glyphicon glyphicon-eye-open'></span> VIEW</button>
                                                          @elseif (($req->status)==2)
                                                          <button class='btn btn-info btn-flat' id="viewModal" data-id="{{$req->requestID}}"><span class='glyphicon glyphicon-eye-open'></span> VIEW</button> 
                                                          @endif
                                                            <div class='btn-group'>
                                                              <button type='button' class='btn btn-danger btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-trash'></span> Deactivate</button></button>
                                                              <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                                                <center>
                                                                  <h4>Are You Sure?</h4>
                                                                  <li class='divider'></li>
                                                                  <li><a href='#'>YES</a></li>
                                                                  <li><a href='#'>NO</a></li>
                                                                </center>
                                                              </ul>
                                                            </div>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            
                                            </table>
                                          </div>
                                    </div>  
                              </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="update" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form class="building" action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Request</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                              
                            <div class="col-md-12">
                                    <form>
                                         <div class="col-md-12">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request No.</label>
                                            </div>
                                            <div class="col-md-2">
                                              <input type="text" class="form-control" disabled id="uRequestID" name="dID">
                                              <input type="text" name="rentalID" id="rental" hidden=""> 
                                            </div>          
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group" >
                                            <div class="col-md-2">
                                              <label>Request Status</label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control" name="" readonly id="uStatus">
                                            </div>          
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Stall Holder:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <input type="text" class="form-control" name="" readonly id="uStallHolder">
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Type:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="" readonly id="uType">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="typeTransfer">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requested Stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <label>From:</label>
                                               <input type="text" id="from" readonly class="form-control">
                                               <label>To:</label>
                                               <input type="text" id="to" readonly class="form-control">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="typeCancel">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requested Stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <label>Stall Cancel:</label>
                                               <input type="text" id="cancel" readonly class="form-control">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="typeOther">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requested Stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <label>Stall:</label>
                                               <input type="text" id="other" readonly class="form-control">
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Description:</label>
                                            </div>
                                            <div class="col-md-6">
                                             <textarea class="form-control" id="uDesc" readonly></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Status</label>
                                            </div>
                                            <div class="col-md-4">
                                               <select class="form-control" style="width: 100%;" name="updateStatus" id="udStatus" > 
                                                     
                                                      <option value="0">Pending</option>
                                                      <option value="1">Approved</option>
                                                      <option value="2">Reject</option>
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Remarks:</label>
                                            </div>
                                            <div class="col-md-6">
                                              <textarea class="form-control" name="newRemarks"></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                                <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="pull-right">
                                                <button class="btn btn-primary" id="save"><i class="fa fa-save"></i> Save</button>
                                                 <button class="btn btn-danger"><a href="">Cancel</a> </button>
                                            </div>
                                        </div>
                                
                            </div>
                    
                </div>

        </form>
    </div>
</div>
<div class="modal fade" id="view" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form class="building" action="" method="" id="">
            <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">View Request</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                              
                            <div class="col-md-12">
                                    <form>
                                         <div class="col-md-12">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request No.</label>
                                            </div>
                                            <div class="col-md-2">
                                              <input type="text" class="form-control" disabled id="vRequestID" name="dID"> 
                                            </div>          
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group" >
                                            <div class="col-md-2">
                                              <label>Request Status</label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control" name="" readonly id="vStatus">
                                            </div>          
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Stall Holder:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <input type="text" class="form-control" name="" readonly id="vStallHolder">
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Type:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="" readonly id="vType">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="vtypeTransfer">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requested Stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <label>From:</label>
                                               <input type="text" id="vfrom" readonly class="form-control">
                                               <label>To:</label>
                                               <input type="text" id="vto" readonly class="form-control">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="vtypeCancel">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requested Stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <label>Stall Cancel:</label>
                                               <input type="text" id="vcancel" readonly class="form-control">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px; display: none;" id="vtypeOther">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Requested Stall:</label>
                                            </div>
                                            <div class="col-md-4">
                                               <label>Stall:</label>
                                               <input type="text" id="vother" readonly class="form-control">
                                            </div>
                                          </div>
                                        </div>
                                         <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Request Description:</label>
                                            </div>
                                            <div class="col-md-6">
                                             <textarea class="form-control" id="vDesc" readonly></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Status</label>
                                            </div>
                                            <div class="col-md-4">
                                               <select class="form-control" style="width: 100%;" name="updateStatus" id="vdStatus" disabled > 
                                                     
                                                      <option value="0">Pending</option>
                                                      <option value="1">Approved</option>
                                                      <option value="2">Reject</option>
                                                  </select> 
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                          <div class="form-group">
                                            <div class="col-md-2">
                                              <label>Remarks:</label>
                                            </div>
                                            <div class="col-md-6">
                                              <textarea class="form-control" name="newRemarks" id="vremarks" readonly></textarea>
                                            </div>
                                          </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                                <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="pull-right">
                                                <button class="btn btn-primary" id="save"><i class="fa fa-save"></i> Save</button>
                                                 <button class="btn btn-danger"><a href="">Cancel</a> </button>
                                            </div>
                                        </div>
                                
                            </div>
                    
                </div>

        </form>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src ="js/request.js"></script>
@stop