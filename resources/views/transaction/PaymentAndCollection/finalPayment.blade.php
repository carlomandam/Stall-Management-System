@extends('layout.app')

@section('title')
{{'Payment'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Payment</li>
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
                                                    <th>Collection Status</th>
                                                    <th>Balance</th>
                                                    <th>Action/s</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                 @foreach($stalls as $stall)
                                                  <tr>
                                                     <td>{{$stall->stallCode}}</td>
                                                     <td>{{$stall->tenantName}}</td>

                                                     <td>
                                                        
                                                     </td>
                                                     <td></td>
                                                     <td><a href="/ViewPayment/{{$stall->contractID}}"><button class="btn btn-primary">Proceed to Payment</button></a></td>
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