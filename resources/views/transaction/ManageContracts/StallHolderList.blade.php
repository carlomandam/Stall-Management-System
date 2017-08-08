@extends('layout.app')

@section('title')
{{ 'Stall Holder List'}}
@stop
@section('content-header')

<ol class="breadcrumb">
	<li><i class="fa fa-dashboard"></i>Transactions</li>
	<li>Manage Contracts</li>
	<li class="active">Stall Holder List</li>
</ol>
@stop

@section('content')

<style>
	#floortbl td{
		padding-bottom:5px;
	}
	#floortbl th, #floortbl td{
		text-align: center;
	}




</style>

<div class="col-md-6">
	<div class="box box-solid box-primary">
		<div class="box-header with-border">
			<label class = "box-header-label"> Stall Holder List </label>
		</div>
		<div>

			<div class="box-body" >

				<div class="col-xs-12">


					<div class="box">
						<div>

							<div class="table-responsive">
								<table id="prodtbl" class="table table-hover" role="grid" style="font-size:15px;">
									<thead>
										<tr>
											<th>Name</th>
											<th>Status</th>
											<th>Active Stall/s</th>
										</tr>
									</thead>
									<tr>
										<th>Brixter Duenas</th>
										<th>Active</th>
										<th>3</th>
									</div>
								</tr>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>


<div class="col-md-6">
	<div class="box box-solid box-primary">
		<div class="box-header with-border">
			<label class = "box-header-label"> Stall Holder Info</label>
		</div>
			<div class="box-body">

				<div class="col-xs-12">
					<div class="box">
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1-1" data-toggle="tab">Personal Info</a></li>
									<li><a href="#tab_2-2" data-toggle="tab">Stall Info</a></li>
									<li><a href="#tab_3-2" data-toggle="tab">Contract</a></li>
								</ul>
								<div class="tab-content">

									<div class="tab-pane active" id="tab_1-1">
										tab1
									</div>
									<div class="tab-pane" id="tab_2-2">
										tab2
									</div>

									<div class="tab-pane" id="tab_3-2">
										tab3
									</div>

								</div>
								
							</div>

						</div>
						<div class="col-md-3 pull-right" id="Update">
							<button onclick="myFunction()" type="Submit" class="btn btn-success">Update</button>
						</div>
						<div class="col-md-8 pull-right" id="Cancel" style="display: none">
							<button type="Submit" class="btn btn-default" onclick="Cancel()" >Cancel</button>
							<button type="Submit" class="btn btn-primary" onclick="Cancel()" >Save Changes</button>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>

<script>
	function myFunction() {
		var x = document.getElementById('Update');
		var y = document.getElementById('Cancel');
		if (x.style.display === 'none') {
			x.style.display = 'block';
			y.style.display= 'none';
		} else {
			x.style.display = 'none';
			y.style.display= 'block';
		}
	}

	function Cancel() {
		var x = document.getElementById('Update');
		var y = document.getElementById('Cancel');
		if (x.style.display === 'block') {
			x.style.display = 'none';
			y.style.display= 'block';
		} else {
			x.style.display = 'block';
			y.style.display= 'none';
		}
	}
</script>
@stop