<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 style="display: inline !important;">MySeoul</h4>
                <div class="pull-right" style="display: inline !important;">
                    <h4 style="display: inline !important;">Receipt</h4> </div>
            </div>
            <div class="box-body">
                <div class="col-md-9">
                    <label>Transaction ID:</label> {{date("Ymd",strtotime($data['tran']->created_at)).$data['tran']->transactionID}} </div>
                <div class="col-md-3">
                    <label>Date:</label> {{date("F d, Y")}} </div>
                <div class="col-md-9">
                    <label>Customer Name:</label> {{$data['cont']->StallHolder->stallHFName." ".strtoupper($data['cont']->StallHolder->stallHMName[0]).". ".$data['cont']->StallHolder->stallHLName}}</div>
                <div class="col-md-3">
                    <label>Stall No.:</label> {{$data['cont']->stallID}} </div>
                <div class="col-md-12">
                    <label>Customer Address:</label> {{$data['cont']->StallHolder->stallHAddress}} </div>
                <div class="col-md-12">
                    <label>Contact No:</label> <?php for($i = 0;$i < count($data['cont']->StallHolder->ContactNo);$i++){ echo $data['cont']->StallHolder->ContactNo[$i]->contactNumber; if($i < count($data['cont']->StallHolder->ContactNo) - 1) echo ", ";}?> </div>
                <div class="col-md-12">
                    <label>Email: </label> {{$contract->StallHolder->stallHEmail}}
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:80%">Description</th>
                                <th style="width:20%">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0?>
                            @if(isset($data['init']))
                            @foreach($data['init'] as $i)
                            <tr>
                            <td>
                                {{$i->InitialFee->initDesc}}
                            </td>
                            <td>
                                ₱ {{number_format($i->InitialFee->initAmt,2,'.',',')}}
                            </td>
                            <?php $total += $i->InitialFee->initAmt;?>
                            </tr>
                            @endforeach
                            @endif
                            @if(isset($data['pc']))
                            <tr>
                                <td><label>Collections</label> </td>
                                <td></td>
                            </tr>
                            @foreach($data['pc'] as $p)
                            <tr>
                                <td> {{$p['date']}} - {{date("l",strtotime($p['date']))}} </td>
                                <td> ₱ {{number_format($p['amount'],2,'.',',')}} </td>
                                <?php $total += $p['amount'];?>
                            </tr>
                            @endforeach
                            @endif
                            @if(isset($data['bill']))
                            <tr>
                                <td><label>Bills</label> </td>
                                <td></td>
                            </tr>
                            @foreach($data['bill'] as $b)
                            <tr>
                                <td>
                                    {{date("Ymd000",strtotime($b->created_at)).$b->billDetID}} 
                                </td>
                                <td>
                                </td>
                            </tr>
                            @foreach($b->Billing_Utilities as $util)
                            <tr>
                            <td>
                                {{($util->MonthlyReading->utilType == 1) ? "Electric Bill" : (($util->MonthlyReading->utilType == 2) ? "Water":"Unknown Utility Type")}} 
                            </td>                                                               
                            <td>
                                ₱ {{number_format($util->utilityAmt,2,'.',',')}}
                            </td>
                            </tr>
                            <?php $total += $util->utilityAmt;?>
                            @endforeach
                            @foreach($b->Charges as $charge)
                            <tr>
                            <td>
                                {{($charge->chargeID == null) ? $charge->chargeDesc : $charge->Charges->chargeName}}
                            </td>
                            <td>
                                ₱ {{number_format(($charge->chargeID == null) ? $charge->chargeAmt : $charge->Charges->chargeAmount,2,'.',',')}}
                                <?php $total += number_format(($charge->chargeID == null) ? $charge->chargeAmt : $charge->Charges->chargeAmount,2,'.',',');?>
                            </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 pull-right">
                <lable>Total:</lable>  ₱ {{number_format($total,2,'.',',')}}
                <br>
            </div>
        </div>
        <div class="defaultNewButton pull-right">
            <a href="{{url('/Payment')}}">
                <button class="btn btn-primary btn-flat"><span class='glyphicon glyphicon-print'></span>&nbsp;Print PDF</button>
            </a>
        </div>
    </div>
</div>
</body>
</html>>

