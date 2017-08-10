@extends('layout.app')

@section('title')
{{ 'Registration List'}}
@stop
@section('content-header')

<ol class="breadcrumb">
	<li><i class="fa fa-dashboard"></i> Transactions</li>
	<li>Manage Contracts</li>
	<li class="active">Registration List</li>
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


<div class="box box-solid box-primary">
	<div class="box-header with-border">
		<label class = "box-header-label"> Registration List</label>
	</div>
	<div>

		<div class="box-body">

			<div class="col-xs-12">


			


						<div class="table-responsive">
							<table id="prodtbl" class="table table-striped" role="grid">
								<thead>
									<tr>
										<th style="width: 300px;">Name</th>
										<th style="width: 300px;">Address</th>
										<th style="width: 200px;">Contact No.</th>
										<th style="width: 200px;">Registration Date</th>
										<th style="width: 400px;">Actions</th>
									</tr>
								</thead>
								<tr>
									<td>Brixter Duenas</td>
									<td>Pilar St Tondo Manila</td>
									<td>09159807649</td>
									<td>03/21/2017</td>
									<td>
											<button type="Submit" class="btn btn-flat btn-success"><span class = "fa  fa-angle-double-right"></span>&nbspCreate Contract</button>
											<button type="Submit" class="btn btn-flat btn-primary" onclick="window.location='{{ url('/UpdateRegistration') }}'"><span class = "fa fa-pencil"></span>&nbspUpdate</button>
											<button type="Submit" class="btn btn-flat btn-danger"><span class = "fa fa-ban"></span>&nbspCancel</button>
									</td>
								</tr>
							</table>
						</div>
					
			</div>
		</div>
	</div>
</div>


@stop