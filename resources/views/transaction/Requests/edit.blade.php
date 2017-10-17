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
  <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                        </div>
                        <div>
                              <div class="box-body">
                                   @foreach($req as $r)
                                  <div class="row">
                                      <div class="col-md-2">
                                        <label>Request Type</label>
                                      </div>
                                     
                                      <div class="col-md-2">
                                        @if($r->Type==1)
                                        Transafer Stall
                                       @elseif($r->Type==2)
                                       Leave Stall
                                       @elseif($r->Type==3)
                                       Other/s
                                       @endif
                                      </div>
                                    
                                  </div>
                                      <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                              <label>Status:</label>
                                          </div>
                                          <div  class="col-md-2">
                                            <select class="form-control" name="status">
                                              <option selected disabled>Pending</option>
                                              <option class="alert-success" value="1">Approved</option>
                                              <option class="alert-danger" value="2">Reject</option>
                                            </select>
                                          </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                              <label>Name:</label>
                                          </div>
                                          <div  class="col-md-3">
                                            {{$r->First}} {{$r->Middle}} {{$r->Last}}   
                                          </div>
                                      </div>
                                         @if($r->Type==1)
                                         <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                            <label>Stall:</label>
                                          </div>
                                          <div  class="col-md-4">

                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Current Stall</th>
                                                  <th>Desired Stall</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($info as $i)
                                                <tr>
                                                  <td>{{$i->stallFrom}}</td>
                                                  <td>{{$i->stallRequested}}</td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                              
                                            </table>
                                          </div>
                                        </div>
                                         @elseif($r->Type==2)
                                         <div class="row" style="margin-top: 10px;">
                                          <div class="col-md-2">
                                            <label>Stall:</label>
                                          </div>
                                          <div  class="col-md-4">

                                            <table class="table table-bordered">
                                              <thead>
                                                <tr>
                                                  
                                                  <th>Desired Stall</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($info as $i)
                                                <tr>
                                                  <td>{{$i->stallFrom}}</td>
                                                </tr>
                                                @endforeach
                                              </tbody>
                                              
                                            </table>
                                          </div>
                                        </div>
                                       @elseif($r->Type==3)
                                            <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Subject:</label>
                                        </div>
                                        <div  class="col-md-4">
                                         {{$r->subject}}
                                        </div>
                                      </div>
                                       @endif 
                                      
                                          <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Desired Date:</label>
                                        </div>
                                        <div  class="col-md-2">
                                          <input type="text" name="desiredTS" value="{{$r->desired}}" readonly>
                                        </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Reason:</label>
                                        </div>
                                        <div  class="col-md-4">
                                          <textarea class="form-control" name="transferReasonTS" rows="5" readonly>{{$r->reason}} </textarea>
                                        </div>
                                      </div>

                                      <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                          <label>Remarks:</label>
                                        </div>
                                        <div  class="col-md-4">
                                          <textarea class="form-control" name="remarks" rows="5"></textarea>
                                        </div>
                                      </div>

                                       <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                          @if(Auth::user()->position == "Admin")

                                          <a href="/Requests"><button class="btn btn-primary" id>BACK</button>

                                            <button class="btn btn-success" data-id="{{$r->ID}}" id="update">Update</button>
                                          </a>
                                          @elseif(Auth::user()->position == "Employee")
                                               <a href="/Requests"><button class="btn btn-primary" id>BACK</button>
                                           @endif                                     
                                        </div>
                                       
                                      </div>

                                  


                                    @endforeach
                            </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script')
 <script type="text/javascript" src="{{ URL::asset('js/request.js') }}"></script>
<script type="text/javascript">

</script>
@stop