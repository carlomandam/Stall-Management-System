@extends('layout.app') 
@section('title') 
{{'Dashboard'}}
@stop 
@section('style')

@stop
@section('content-header')
<!-- <h1>
  Dashboard
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol> -->
@stop
@section('content')
<div class="row" >
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
					<h3>{{$stalls}} <small>Stalls</small></h3>		
					<b>Available:<small>{{$availableStalls}}</small></b><br>
					<b>Occuppied:<small>{{$occuppied}}</small></b><br>
					<b></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-home"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
					<h3>{{$tenants}} <small>Tenants</small></h3>		
					<b>Active:<small> {{$activeTenants}}</small></b><br>
					<b>Inactive: <small>{{$inactiveTenants}}</small></b><br>
					<b>Pending Application: {{$pendingApplication}}<small></small></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
					<h3>8 <small>Requests</small></h3>		
					<b>Approved:<small>3</small></b><br>
					<b>Pending:<small>5</small></b><br>
					<b>Disapproved:<small>0</small></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-yellow">
			<div class="inner">
					<h3>3 <small>Collections</small></h3>		
					<b></b><br>
					<b></b><br>
					<b></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
		</div>
	</div>
</div>


<div class="row">
<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-header with-border">
              <h3 class="box-title"><b>Available Stalls</b></h3>
            </div>
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table id="tblstall" class="table table-striped" role="grid" style="width:100%">
                                            <thead>
                                                <th>Stall Code</th>
                                                <th>Stall Location</th>
                                                <th>No. Pending Applications</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>



@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/dash.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
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
	            ]
	        });
	});
</script>>
 @stop 