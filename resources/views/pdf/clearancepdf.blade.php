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
	<div style="text-align: center;padding-top: -50px;">
		<h2 >My Seoul Goods and Garments</h2>
		<p style="padding-top: -20px;font-size: 10px;"><b>Manila East Market, B5 Lot 4 Manila East Homes St</b></p>
		<p style="padding-top: -10px;font-size: 10px;"><b>Taytay, 1920 Rizal</b></p>
	</div>

	<div style="text-align: center;">
		<h3>Clearance of Payment</h3>
	</div>

	<div style="text-align: left;">
		<b style="display: inline;margin-top: 20px;">To:</b>
		@foreach($tenants as $t)
		<span>{{$t->first}} {{$t->middle}} {{$t->last}}</span>
		@endforeach
		<span></span>
	</div>


	<div style="text-align: left;">
		<b style="display: inline;margin-top: 20px;">From stall:</b>
		@foreach($tenants as $t)
		<span>{{$t->stall}}</span>
		@endforeach
		<span></span>
	</div>
	<div style="text-align: left; margin-top: 20px;">
		<b style="display: inline">MR/MS:</b>
		
	</div>

	<div style="text-align:left;">
		<p >This is to certify that your request had been approved and the same is accepted, suject to no dues on your account. </p>
		<p>Arrangement has been made for you to completely empty the stall and void of any personal belongings.</p>
		<p>We thank you for your cooperation!</p>

		<p>Sincerly,</p>
		<p> The Management</p>
	</div>
	
</body>
</html>