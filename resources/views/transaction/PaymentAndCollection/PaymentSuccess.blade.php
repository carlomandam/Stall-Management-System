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
                    <label>Customer Name:</label> Carl Omandam </div>
                <div class="col-md-3">
                    <label>Stall No.:</label> MAIN-101 </div>
                <div class="col-md-12">
                    <label>Customer Address:</label> Blk 14 Lot 4 Pamahay Village, San Jose, Rodriguez, Rizal </div>
                <div class="col-md-12">
                    <label>Contact No:</label> 09490059388 </div>
                <div class="col-md-12">
                    <label>Email:</label>
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
                            <tr>
                                <td> Rental Fee October 11, 2017 </td>
                                <td> Php. 200.00 </td>
                            </tr>
                            <tr>
                                <td> Rental Fee October 12, 2017 </td>
                                <td> Php. 200.00 </td>
                            </tr>
                            <tr>
                                <td> Rental Fee October 13, 2017 </td>
                                <td> Php. 200.00 </td>
                            </tr>
                            <tr>
                                <td> Rental Fee October 14, 2017 </td>
                                <td> Php. 200.00 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 pull-right">
                <lable>Total:</lable> Php. 800.00
                <br>
                <lable>Amount Paid:</lable> Php. 800.00
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
    $(document).on('ready', function () {});
</script> @stop