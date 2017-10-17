@extends('layout.app')

@section('title')
{{'Payment'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Payment</li>
</ol>

<style>
    .yellow{
      background-color: #f7e64c;
      color:black;
    }
    .label{
      font-size:14px;
    }
    th,td{
      text-align: center;
    }
</style>
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
                                                
                                                 @foreach($stalls as $key => $stall)
                                                  
                                                  <tr>    
                                                     <td>{{$stall->stallCode}}</td>

                                                     <td>{{$stall->tenantName}}</td>

                                                    <td>
                                                    <center>
                                                      @if($totalUnpaid[$key]['status'] == 'COLLECT')
                                                          <label class="label bg-primary">{{$totalUnpaid[$key]['status']}}</label>
                                                      @elseif($totalUnpaid[$key]['status'] == 'REMINDER')
                                                          <span class="label bg-green"><label>{{$totalUnpaid[$key]['status']}}</label></span>
                                                      @elseif($totalUnpaid[$key]['status'] == 'WARNING')
                                                          <span class="label yellow"><label>{{$totalUnpaid[$key]['status']}}</label></span>
                                                      @elseif($totalUnpaid[$key]['status'] == 'LOCK')
                                                          <span class="label bg-orange"><label>{{$totalUnpaid[$key]['status']}}</label></span>
                                                      @elseif($totalUnpaid[$key]['status'] == 'TERMINATE')
                                                          <span class="label bg-red"><label>{{$totalUnpaid[$key]['status']}}</label></span>
                                                    @endif
                                                    </center>
                                                    </td>

                                                     <td>₱ {{number_format($totalUnpaid[$key]['amount'],2)}}</td>
                                                     <td>
                                                      @if(isset($totalUnpaid[$key]['actions']))
                                                      

                                                     <a href="/ViewPayment/{{$stall->contractID}}"><button class="btn btn-primary">Proceed to Payment</button></a>

                                                     <button id="clearance"  data-id ="{{$stall->stallCode}}" class="btn btn-primary">Print Clearance</button>
                                                     @else
                                                     <a href="/ViewPayment/{{$stall->contractID}}"><button class="btn btn-primary">Proceed to Payment</button></a>
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
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 $(document).on('click','#clearance', function(){
  id = $(this).attr("data-id");
  console.log(id);
  window.location.href="/ClearancePDF/"+id;
 })
</script>
@stop