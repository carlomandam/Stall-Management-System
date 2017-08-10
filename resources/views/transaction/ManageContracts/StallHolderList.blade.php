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


<style>
	#floortbl td{
		padding-bottom:5px;
	}
	#floortbl th, #floortbl td{
		text-align: center;
	}

.form-control, .pull-right{
	margin-top: 14px;
}

</style>
@stop

@section('content')


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
											<th>Active Contract/s</th>
										</tr>
									</thead>
									<tr>
										<th>Brixter Duenas</th>
										<th>Active</th>
										<th>1</th>
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

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Name of Organization</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name=""  disabled="" /> 
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">First Name</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name=""  disabled=""  /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Middle Name</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name=""  disabled="" /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Last Name</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="radio">
												<div class="col-md-4">
													<label>Sex</label>
												</div>
												
												<div class="col-md-8">
													<label>
														<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked disabled="" >
														Male
													</label>
													<label>
														<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" disabled="" >
														Female
													</label>
												</div>
											</div>
										</div>  
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Date</label>

											<div class="col-sm-8">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask  disabled="" />
												</div>
											</div>
										</div>
									</div>	

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Email Address</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Mobile No.</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Home Address</label>
											</div>
											<div class="col-md-8">
												<textarea class="form-control" disabled="" ></textarea> 
											</div>
										</div>
									</div>
								</div>




								<div class="tab-pane" id="tab_2-2">
									<div class="col-md-12">
										<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Stall Code</label>
											</div>
											<div class="col-md-8">
												<div class="form-group">
		
													<select class="form-control">
														<option>A001</option>
														<option>A002</option>
														<option>A003</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Stall Type</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Stall Rate</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="" class="col-sm-4 control-label">Starting Date</label>

											<div class="col-sm-8">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask  disabled="" />
												</div>
											</div>
										</div>
									</div>	

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Business Name</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Associate Holder 1</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Associate Holder 2</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="form-control" id="" name="" disabled=""  /> 
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<div class="col-md-4">
												<label for="">Home Address</label>
											</div>
											<div class="col-md-8">
												<textarea class="form-control" disabled="" ></textarea> 
											</div>
										</div>
									</div>
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
@stop
@section('script')
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