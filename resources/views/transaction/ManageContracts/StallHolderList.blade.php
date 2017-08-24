@extends('layout.app') @section('title') {{ 'Stall Holder List'}} @stop @section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style>
    .take-all-space-you-can {
        width: 100%;
    }

    
    .glyphicon {
        vertical-align: middle;
    }

    #tblStallHolder th::after { display: none!important; }


    
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


                    <li class="active"><a href="#tab1primary" data-toggle="tab">Stall Holder List</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Registration List</a></li>
            <li><a href="#tab1primary" data-toggle="tab">Stall Holders</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Pending Registrations</a></li>
                     <li class="active"><a href="#tab3primary" data-toggle="tab">Contracts</a></li>


                    <li class="active"><a href="#tab3primary" data-toggle="tab">Contracts</a></li>
                    <li><a href="#tab1primary" data-toggle="tab">Available Stalls</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Pending Registrations</a></li>                    

                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">

                    <div class="tab-pane fade in active" id="tab1primary">

                    <div class="tab-pane fade in" id="tab1primary">

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="tblstall" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
<



                                                <th width="150px;">Stall Code</th>
                                                <th width="200px;">StallHolder Name</th>
                                                <th width="200px;">Collection Status</th>
                                                <th width="200px;">Start Date</th>
                                                <th width="200px;">Contract Expiry Date</th>

                                                <th width="200px;">StallHolder Name</th>
                                                <th width="150px;">Stall Code</th>
                                                <th width="150px;">Stall Location </th>
                                                <th width="200px;">Collection Status</th>
                                                <th width="200px;">Start Date</th>
                                                <th width="200px;">End Date</th>

                                                <th width="350px;">Actions</th>

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
                        <!-- box box-primary -->

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

        $('#tblStallHolder').DataTable({
            ajax: '/getStallHolders'
            , responsive: true
            , "columns": [
                {
                    "data": function (data, type, dataToSet) {
                        var contracts = '';
                        for (var i = 0; i < data.active_stall_rental.length; i++) {
                            contracts += "<tr><td>" + data.active_stall_rental[i].stallID + "</td></tr>";
                        }
                        return '<div class="accordion-group" style="width:100%"><div class="accordion-heading" style="text-align:left;width:100%"><a class="accordion-toggle" data-toggle="collapse-next" style="width:100%">' + data.stallHFName + ' ' + data.stallHMName[0] + '. ' + data.stallHLName + '<i class="fa fa-angle-left pull-right"></i></a></div><div class="accordion-body collapse" style="margin-top:10px;text-indent:10px"><div class="accordion-inner"><table clas="table"><thead><th>Stall ID</th></thead><tbody>' + contracts + '</tbody></table></div></div></div>';
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
                    //$(this).find('td div div a').click();
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
                        if (data.stall_holder.length != 0) return data.stall_holder[0].stallHLName + ", " + data.stall_holder[0].stallHFName + " " + data.stall_holder[0].stallHMName[0] + '.';
                        else return null;

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


                        if (data.stall_rental.contract != null || data.stall_rental.contract != undefined) 
                            return data.stall_rental[0].startingDate;

                        if (data.current_stall_holder != null || data.current_stall_holder != undefined) return data.current_stall_holder.startingDate;

                        else return null;
                    }
                }
                , {
                    "data": function (data, type, dataToSet) {

                        if (data.stall_rental.contract != null || data.stall_rental.contract != undefined) return data.stall_rental[0].contract[0].contractEnd;

                        if (data.current_stall_holder != null || data.current_stall_holder != undefined) return data.
                        else return null;
                    }
                }
                , {

                    "data": "actions"

                    "data": function (data, type, dataToSet) {
                        if (data.current_stall_holder != null || data.current_stall_holder != undefined) {
                            return "<button class='btn btn-primary btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "&#39;' style='width:80%'><span class='glyphicon glyphicon-eye-open'></span> Details</button>";
                        }
                        else {
                            return "<button class='btn btn-success btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "&#39;' style='width:80%'><span class='glyphicon glyphicon-pencil'></span> Register</button>";
                        }

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
                        return "<button class='btn btn-primary btn-flat' onclick='window.location=&#39;" + "{{url('/Registration/')}}/" + data.stallID + "/" + data.stallRentalID + "&#39;' style='width:100%'><span class='glyphicon glyphicon-eye-open'></span> Details</button>";
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