@extends('layout.app')

@section('title')
{{'Create Bill'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Billing</li>
</ol>
@stop
<style>
body{
    margin-left: -80px;
}
</style>
@section('content')

 <div class="defaultNewButton">
               <a href="{{url('/ViewBill/'.$storeID)}}"> <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</button></a>
               
</div>
<div class="box box-primary">
    <div class="box-body">

        <div class="table-responsive">
      
            <div class="row">
                <div class="col-md-2"><label>Billing Number:</label></div>
                <div class="col-md-3"><input type="text" name="" class="form-control" disabled value="{{$billID}}"></div>
            </div>

             <div class="row" style="margin-top: 10px;">
                <div class="col-md-2"><label>Tenant Name:</label></div>
                <div class="col-md-8"><input type="text" name="" class="form-control" disabled value="{{$stallRental->StallHolder->stallHFName}} {{$stallRental->StallHolder->stallHMName}} {{$stallRental->StallHolder->stallHLName}}"></div>
            </div>

             <div class="row" style="margin-top: 10px;">
                <div class="col-md-2"><label>Stall Code:</label></div>
                <div class="col-md-3"><input type="text" name="" class="form-control" disabled value="{{$storeID}}" 
                ></div>
                 <div class="col-md-2"><label>Business Name:</label></div>
                <div class="col-md-3">
                 <input type="text" name="" class="form-control" disabled value="{{$stallRental->businessName}}">
             
                </div>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label>Bill Date From:</label>
                </div>
                <div class="col-md-3">
                  <input type="text" name="" class="form-control" disabled value="{{$newBill}}">
                </div>

                <div class="col-md-2">
                    <label>Bill Date To:</label>
            </div>
                <div class = "col-md-3">
                    <input type="text" class="form-control" id='datepicker' name='datepicker' readonly="true" style="cursor:pointer; background-color: #FFFFFF;"/>
                </div>
            </div>
        </div>

    </div>
</div>

@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
    $(document).on('ready',function(){
        $("#datepicker").datepicker({
        showOtherMonths: true
        , selectOtherMonths: true
        , changeMonth: true
        , changeYear: true
        , autoclose: true
        , startDate: "dateToday"
        , todayHighlight: true
        , orientation: 'bottom'
        ,format: 'yyyy-mm-dd'
    });

    });
</script>
@stop