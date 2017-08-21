@extends('layout.app') @section('title') {{ 'Stall Holder List'}} @stop @section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style>
    .take-all-space-you-can {
        width: 100%;
    }
</style> @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Transactions</li>
    <li class="active">Manage Contracts</li>
</ol> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Stall Holder List</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Registration List</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="tblstall" class="table table-striped" role="grid">
                                            <thead>
                                                <th width="150px;">Stall Code</th>
                                                <th width="200px;">StallHolder Name</th>
                                                <th width="200px;">Collection Status</th>
                                                <th width="200px;">Start Date</th>
                                                <th width="200px;">Contract Expiry Date</th>
                                                <th width="350px;">Actions</th>
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
                                    <div class="table-responsive">
                                        <table id="tblreg" class="table table-striped" role="grid">
                                            <thead>
                                                <th style="width: 300px;">Name</th>
                                                <th style="width: 300px;">Address</th>
                                                <th style="width: 200px;">Contact No.</th>
                                                <th style="width: 200px;">Registration Date</th>
                                                <th style="width: 500px;">Actions</th>
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
<!-- row -->@stop @section('script')
<script>
    $(document).ready(function () {
        $('#tblstall').DataTable({
            ajax: '/getStallHolderList'
            , responsive: true
            , "columns": [
                {
                    "data": "stallID"
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if (data.stall_holder.length != 0) return data.stall_holder[0].stallHLName + ", " + data.stall_holder[0].stallHFName + " " + data.stall_holder[0].stallHMName[0] + '.';
                        else return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if (data.stall_rental.contract != null || data.stall_rental.contract != undefined) 
                            return data.stall_rental[0].startingDate;
                        else return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if (data.stall_rental.contract != null || data.stall_rental.contract != undefined) return data.stall_rental[0].contract[0].contractEnd;
                        else return null;
                    }
                }
                , {
                    "data": "actions"
                }
			]
            , "columnDefs": [
                {
                    "width": "20%"
                    , "searchable": false
                    , "sortable": false
                    , "targets": 5
                    }
            ]
        });
    });
</script> @stop