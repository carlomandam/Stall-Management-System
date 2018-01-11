 
<?php $__env->startSection('title'); ?> 
<?php echo e('Dashboard'); ?>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content-header'); ?>
<!-- <h1>
  Dashboard
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
</ol> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row" >
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
					<h3><?php echo e($stalls); ?> <small>Stalls</small></h3>		
					<b>Available:<small><?php echo e($availableStalls); ?></small></b><br>
					<b>Occuppied:<small><?php echo e($occuppied); ?></small></b><br>
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
					<h3><?php echo e($tenants); ?> <small>Tenants</small></h3>		
					<b>Active:<small> <?php echo e($activeTenants); ?></small></b><br>
					<b>Inactive: <small><?php echo e($inactiveTenants); ?></small></b><br>
					<b>Pending Application: <?php echo e($pendingApplication); ?><small></small></b><br>		
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



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src ="<?php echo e(URL::asset('js/dash.js')); ?>"></script>
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
 <?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>