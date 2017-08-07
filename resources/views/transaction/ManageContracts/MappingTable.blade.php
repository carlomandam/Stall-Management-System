@extends('layout.app')

@section('title')
{{ 'Stall List'}}
@stop
@section('content-header')

<ol class="breadcrumb">
	<li><i class="fa fa-dashboard"></i> Transactions</li>
	<li>Manage Contracts</li>
	<li class="active">Stall List</li>
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

<div class="box box-primary">
	<div class="box-header with-border">
		<h3>Stall List</h3>
	</div>
	<div>

		<div class="box-body">

			<div class="col-xs-12">
						<div class="table-responsive">
							<table id="tblstall" class="table table-striped" role="grid">
								<thead>
									<tr>
										<th width = "150px;">Stall Code</th>
										<th  width = "200px;">Stall Type</th>
										<th width = "300px;">Location</th>
										<th  width = "200px;">Status</th>
										<th  width = "200px;">Remarks</th>
										<th width = "350px;">Actions</th>
									</tr>
								</thead>
								<tr>
									<th>A001</th>
									<th>Cart</th>
									<th>Near Gate</th>
									<th>Under Maintenance</th>
									<th>Natanggalan kasi ng gulong kahapon hahahaha xD</th>
									<th>
										<div>
											<button type="Submit" class="btn btn-success">Register</button>
											<button type="Submit" class="btn btn-default" data-toggle="modal" data-target="#view">View</button>
											<button type="Submit" class="btn btn-primary" data-toggle="modal" data-target="#update">Update</button>
										</div>

									</th>
								</tr>
							</table>
						</div>
					
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="view" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<form class="building" action="" method="post" id="newform">
			<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<div class="col-md-12">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Stall Details</h4> 
					</div>

				</div>

				<div class="modal-body">
					<div class="row">

						<div class="col-sm-6">
							<label>Stall Code</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled=""  />
							</div>
						</div>

						<div class="col-sm-6">
							<label>Status</label>
							<div class="col-md-12">
								<input type="text" class="form-control"  disabled="" />
							</div>
						</div>

						<div class="col-sm-6">
							<label>Stall Type</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled=""  />
							</div>
						</div>

						<div class="col-sm-6">
							<label>Stall Rate</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled=""  />
							</div>
						</div>

						<div class="col-sm-12">
							<label>Location</label>
							<div class="col-md-12">
								<textarea type="text" class="form-control" disabled=""  /></textarea>
							</div>
						</div>
						<div class="col-sm-12">
							<label>Remarks</label>
							<div class="col-md-12">
								<textarea type="text" class="form-control" disabled=""  /></textarea>
							</div>
						</div>

						<div class="col-sm-12">
							<h4>Stall Holder Details</h4>
							<center><label>Not yet occupied!</label></center>
							<center><button class="btn btn-success">Do you want to Register?</button></center>
						</div>	
						<div class="col-sm-2 pull-right">
							<button class="btn btn-primary" class="close" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<div class="modal fade" id="update" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<form class="building" action="" method="post" id="newform">
			<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<div class="col-md-12">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Stall Details</h4> 
					</div>

				</div>

				<div class="modal-body">
					<div class="row">

						<div class="col-sm-6">
							<label>Stall Code</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled="" />
							</div>
						</div>

						<div class="col-sm-6">
							<label>Status</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled="" />
							</div>
						</div>

						<div class="col-sm-6">
							<label>Stall Type</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled="" />
							</div>
						</div>

						<div class="col-sm-6">
							<label>Stall Rate</label>
							<div class="col-md-12">
								<input type="text" class="form-control" disabled="" />
							</div>
						</div>

						<div class="col-sm-12">
							<label>Location</label>
							<div class="col-md-12">
								<textarea type="text" class="form-control" disabled="" /></textarea>
							</div>
						</div>
						

						<div class="col-sm-12">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control">
									<option>Occupied</option>
									<option>Unoccupied</option>
									<option>Under Maintenance</option>
									<option>Damage</option>
								</select>
							</div>
						</div>	
						<div class="col-sm-12">
							<label>Location</label>
							<div class="col-md-12">
								<textarea type="text" class="form-control"/></textarea>
							</div>
						</div>
						<div class="col-sm-5 pull-right">
							<button class="btn btn-danger" class="close" data-dismiss="modal">Cancel</button>
							<button class="btn btn-primary" class="close" data-dismiss="modal">Save Changes</button>
						</div>

					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@stop