<!----<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.foundation.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.css">
</head>
<body>
<div class="container">
    
	<br/>
	<a href="<?php echo e(route('pdfview',['download'=>'pdf'])); ?>">Download PDF</a>

	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Amount</th>
		</tr>
		<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($item->utilID); ?></td>
			<td><?php echo e($item->utilName); ?></td>
			<td><?php echo e($item->utilDefaultMR); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</table>
</div>
</body>-->
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.foundation.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.css"> </head>

<body onload="startTime()">
    <div class="container" id="main">
        <div class="row">
            <form action="ContractManagement_Contract_view.php" method="post">
                <div>
                    <div id="header" style="text-align:center">
                        <h3 style="font-weight:bold">My Seoul Tiangge</h3>
                        <h4>Rental Agreement</h4> </div>
                    <div style="margin-left:10%;margin-right:10%;font-weight:bold">
                        <p style="text-indent:100px">THIS AGREEMENT made this
                            <?php echo e($item->utilID); ?> day of
                            <?php echo e($item->utilID); ?> , by and between OWNER My Seoul Tiangge and VENDOR (Name)
                            <?php echo e($item->utilID); ?>, (age)
                            <?php echo e($item->utilID); ?> live in(address)
                            <?php echo e($item->utilID); ?> The OWNER and VENDOR hereby agree the rental of Stall No.<?php echo e($item->utilID); ?> Commencing on this day until this agreement is subject to the following terms and conditions:
                        </p>
                        <br> </div>
                    <div style="margin-left:10%;margin-right:10%;">
                        <p>1. Membership</p>
                        <p style="text-indent:50px;">Vendor agrees to pay the annual membership fee for the maintenance of the facilities. This membership fee is non-refundable. </p>
                        <p>2. Contract Period</p>
						<p style="text-indent:50px;">The contract shall be a term of ___________ starting on the (number) ____ day of (Month) __________,(Year)______.</p>
                        <p>3. Security Deposit</p>
                        <p style="text-indent:50px;">Vendor agrees to pay the security deposit. This security deposit is non – refundable but consumable. It will cover unpaid rent upon termination of the rent agreement.</p>
                        <p>4. Payment of rent</p>
                        <p style="text-indent:50px;">Vendor is required to pay the daily rent based on the current rate. Rent will be collected daily in the morning by the staff of My Seoul Tiangge. Unpaid rent will be automatically deducted from the security deposit, which shall be immediately replenished by the vendor. </p>
                        <p>5. Termination</p>
                        <p style="text-indent:50px;">This agreement will automatically expire after one year. It may be renewed subject to the sole discretion of the management of MySeoul, Inc. The agreement may be terminated beforehand upon mutual written agreement of both parties. It may also be terminated if the vendor violates any stipulation of this agreement; OR if the vendor violates any rule, regulation, or policy declared by the management of MySeoul, Inc. in the course of operations. </p>
                        <p>6. Clearance </p>
                        <p style="text-indent:50px;">A clearance shall be issued to the vendor upon full account settlement. It shall serve as a gate pass for the egress of goods and merchandise owned by the vendor. </p>
                        <p>7. Installation of additional structure or utilities</p>
                        <p style="text-indent:50px;">The vendor shall not install power lines or outlets, plumbing, drainage, or any structure within the premises and perimeter of the property without a written consent of the owner. Violation is subject to immediate termination of lease, forfeiture of security deposit, and repair charges. Vendor may request for structural modification of structure and utilities subject to the sole approval of owner. Additional construction and monthly charges will be charged for such modifications. </p>
                        <p>8. Stall and Merchandise</p>
                        <p style="text-indent:50px;">The vendor shall be the responsible for the safety and order of his merchandise. MySeoul, Inc. provides security services but will not be liable for any loss or damage including but not limited to improper use of facilities, facility failure, theft, robbery, force majeure, or acts of god. </p>
                        <p>9. Rules and Regulation</p>
                        <p style="text-indent:50px;">Vendor must obey all the rules and regulations given by the management including but not limited to policies, procedures, projects, business practices, merchandise selection and display. Any violation shall be subject to fines, disciplinary action, or termination of contract as deemed by the owner.</p>
                        <p>10. Product storage, handling, and sales</p>
                        <p style="text-indent:50px;">The vendor shall not sell, store, or handle hazardous, illegal, stolen, or counterfeit merchandise or materials within the premises or perimeter of MySeoul Tiangge. All products to be sold, handled, or stored at MySeoul Tiangge are subject to sole written consent of the owner. The owner reserves the rights to reject, disapprove, and dispose any product or merchandise that violates safety and legal standards without prior notification or consent.</p>
						<p>11. Stall Fees</p>

						<style>
						table {
							font-family: arial, sans-serif;
							width: 100%;
						}

						td, th {
							border: 1px solid #dddddd;
							text-align: left;
							padding: 8px;
						}

						
						</style>
						<body>

						<table>
						  <tr>
							<th>Stall Type</th>
							<th>Stall Size</th>
							<th>Stall Utilities</th>
							<th>Schedule of Payment</th>
						  </tr>
						  <tr>
							<td>1		</td>
							<td>		</td>
							<td>		</td>
							<td>		</td>
						  </tr>
						  <tr>
							<td>2		</td>
							<td>		</td>
							<td>		</td>
							<td>		</td>
						  </tr>
						  
						</table>

						</body>
				   </div>
                    <div style="margin-top:5%;">
                        <p style="text-indent:31.5%;">
                            <input type="text" style="border:transparent;border-bottom:2px solid black;width:120px;background-color:transparent" disabled>
                            <input type="text" style="border:transparent;border-bottom:2px solid black;width:120px;background-color:transparent;margin-left:220px;" disabled>
                        </p>
                        <p style="text-indent:30%;margin-top:1%">
                            <label style="margin-left:60px;">Owner</label>
                            <label style="margin-left:22%;">Vendor</label>
                        </p>
                        <p style="text-indent:39%;margin-top:-1%">
                            <label style="margin-left:-10%;">(Signatute over Printed Name)</label>
                            <label style="margin-left:10%;">(Signatute over Printed Name)</label>
                        </p>
                    </div>
                    <div style="margin-left:70%;margin-top:10%">
                        <a href="">
                            <button class="btn btn-success" style="width:200px">Print</button>
                        </a>
                    </div>
                </div>
            </form>
            <br />
            <hr />
            <footer>
                <p>&copy; 2017 - Stall Management System</p>
                <a href="<?php echo e(route('pdfview',['download'=>'pdf'])); ?>">Download PDF</a>
            </footer>
        </div>
    </div>
</body>

</html>