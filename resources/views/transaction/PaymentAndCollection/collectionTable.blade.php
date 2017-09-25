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
                                          <div class="table-responsive"> 
                                           <table id="stallList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>Stall Code</th>
                                                    <th>Tenant Name</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($contract as $contract)
                                                    <tr>
                                                      <td>
                                                      {{$contract->StallRental->stallID}}
                                                      </td>
                                                      <td>
                                                      {{$contract->StallRental->StallHolder->stallHFName}}
                                                      {{$contract->StallRental->StallHolder->stallHMName}}
                                                      {{$contract->StallRental->StallHolder->stallHLName}}
                                                      </td>
                                                      <td>
                                                      <a href="/ViewCollections/{{$contract->contractID}}"><button class="btn btn-success">View</button></a>
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
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 
</script>
@stop