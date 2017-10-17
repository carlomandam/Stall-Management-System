<html>
<head>
	<title>View Payment Collected Report</title>
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
	<h4>Collected Report as for 
	@if($end == $start)
	{{ Carbon\Carbon::parse($start)->format('F d,Y')}}
	@else
	{{Carbon\Carbon::parse($start)->format('F d,Y')}} to {{Carbon\Carbon::parse($end)->format('F d,Y')}}
	@endif </h4>
	<h5 style="text-align: right;">Printed Date: {{Carbon\Carbon::today()->format('F d,Y')}}</h5>
	 <table id = "tblmain"> 

		  <tr>
		    <th>Payment Number</th>
		    <th>Tenant Name</th>
		    <th>Date</th>
		    <th>Amount</th>
		  </tr>
		<tbody>
		@for($i = 0; $i < $size; $i ++)
		<tr>
			<td>{{$data[$i]['paymentID']}}</td>
			<td>{{$data[$i]['tenantName']}}</td>
			<td>{{$data[$i]['paymentDate']}}</td>
			<td>Php {{$data[$i]['totalAmt']}}</td>
		</tr>
		@endfor
		  <tr>
		  	<td>
		  	</td>
		  	<td>
		  	</td>
		  	<td style="text-align: right; font-weight: bold;">
		  	Total Amount Received:
		  	</td>
		  	<td>
		  	Php {{number_format($total,2)}}
		  	</td>
		  </tr>
  		</tbody>

  
 
	</table>
	<div class = "row" style="margin-left: 10px;">
		
             <p style="margin-top: 50px;">Printed By:</p>
             <p>{{ Auth::user()->name }}</p>
            

             
			
	</div>


</body>
</html>
