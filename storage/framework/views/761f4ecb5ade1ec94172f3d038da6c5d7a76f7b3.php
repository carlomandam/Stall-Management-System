<html>
<head>
	<title>View Quotation</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
		}
		table tr, td, th {
			border: 1px solid black;

		}
		th, td {
			padding: 10px;
		}

		.page-break
		{
			page-break-after: always;
		}
	</style>

</head>
<body>
	<?php $__currentLoopData = $req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div style="text-align: center;padding-top: -50px;">
		<h2 >My Seoul Goods and Garments</h2>
		<p style="padding-top: -20px;font-size: 10px;"><b>Manila East Market, B5 Lot 4 Manila East Homes St</b></p>
		<p style="padding-top: -10px;font-size: 10px;"><b>Taytay, 1920 Rizal</b></p>
	</div>
	<div style="text-align: center;padding-top: -30px;">
		<?php if($r->Type==1): ?>
		<h4>Request for Transfer Stall</h4>
		<?php elseif($r->Type==2): ?>
		<h4>Request for Leaving Stall</h4>
		<?php elseif($r->Type==3): ?>
		<h4>Request</h4>
		<?php endif; ?>
	</div>

	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Tenant Name:</h5><span style="font-size: 15px;margin-left: 5px;"><?php echo e($r->First); ?> <?php echo e($r->Middle); ?> <?php echo e($r->Last); ?></span>
	</div>

	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Status:</h5>
		<?php if($r->status==1): ?>
		<span style="font-size: 15px;margin-left: 5px;color: green">Approved</span>
		<?php elseif($r->status==2): ?>
		<span style="font-size: 15px;margin-left: 5px;color: red"> Rejected</span>
		<?php endif; ?>
	</div>

	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Desired Date:</h5>
		<span style="font-size: 15px;margin-left: 5px;"><?php echo e($r->desired); ?></span>
	</div>

	<?php if($r->Type==1): ?>
	<?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	</div>
	<div style="margin-left: 50px;">
		<h5 style="display: inline;"> From Stall:</h5>
		<b>
			<span style="font-size: 10px;margin-left: 5px;"><?php echo e($i->stallFrom); ?></span>
		</b>
		<h5 style="display: inline;"> To Stall:</h5>
		<b>
			<span style="font-size: 10px;margin-left: 5px;"><?php echo e($i->stallRequested); ?></span>
		</b>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php elseif($r->Type==2): ?>
	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Desired Stall:</h5>
		<?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<b>
			<span style="font-size: 15px;margin-left: 5px;"><?php echo e($i->stallFrom); ?></span>
		</b>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
	</div>
	<?php elseif($r->Type==3): ?>
	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Subject:</h5>
		<span style="font-size: 15px;margin-left: 5px;"><?php echo e($r->subject); ?></span>
	</div>
	<?php endif; ?>
	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Reason:</h5>
			<p style="font-size: 15px;margin-left: 50px;"><?php echo e($r->reason); ?></p>
		
	</div>

		<div style="margin-left: 50px;">
		<h5 style="display: inline;">Remarks:</h5>
		
			<p style="font-size: 15px;margin-left: 5px;"><?php echo e($r->remarks); ?></p>
		
		
	</div>

	<div style="margin-left: 50px;margin-top: 20px;">
		<b style="padding-top: 20px;">________________________</b><br>
		<b style="margin-left: 25px;"><?php echo e(Auth::user()->name); ?></b>

	</div>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>