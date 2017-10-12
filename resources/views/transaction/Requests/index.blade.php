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
                                <a href="{{ url('/Requests/create') }}">
                                  <button class="btn btn-primary  pull-left"><span class='glyphicon glyphicon-plus'></span>&nbspNew Request
                                  </button>
                                </a>
                                 
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
                                                   @foreach($reqs as $key => $req)
                                                   <tr>
                                                      <td>{{++$key}}</td>
                                                      <td>{{$req->stallHFName}} {{$req->stallHMName}} {{$req->stallHLName}}</td>
                                                      @if($req->requestType==1)
                                                      <td>Transfer Stall</td>
                                                      @elseif($req->requestType ==2)
                                                      <td>Leave Stall</td>
                                                      @endif
                                                      @if($req->status == 0)
                                                      <td>Pending</td>
                                                      @elseif($req->status == 1)
                                                      <td>Approved</td>
                                                      @elseif($req->status == 2)
                                                      <td>Not Approved</td>
                                                      @endif
                                                    
                                                     <td>{{\Carbon\Carbon::parse($req->submitDate)->format('F d, Y')}}
                                                     </td>
                                                     @if($req->status == 1)
                                                     <td>{{\Carbon\Carbon::parse($req->approvedDate)->format('F d, Y')}}</td>
                                                     @else
                                                     <td> </td>
                                                     @endif   
                                                        
                                                      @if($req->status == 0)
                                                      <td>
                                                        <button class="btn btn-info" id="view" data-id="{{$req->requestID}}">View</button>
                                                        <button class="btn btn-primary" data-id="{{$req->requestID}}">Update</button>
                                                      </td>
                                                      @elseif($req->status == 1)
                                                      <td>
                                                        <button class="btn-info" id="view" data-id="{{$req->requestID}}">View</button>
                                                      </td>
                                                      @elseif($req->status == 2)
                                                      <td>
                                                        <button class="btn-info" id="view" data-id="{{$req->requestID}}">View</button>
                                                      </td>
                                                      @endif
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

@stop
@section('script')
<script type="text/javascript" src ="js/request.js"></script>

@stop