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
	<h4>Balance Summary as of {{Carbon\Carbon::today()->format('F d,Y')}}</h4>
	<h5 style="text-align: right;">Printed Date: {{Carbon\Carbon::today()->format('F d,Y')}}</h5>
	 <table id = "tblmain"> 

		  <tr>
		    <th>Stall Code</th>
		    <th>Tenant Name</th>
		    <th>Collection Status</th>
		    <th>Total Balance</th>
		  </tr>
		<tbody>
		 @foreach($stalls as $key => $stall)
		  <tr>
		   	<td>{{$totalUnpaid[$key]['stallID']}}</td>
		   	<td>{{$totalUnpaid[$key]['name']}}</td>
		   	@if($totalUnpaid[$key]['status'] == 'COLLECT')
		   	<td style="color: #3c8dbc;"><b>{{$totalUnpaid[$key]['status']}}</b></td>
		   	@elseif($totalUnpaid[$key]['status'] == 'REMINDER')
		    <td style="color: #00a65a;"><b>{{$totalUnpaid[$key]['status']}}</b></td>
		    @elseif($totalUnpaid[$key]['status'] == 'WARNING')
		    <td style="color: #f39c12;"><b>{{$totalUnpaid[$key]['status']}}</b></td>
		    @elseif($totalUnpaid[$key]['status'] == 'LOCK')
		    <td style="color: #FF851B;"><b>{{$totalUnpaid[$key]['status']}}</b></td>
		     @elseif($totalUnpaid[$key]['status'] == 'TERMINATE')
		    <td style="color: #f56954;"><b>{{$totalUnpaid[$key]['status']}}</b></td>
		   	@endif
		   	<td>Php {{$totalUnpaid[$key]['amount']}}</td>
		  </tr>
		  @endforeach
		  <tr>
		  	<td>
		  	</td>
		  	<td>
		  	</td>
		  	<td style="text-align: right; font-weight: bold;">
		  	Total Amount Receivables:
		  	</td>
		  	<td>
		  	Php {{number_format($totalAmtCtr,2)}}
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
