@extends('layout.app') @section('title') {{ 'Payment'}} @stop @section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style type="text/css">
    .col-md-12,
    .row {
        margin-top: 10px;
    }
    
    table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
        cursor: pointer;
    }
    
    #table2,
    #backButton {
        display: none;
    }
</style> @stop @section('content-header') @stop @section('content')
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
                    <label>Transaction ID:</label> #00001 </div>
                <div class="col-md-3">
                    <label>Date:</label> {{date("F d, Y")}} </div>
                <div class="col-md-9">
                    <label>Customer Name:</label> {{$contract->StallHolder->stallHFName." ".strtoupper($contract->StallHolder->stallHMName[0]).". ".$contract->StallHolder->stallHLName}}</div>
                <div class="col-md-3">
                    <label>Stall No.:</label> {{$contract->stallID}} </div>
                <div class="col-md-12">
                    <label>Customer Address:</label> {{$contract->StallHolder->stallHAddress}} </div>
                <div class="col-md-12">
                    <label>Contact No:</label> <?php for($i = 0;$i < count($contract->StallHolder->ContactNo);$i++){ echo $contract->StallHolder->ContactNo[$i]->contactNumber; if($i < count($contract->StallHolder->ContactNo) - 1) echo ", ";}?> </div>
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
                            @if(isset($init))
                            @foreach($init as $i)
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
                            @if(isset($pc))
                            <tr>
                                <td><label>Collections</label> </td>
                                <td></td>
                            </tr>
                            @foreach($pc as $p)
                            <tr>
                                <td> {{$p['date']}} - {{date("l",strtotime($p['date']))}} </td>
                                <td> ₱ {{number_format($p['amount'],2,'.',',')}} </td>
                                <?php $total += $p['amount'];?>
                            </tr>
                            @endforeach
                            @endif
                            @if(isset($bill))
                            <tr>
                                <td><label>Bills</label> </td>
                                <td></td>
                            </tr>
                            @foreach($bill as $b)
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
                <lable>Amount Paid:</lable>
                <br> </div>
            </div>
        </div>
        <div class="defaultNewButton pull-right">
            <a href="{{url('/Payment')}}">
                <button class="btn btn-primary btn-flat"><span class='glyphicon glyphicon-print'></span>&nbsp;Print PDF</button>
            </a>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript">
    $(document).on('ready', function () {
       
    });
</script> @stop