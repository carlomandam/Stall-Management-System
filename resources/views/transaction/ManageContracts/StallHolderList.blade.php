@extends('layout.app') @section('title') {{ 'Stall Holder List'}} @stop @section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style>
    .take-all-space-you-can {
        width: 100%;
    }
    
    .glyphicon {
        vertical-align: middle;
    }
    
    #tblStallHolder th::after {
        display: none!important;
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
                    <li class="active"><a href="#tab3primary" data-toggle="tab">Contracts</a></li>
                    <li><a href="#tab1primary" data-toggle="tab">Available Stalls</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Pending Registrations</a></li>
                    <li><a href="#tab4primary" data-toggle="tab">Tennants</a></li>         
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="tblstall" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Stall Code</th>
                                                <th>Stall Location</th>
                                                <th>No. Pending Applications</th>
                                                <th>Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <th style="width:5%">Registration Date</th>
                                                <th style="width:15%">Actions</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade in active" id="tab3primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="tblStallHolder" class="table table-striped" role="grid">
                                            <thead>
                                                <th width="100%">Tenant</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="tblTennant" class="table table-striped" role="grid" width="100%">
                                            <thead>
                                                <th width="50%">Tenant</th>
                                                <th width="25%">Date Registered</th>
                                                <th width="25%">Actions</th>
                                            </thead>
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
</div>
@stop @section('script')
<script>
    $(document).ready(function () {

        $('#tblStallHolder').DataTable({
            ajax: '/getStallHolders'
            , responsive: true
            , "columns": [
                {
                    "data": function (data, type, dataToSet) {
                        var contracts = '';
                        for (var i = 0; i < data.active_stall_rental.length; i++) {
                            contracts += "<tr><td>" + data.active_stall_rental[i].stallID + "</td><td><a href='/pdfview/" + data.active_stall_rental[i].stallRentalID + "'><button class='btn-primary pull-right' value='" + data.active_stall_rental[i].stallRentalID + "'>Generate Contract</button></a></td><td><a href='ViewContract/"+data.active_stall_rental[i].contract.contractID+"'><button class='btn-success pull-right'>View</button></a></td></tr>";
                        }
                        return '<div class="accordion-group" style="width:100%"><div class="accordion-heading" style="text-align:left;width:100%"><a class="accordion-toggle" data-toggle="collapse-next" style="width:100%">' + data.stallHFName + ' ' + data.stallHLName + '<i class="fa fa-angle-left pull-right"></i></a></div><div class="accordion-body collapse" style="margin-top:10px;text-indent:10px"><div class="accordion-inner"><table clas="table"><thead><th>Stall ID</th><th></th></thead><tbody>' + contracts + '</tbody></table></div></div></div>';
                    }
                }
            ]
            , "columnDefs": [
                {
                    "sortable": false
                    , "targets": 0
                }
            ]
            , "initComplete": function (settings, json) {
                $('#tblStallHolder tbody tr .accordion-heading').on('click', function (e) {
                    $(this).find('[data-toggle=collapse-next]').trigger('click.collapse-next.data-api');
                });
                $('#tblStallHolder tbody tr a').on('click', function (e) {
                    e.stopPropagation();
                    $(this).trigger('click.collapse-next.data-api');
                });
                $('.collapse').on('show.bs.collapse', function () {
                    $(this).prev().find('i').removeClass('fa-angle-left');
                    $(this).prev().find('i').addClass('fa-angle-down');
                });
                $('.collapse').on('hide.bs.collapse', function () {
                    $(this).prev().find('i').removeClass('fa-angle-down');
                    $(this).prev().find('i').addClass('fa-angle-left');
                });
            }
        });
        $('body').on('click.collapse-next.data-api', '[data-toggle=collapse-next]', function (e) {
            var $target = $(this).parent().next()
            $target.collapse('toggle');
        })
        $('#tblstall').DataTable({
            ajax: '/getAvailableStalls'
            , responsive: true
            , "columns": [
                {
                    "data": "stallID"
                }
                , {
                    "data": function (data, type, dataToSet) {
                        return ((data.floor.floorLevel == '1') ? data.floor.floorLevel+'st' : ((data.floor.floorLevel == '2') ? data.floor.floorLevel+'nd' : ((data.floor.floorLevel == '3') ? data.floor.floorLevel+'rd' : data.floor.floorLevel+'th'))) + " Floor, " + data.floor.building.bldgName;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        return data.pending_count;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {
                        return "<button class='btn btn-success btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "&#39;' style='width:100%'><span class='glyphicon glyphicon-pencil'></span> Register</button>";
                    }
                }
            ]
            , "columnDefs": [
                {
                    "width": "10%"
                    , "searchable": false
                    , "sortable": false
                    , "targets": 3
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
                        return "<button class='btn btn-primary btn-flat' onclick='window.location=&#39;" + "{{url('/UpdateRegistration/')}}/"+ data.stallRentalID + "&#39;' style='width:100%'><span class='glyphicon glyphicon-eye-open'></span> Details</button>";
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

        $('#tblTennant').DataTable({
            ajax: '/getTennants'
            , responsive: true
            , "columns": [
                {
                    "data": function (data, type, dataToSet) {
                        return data.stallHFName + ' ' + data.stallHMName[0] + '. ' + data.stallHLName;
                    }
                }
                , {
                    "data": "created_at"
                }
                , {
                    "data": "actions"
                }
            ]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 2
                    }
            ]
        });
    });

    function deleteTennant(id){
        $.ajax({
            type: "POST"
            , url: '/deleteTennant'
            , data: {
                "_token" : "<?php echo csrf_token();?>"
                , "id" : id
            }
            , context: this
            , success: function (data) {
                toastr.success('Tennant Deactivated!');
                $('#tblTennant').DataTable().ajax.reload();
            }
        });
    }
</script> @stop