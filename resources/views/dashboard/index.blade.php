@extends('layout.app') 
@section('title') 
{{ 'Dashboard'}}
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
					<h3>241 <small>Stalls</small></h3>		
					<b>Available:<small>10</small></b><br>
					<b style="margin-left: 5px;">Occuppied:<small>231</small></b><br>
					<b style="margin-left: 10px;">Under Maintenance:<small>231</small></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-home"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
					<h3>200 <small>Tenants</small></h3>		
					<b>Active:<small>10</small></b><br>
					<b style="margin-left: 5px;">Pending:<small>231</small></b><br>
					<b style="margin-left: 10px;">Inactive:<small>5</small></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
					<h3>200 <small>Requests</small></h3>		
					<b>Approved:<small>10</small></b><br>
					<b style="margin-left: 5px;">Pending:<small>231</small></b><br>
					<b style="margin-left: 10px;">Disapproved:<small>5</small></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-yellow">
			<div class="inner">
					<h3>200 <small>Collections</small></h3>		
					<b>Approved:<small>10</small></b><br>
					<b style="margin-left: 5px;">Pending:<small>231</small></b><br>
					<b style="margin-left: 10px;">Disapproved:<small>5</small></b><br>		
			</div>
			<div class="icon">
				<i class="fa fa-file-text-o"></i>
			</div>
		</div>
	</div>
</div>


<div class="row">
<div class="col-md-12">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"></h3>
			
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>	
			</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body" style="height: 500px">
				<div class="row">
					<div class="col-md-10" id="container">
					
						
					</div>
					<!-- /.col -->
					<div class="col-md-2">
						<p class="text-center">
							<strong>Legend</strong>
						</p>
						<div class="progress-group">
							<span class="progress-text">Add Products to Cart</span>
							<span class="progress-number"><b>160</b>/200</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Complete Purchase</span>
							<span class="progress-number"><b>310</b>/400</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-red" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Visit Premium Page</span>
							<span class="progress-number"><b>480</b>/800</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-green" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Send Inquiries</span>
							<span class="progress-number"><b>250</b>/500</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>


<div class="row">
<div class="col-md-12">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Collections Status</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<div class="btn-group">
					<button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-wrench"></i></button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</div>
				
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-10">
						<p class="text-center">
							<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
						</p>

						<div class="chart">
							<!-- Sales Chart Canvas -->
							<canvas id="salesChart" style="height: 180px;"></canvas>
						</div>
						<!-- /.chart-responsive -->
					</div>
					<!-- /.col -->
					<div class="col-md-2">
						<p class="text-center">
							<strong>Legend</strong>
						</p>

						<div class="progress-group">
							<span class="progress-text">Add Products to Cart</span>
							<span class="progress-number"><b>160</b>/200</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Complete Purchase</span>
							<span class="progress-number"><b>310</b>/400</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-red" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Visit Premium Page</span>
							<span class="progress-number"><b>480</b>/800</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-green" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
						<div class="progress-group">
							<span class="progress-text">Send Inquiries</span>
							<span class="progress-number"><b>250</b>/500</span>

							<div class="progress sm">
								<div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
							</div>
						</div>
						<!-- /.progress-group -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- ./box-body -->
			<div class="box-footer">
				<div class="row">
					<div class="col-sm-3 col-xs-6">
						<div class="description-block border-right">
							<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
							<h5 class="description-header">$35,210.43</h5>
							<span class="description-text">TOTAL REVENUE</span>
						</div>
						<!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-3 col-xs-6">
						<div class="description-block border-right">
							<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
							<h5 class="description-header">$10,390.90</h5>
							<span class="description-text">TOTAL COST</span>
						</div>
						<!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-3 col-xs-6">
						<div class="description-block border-right">
							<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
							<h5 class="description-header">$24,813.53</h5>
							<span class="description-text">TOTAL PROFIT</span>
						</div>
						<!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-3 col-xs-6">
						<div class="description-block">
							<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
							<h5 class="description-header">1200</h5>
							<span class="description-text">GOAL COMPLETIONS</span>
						</div>
						<!-- /.description-block -->
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/dash.js') }}"></script>
 @stop 