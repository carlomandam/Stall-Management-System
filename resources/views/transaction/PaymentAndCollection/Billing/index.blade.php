@extends('layout.app') @section('title') {{'Payment and Collection'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
    <li class="active">Billing</li>
</ol> @stop @section('content')
<div>
    <div class="box box-solid box-default">
        <div class="box-body">
            <div class="col-md-12">
                <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"></h4> </div>
                    <div>
                        <div class="box-body">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="stallList" class="table table-bordered table-striped" role="grid" style="font-size:15px;">
                                        <thead>
                                            <tr>
                                                <th>Stall Code</th>
                                                <th>Stall Holder</th>
                                                <th>Action/s</th>
                                            </tr>
                                        </thead>
                                        <tbody> @foreach($stalls as $stall)
                                            <tr>
                                                <td>{{$stall->stallID}}</td>
                                                <td>{{$stall->StallHolder->stallHFName}}&nbsp{{$stall->StallHolder->stallHMName}}&nbsp{{$stall->StallHolder->stallHLName}}</td>
                                                <td>
                                                    <form method="get" action="/ViewBill">
                                                        {{csrf_field()}}
                                                        <button class="btn btn-success" name="id" value="{{$stall->contractID}}">View</button>
                                                    </form>
                                                </td>
                                            </tr> @endforeach </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
</script> @stop