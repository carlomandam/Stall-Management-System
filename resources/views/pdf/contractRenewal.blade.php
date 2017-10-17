<html>
<head>
	<title>View Renewal Notice</title>
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
		.body{
			text-align: left;
		}
	</style>

</head>
<body>
	
	<div style="text-align: center;padding-top: -50px;">
		<h2 >My Seoul Goods and Garments</h2>
		<p style="padding-top: -20px;font-size: 10px;"><b>Manila East Market, B5 Lot 4 Manila East Homes St</b></p>
		<p style="padding-top: -10px;font-size: 10px;"><b>Taytay, 1920 Rizal</b></p>
	</div>
	<h6 style="text-align: right;">Printed Date: {{Carbon\Carbon::today()->format('F d,Y')}}</h6>
	<div style="text-align: center;padding-top: -30px;">
		<p><b><i>Contract Renewal Notice</i></b></p>
	</div>

	<div style="margin-left: 50px;">
	@foreach($data as $data)

	<p class="body" style="margin-left: 10px;">	Our records indicate that your Contract in Stall <b><i>{{$data->stallID}} </b></i> &nbsp is due to expire on <b><i> {{$data->endcon}} </b></i></p>
	We are pleased to offer you of renewing your Contract. 
	<p>	If you agree to continue the Contract, all terms and conditions of the stall will remain in full force and effect.</p>
	<p class="body">	I look forward to a continued and rewarding relationship. Feel free to contact me with any questions or concerns.</p>
	@endforeach

	</div>

	
	
	
	
		

	<div style="margin-left: 50px;margin-top: 20px;">
		<

	</div>


</body>
</html>