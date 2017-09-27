@extends('layout.app')

@section('title')
{{'Collections'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Collections</li>
</ol>
@stop

@section('content')
<div>
    <div class="box box-solid box-default">
        <div class="box-body" >
            <div class="col-md-12">
                  <div class="box box-solid box-primary">
                        <div class="box-header with-border">
                              <h4 class="box-title"></h4>
                        </div>
                        <div>
                              <div class="box-body">
                               
                                    <div class="col-xs-12">
                                     <div class="defaultNewButton">
                                          <a href="{{url('/CreateCollection/'.$storeID)}}"> <button class="btn btn-primary btn-flat"><span class='fa fa-plus'></span>&nbspCreate Collections</button></a>
               
                                     </div>
                                          <div class="table-responsive"> 
                                           <table id="stallList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Created At</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($collections as $key => $collection)
                                                    <tr>
                                                      <td>{{++ $key}}</td>
                                                      <td>{{date('M d,Y',strtotime($collection->firstDate))}} (<i>{{date('l',strtotime($collection->firstDate))}}</i>) to {{date('M d,Y',strtotime($collection->lastDate))}} (<i>{{date('l',strtotime($collection->lastDate))}}</i>)</td>
                                                      <td>{{$collection->created_at}}</td>
                                                      <td><a href="/ViewCollectionDetails/{{$firstID}}/end/{{$lastID}}"><button class="btn btn-success">View Details</button></a></td>
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
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 
</script>
@stop