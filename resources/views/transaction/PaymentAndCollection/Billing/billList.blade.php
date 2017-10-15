@extends('layout.app') @section('title') {{'Bill Lists'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
    <li class="active">Billing</li>
</ol> @stop @section('content')
<div class="defaultNewButton">
    <a href="{{URL::previous()}}">
        <input type="hidden" name="id" value="">
        <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</button>
    </a>
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <form method="get" action="/createBill">
                    {{csrf_field()}}
                    <button name="id" value="{{$contract->contractID}}" class="btn btn-primary btn-flat"><span class='fa fa-plus'></span>&nbspCreate Bill</button>
                </form>
            </div>
            <table id="billList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Bill ID</th>
                        <th>Billing Period</th
                    </tr>
                </thead>
                <tbody>
                @foreach($billID as $bill)
                    <tr>
                        <th>{{date("Ymd000",strtotime($bill->created_at)).$bill->billDetID}}</th>
                        <th>{{date("F d, Y",strtotime($bill->Billing->billDateFrom))." - ".date("F d, Y",strtotime($bill->Billing->billDateTo))}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
</script> @stop