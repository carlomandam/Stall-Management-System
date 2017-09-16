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
            <div class="defaultNewButton">
               <a href="{{url('/createBill')}}"> <button class="btn btn-primary btn-flat"><span class='fa fa-plus'></span>&nbspCreate Bill</button></a>
               
            </div>
            <table id="billList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Bill ID</th>
                        <th>Issued Date</th>
                        <th>Effective Date</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                 
                   
                </tbody>
            </table>
        </div>
   </div>

@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 
</script>
@stop