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
                                           <table id="requestList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No.</th>
                                                    <th>Utility Tyoe</th>
                                                    <th>Date From:</th>
                                                    <th>Date To:</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  
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