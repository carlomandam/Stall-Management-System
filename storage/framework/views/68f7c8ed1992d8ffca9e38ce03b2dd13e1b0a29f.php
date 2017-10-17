<html>
<head>
	<title>View Balance Summary Report</title>
	<style type="text/css">
	
table{
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,  th {
    border: 2px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th,  td{
	text-align: center;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
h4{

font-size: 20px;
text-align: center;
font-family: sans-serif;
}



	</style>

</head>
<body>

	<div style="text-align: center;padding-top: -50px;">
		<h2 >My Seoul Goods and Garments</h2>
		<p style="padding-top: -20px;font-size: 10px;"><b>Manila East Market, B5 Lot 4 Manila East Homes St</b></p>
		<p style="padding-top: -10px;font-size: 10px;"><b>Taytay, 1920 Rizal</b></p>
	</div>
	<h4>Balance Summary as of <?php echo e(Carbon\Carbon::today()->format('F d,Y')); ?></h4>
	<h5 style="text-align: right;">Printed Date: <?php echo e(Carbon\Carbon::today()->format('F d,Y')); ?></h5>
	 <table id = "tblmain"> 

		  <tr>
		    <th>Stall Code</th>
		    <th>Tenant Name</th>
		    <th>Collection Status</th>
		    <th>Total Balance</th>
		  </tr>
		<tbody>
		 <?php $__currentLoopData = $stalls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  <tr>
		   	<td><?php echo e($totalUnpaid[$key]['stallID']); ?></td>
		   	<td><?php echo e($totalUnpaid[$key]['name']); ?></td>
		   	<?php if($totalUnpaid[$key]['status'] == 'COLLECT'): ?>
		   	<td style="color: #3c8dbc;"><b><?php echo e($totalUnpaid[$key]['status']); ?></b></td>
		   	<?php elseif($totalUnpaid[$key]['status'] == 'REMINDER'): ?>
		    <td style="color: #00a65a;"><b><?php echo e($totalUnpaid[$key]['status']); ?></b></td>
		    <?php elseif($totalUnpaid[$key]['status'] == 'WARNING'): ?>
		    <td style="color: #f39c12;"><b><?php echo e($totalUnpaid[$key]['status']); ?></b></td>
		    <?php elseif($totalUnpaid[$key]['status'] == 'LOCK'): ?>
		    <td style="color: #FF851B;"><b><?php echo e($totalUnpaid[$key]['status']); ?></b></td>
		     <?php elseif($totalUnpaid[$key]['status'] == 'TERMINATE'): ?>
		    <td style="color: #f56954;"><b><?php echo e($totalUnpaid[$key]['status']); ?></b></td>
		   	<?php endif; ?>
		   	<td>Php <?php echo e($totalUnpaid[$key]['amount']); ?></td>
		  </tr>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  <tr>
		  	<td>
		  	</td>
		  	<td>
		  	</td>
		  	<td style="text-align: right; font-weight: bold;">
		  	Total Amount Receivables:
		  	</td>
		  	<td>
		  	Php <?php echo e(number_format($totalAmtCtr,2)); ?>

		  	</td>
		  </tr>
		  
  		</tbody>

  
 
	</table>
	<div class = "row" style="margin-left: 10px;">
		
             <p style="margin-top: 50px;">Printed By:</p>
             <p><?php echo e(Auth::user()->name); ?></p>
            

             
			
	</div>


</body>
</html>
