@extends('layout.app')

@section('title')
{{ 'Payment'}}
@stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style type="text/css">
    .col-md-12{
        margin-top: 10px;
    }
</style>
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol>
@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Bills</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Payments</a></li>
                                   
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                  <div class="table-striped-responsive">
                                      <div class="defaultNewButton">
                                          <a class="btn btn-primary btn-flat" href="{{ url('/CreateBill')}}"><span class='fa fa-plus'></span>&nbspRecord Utilities Bill</a>
                                         
                                      </div>
                                        <table id="tblstall" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Bill Number</th>
                                                <th>Bill Date</th>
                                                <th>StallHolder Name</th>
                                                <th>Billing Period</th>
                                                <th>Billed By</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- box box-primary -->
                    </div>
                    <!-- tab1primary -->
                    <div class="tab-pane fade" id="tab2primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-striped-responsive">
                                       <div class="defaultNewButton">
                                          <a class="btn btn-primary btn-flat" ><span class='fa fa-plus'></span>&nbspAdd Bulk Payments</a>
                                         
                                      </div>
                                        <table id="tblreg" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>StallHolder Name</th>
                                                <th>Stall Code</th>
                                                <th>Collection Status</th>
                                                <th>Current Balance</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <!-- tab2primary -->
                </div>
                <!-- tab content-->
            </div>
            <!-- panel body-->
        </div>
        <!-- panel with-nav-tabs-->
    </div>
    <!-- col-md-12 -->
</div>
<!-- row -->


@stop
@section('script')
    <script type="text/javascript">
     
    </script>
@stop