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
	@foreach($req as $r)
	<div style="text-align: center;padding-top: -50px;">
		<h2 >My Seoul Goods and Garments</h2>
		<p style="padding-top: -20px;font-size: 10px;"><b>Manila East Market, B5 Lot 4 Manila East Homes St</b></p>
		<p style="padding-top: -10px;font-size: 10px;"><b>Taytay, 1920 Rizal</b></p>
	</div>
	<div style="text-align: center;padding-top: -30px;">
		@if($r->Type==1)
		<h4>Request for Transfer Stall</h4>
		@elseif($r->Type==2)
		<h4>Request for Leaving Stall</h4>
		@elseif($r->Type==3)
		<h4>Request</h4>
		@endif
	</div>

	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Tenant Name:</h5><span style="font-size: 15px;margin-left: 5px;">{{$r->First}} {{$r->Middle}} {{$r->Last}}</span>
	</div>

	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Status:</h5>
		@if($r->status==1)
		<span style="font-size: 15px;margin-left: 5px;color: green">Approved</span>
		@elseif($r->status==2)
		<span style="font-size: 15px;margin-left: 5px;color: red"> Rejected</span>
		@endif
	</div>

	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Desired Date:</h5>
		<span style="font-size: 15px;margin-left: 5px;">{{$r->desired}}</span>
	</div>

	@if($r->Type==1)
	@foreach($info as $i)
	</div>
	<div style="margin-left: 50px;">
		<h5 style="display: inline;"> From Stall:</h5>
		<b>
			<span style="font-size: 10px;margin-left: 5px;">{{$i->stallFrom}}</span>
		</b>
		<h5 style="display: inline;"> To Stall:</h5>
		<b>
			<span style="font-size: 10px;margin-left: 5px;">{{$i->stallRequested}}</span>
		</b>
	</div>
	@endforeach
	@elseif($r->Type==2)
	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Desired Stall:</h5>
		@foreach($info as $i)
		<b>
			<span style="font-size: 15px;margin-left: 5px;">{{$i->stallFrom}}</span>
		</b>
		@endforeach
			
	</div>
	@elseif($r->Type==3)
	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Subject:</h5>
		<span style="font-size: 15px;margin-left: 5px;">{{$r->subject}}</span>
	</div>
	@endif
	<div style="margin-left: 50px;">
		<h5 style="display: inline;">Reason:</h5>
			<p style="font-size: 15px;margin-left: 50px;">{{$r->reason}}</p>
		
	</div>

		<div style="margin-left: 50px;">
		<h5 style="display: inline;">Remarks:</h5>
		
			<p style="font-size: 15px;margin-left: 5px;">{{$r->remarks}}</p>
		
		
	</div>

	<div style="margin-left: 50px;margin-top: 20px;">
		<b style="padding-top: 20px;">______________</b><br>
		<b style="margin-left: 30px;">Owner</b>

	</div>

	@endforeach
</body>
</html>