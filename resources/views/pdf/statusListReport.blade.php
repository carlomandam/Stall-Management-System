<html>
<head>
	<title>View Status List Report</title>
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
	<h4>Status List Report as of {{Carbon\Carbon::today()->format('F d,Y')}}</h4>
	<h5 style="text-align: right;">Printed Date: {{Carbon\Carbon::today()->format('F d,Y')}}</h5>
	 <table id = "tblmain"> 

		  <tr>
		    <th>Collection Status</th>
		    <th>No. of Stall/s</th>
		    <th>Total Amount</th>
		  </tr>
		<tbody>
		 @for($i =0; $i< 6; $i++)
		  <tr>
		   	@if($stallStatus[$i]['status'] == 'COLLECT')
		   	<td style="color: #3c8dbc;"><b>{{$stallStatus[$i]['status'] }}</b></td>
		   	@elseif($stallStatus[$i]['status']  == 'REMINDER')
		    <td style="color: #00a65a;"><b>{{$stallStatus[$i]['status'] }}</b></td>
		    @elseif($stallStatus[$i]['status']  == 'WARNING')
		    <td style="color: #f39c12;"><b>{{$stallStatus[$i]['status'] }}</b></td>
		    @elseif($stallStatus[$i]['status']  == 'LOCK')
		    <td style="color: #FF851B;"><b>{{$stallStatus[$i]['status'] }}</b></td>
		     @elseif($stallStatus[$i]['status']  == 'TERMINATE')
		    <td style="color: #f56954;"><b>{{$stallStatus[$i]['status'] }}</b></td>
		    @elseif($stallStatus[$i]['status']  == 'VACANT')
		    <td style = "color: #D81B60"><b>
		    {{$stallStatus[$i]['status'] }}</b></td>
		   	@endif
		  	<td>
		  {{	$stallStatus[$i]['count'] }}
		  	</td>
		  	<td style="text-align: right;">Php
		  {{number_format($stallStatus[$i]['amount'],2) }}
		  	</td>
		  </tr>
		  @endfor
		  <tr>
		  
		  	<td>
		  	</td>
		  	<td style="text-align: left;">
		  	Total Stalls: {{$stallctr}}
		  	</td>
		  	<td style="text-align: right;">
		  	Total Amount Receivables: Php {{number_format($amtReceive,2)}}
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