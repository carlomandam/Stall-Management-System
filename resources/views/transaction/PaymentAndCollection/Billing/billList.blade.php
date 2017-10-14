@extends('layout.app')

@section('title')
{{'Bill Lists'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
  <li class="active">Billing</li>
</ol>
@stop

@section('content')

 <div class="defaultNewButton">
               <a href="{{url('/Billing')}}"> <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</button></a>
               
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
               <a href="{{url('/createBill/'.$storeID)}}"> <button class="btn btn-primary btn-flat"><span class='fa fa-plus'></span>&nbspCreate Bill</button></a>
               
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