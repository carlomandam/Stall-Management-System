<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="100%">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <style type="text/css">
        @page{
            margin-top: 1cm;
            margin-bottom: 0.25cm;
        }
        body{
            font-family: "SegoeUI","Sans-serif";
            font-size: 12px;
        }
        .header{
            font-size: 20px!important;
        }
        .banner{
            font-size: 13px!important;
        }
        .banner1{
            font-size: 12px!important;
        }
        .page-break {
            page-break-after: always;
        }
        .center{
            text-align: center;
        }
        .col-md-12{
            width: 100%;
        }
        .col-md-6{
            width: 50%;
        }
        .border{
            border: 1px solid black;
        }
        .text-right{
            text-align: right;
        }
        table{
            clear: both;
            border: 1px solid black
        }
        tbody tr{
            border: 1px solid black;
        }
        tr:nth-child(even) {
            background-color: #e6e6e6
        }
        th{
            background-color: black;
            color: white;
        }
        .footer{
            position: absolute;
            bottom: 0;
        }
        .footerd{
            font-size: 0.8em;
        }
    </style>
    <body>
        <div class="center header">
            <b>Bill</b>
        </div>
        <div >
            <b style=" font-size: 20px!important">My Seoul</b> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b style=" font-size: 14px!important">Date:{{ Carbon\Carbon::now()->format('F d, Y')}}</b>
          
        </div>
        <div class="banner">
            <b>Goods and Garments</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b style="margin-left: 30px;">Bill No: {{$billID}}</b>
        </div>
         <div class="banner1">
            <b>L4 B5 Manila East Homes St. San juan Taytay,Rizal</b>
        </div>
        <div>
            <table width="100%" border="1px solid black">
                <thead >                    
                    <tr>
                        <th colspan="2">Billing Information</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  width="25%"><b>Stall Code:</b></td>
                        <td>{{$billing->StallRental->Stall->stallID}}</td>
                    </tr>
                    <tr>
                        <td  width="25%"><b>Stall Holder:</b></td>
                        <td  width="75%">{{$billing->StallRental->StallHolder->stallHFName." ".$billing->StallRental->StallHolder->stallHLName}}</td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
        <div  style="margin-top: 5px;">
            <b style="font-size: 15px;">Billing Details</b>
        </div>
        <div class="col-md-12">
            <table width="100%">
                <thead >                    
                    <tr>
                        <th style="">Date</th>
                        <th style="">Description</th>
                        <th style="">Amount</th>
                      
                    </tr>
                </thead>
                <tbody>
                   
                    <tr>
                        <td>{{$billing->billDateFrom}} to {{$billing->billDateTo}}</td>
                         @foreach($contract as $con)
                            @if($con->StallRate->frequencyDesc==1)
                             <td>Monthly Rate</td>
                            @elseif($con->StallRate->frequencyDesc==2)
                               <td>Weekly Rate</td>
                            @elseif($con->StallRate->frequencyDesc==3)
                               <td>Daily Rate</td>
                            @endif
                        
                        @foreach($con->StallRate->RateDetail as $rd)
                       
                        <td>Php {{number_format($rd->dblRate,2)}} </td>
                        @endforeach
                     
                    </tr>
                  
                </tbody>
            </table>
        </div>
        <div style="margin-top: 10px;margin-left: 77%;">
            <b style="font-size: 15px;">Total:</b>
            <b style="font-size: 14px;color: red;">Php {{number_format($rd->dblRate,2)}}</b>
        </div>
        <div>
            
                        @endforeach
        </div>
    </body>
</html>