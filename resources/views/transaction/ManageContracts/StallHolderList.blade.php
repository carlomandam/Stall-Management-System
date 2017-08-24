@extends('layout.app') @section('title') {{ 'Stall Holder List'}} @stop @section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style>
    .take-all-space-you-can {
        width: 100%;
    }
    
    .glyphicon {
        vertical-align: middle;
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
                    <li class="active"><a href="#tab1primary" data-toggle="tab">StallHolders</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Pending Registrations</a></li>
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
                                                <th width="200px;">StallHolder Name</th>
                                                <th width="150px;">Stall Code</th>
                                                <th width="150px;">Stall Location </th>
                                                <th width="200px;">Collection Status</th>
                                                <th width="200px;">Start Date</th>
                                                <th width="200px;">End Date</th>
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
                                        <table id="tblreg" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Name</th>
                                                <th>Stall Code</th>
                                                <th>Address</th>
                                                <th>Contact No.</th>
                                                <th>Registration Date</th>
                                                <th style="width: 350px;">Actions</th>
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
                    "data": function (data, type, dataToSet) {
                        if (data.current_stall_holder != null) return data.current_stall_holder.stall_holder.stallHLName + ", " + data.current_stall_holder.stall_holder.stallHFName + " " + data.current_stall_holder.stall_holder.stallHMName[0] + '.';
                        else return null;
                    }
                }
                , {
                    "data": "stallID"
                }

                , {
                    "data": function (data, type, dataToSet) {
                        return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if (data.current_stall_holder != null || data.current_stall_holder != undefined) return data.current_stall_holder.startingDate;
                        else return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if (data.current_stall_holder != null || data.current_stall_holder != undefined) return data.current_stall_holder.contract.contractEnd;
                        else return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        if (data.current_stall_holder != null || data.current_stall_holder != undefined) {
                            return "<button class='btn btn-primary btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "&#39;' style='width:80%'><span class='glyphicon glyphicon-eye-open'></span> Details</button>";
                        }
                        else {
                            return "<button class='btn btn-success btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "&#39;' style='width:80%'><span class='glyphicon glyphicon-pencil'></span> Register</button>";
                        }
                    }
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
        $('#tblreg').DataTable({
            ajax: '/getRegistrationList'
            , responsive: true
            , "columns": [
                {
                    "data": function (data, type, dataToSet) {
                        return data.stall_holder.stallHFName + ' ' + data.stall_holder.stallHMName[0] + '. ' + data.stall_holder.stallHLName;
                    }
                }
                
                , {
                    "data": "stallID"
                }

                , {
                    "data": function (data, type, dataToSet) {
                        return data.stall_holder.stallHAddress;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        var string = '';
                        for (var i = 0; i < data.stall_holder.contact_no.length; i++) {
                            string += data.stall_holder.contact_no[i].contactNumber + "<br>";
                        }
                        return string;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        var date = new Date(data.created_at);
                        return date.getMonth() + '-' + date.getDate() + '-' + date.getFullYear();
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        return "<button class='btn btn-primary btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "/" + data.stallRentalID + "&#39;' style='width:80%'><span class='glyphicon glyphicon-eye-open'></span> Details</button>";;
                    }
                }
			]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 5
                    }
            ]
        });
    });
</script> @stop