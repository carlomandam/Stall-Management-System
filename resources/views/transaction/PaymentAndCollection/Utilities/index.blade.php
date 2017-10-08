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
                              <h4 class="box-title">Monthly Reading List</h4>
                        </div>
                        <div>
                              <div class="box-body">
                                  <a href="{{url('/Utilities/create')}}">
                                     <button type="submit" class="btn btn-primary  pull-left" id="create"><span class='glyphicon glyphicon-plus'></span>&nbspNew Reading
                                    </button>
                                  </a>
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 
                                           <table id="monthlyList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No.</th>
                                                    <th>Utility Type</th>
                                                    <th>Date From:</th>
                                                    <th>Date To:</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($monthly as $key => $mon)
                                                      <tr>
                                                        <td>{{++ $key}}</td>
                                                        <td>
                                                          @if($mon->utilType==1)
                                                            Electricity
                                                          @elseif($mon->utilType==2)
                                                            Water
                                                          @endif
                                                        </td>
                                                        <td>{{\Carbon\Carbon::parse($mon->readingFrom)->format('F d, Y')}}</td>
                                                        <td>{{\Carbon\Carbon::parse($mon->readingTo)->format('F d, Y')}}</td>
                                                        <td>
                                                          <button class="btn btn-primary" data-id ="{{$mon->readingID}}" id="view">View</button>
                                                          <!-- <button>Update</button> -->
                                                        </td>
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
<script type="text/javascript" src ="js/utility.js"></script>
@stop