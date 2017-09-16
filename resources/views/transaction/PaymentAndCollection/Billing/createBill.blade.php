@extends('layout.app')

@section('title')
{{'Payment and Collection'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Billing</li>
</ol>
@stop

@section('content')
<style>
    #floortbl td {
        padding-bottom: 5px;
    }

    #floortbl th,
    #floortbl td {
        text-align: center;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="row">
                <div class="col-md-2"><label>Billing ID:</label></div>
                <div class="col-md-3"><input type="text" name="" class="form-control" disabled></div>
            </div>
             <div class="row" style="margin-top: 10px;">
                <div class="col-md-2"><label>Stall Code:</label></div>
                <div class="col-md-3"><input type="text" name="" class="form-control" disabled></div>
            </div>
               <div class="row" style="margin-top: 20px;">
                <div class="col-md-2"><label>Range From:</label></div>
                <div class="col-md-2"><input type="text" name="" class="form-control" disabled></div>
                <div class="col-md-2"><label>Range To:</label></div>
                <div class="col-md-2"><input type="text" name="" class="form-control" disabled></div>
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