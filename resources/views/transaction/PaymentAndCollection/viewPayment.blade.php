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
    
    #tblDateRange {
        border-collapse: collapse;
    }
    
    #tblDateRange td {
        border: none;
    }
</style> @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol> @stop @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="defaultNewButton">
            <a href="{{url('/Payment')}}">
                <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</button>
            </a>
        </div>
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Payments</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Advance Collection</a></li>
                    <li><a href="#tab3" data-toggle="tab">Payment History</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row">
                                    <label class="col-md-3">Payment Number</label>
                                    <div class="col-md-3">
                                        <label class="form-control">{{$payID}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3">Stall Code</label>
                                    <div class="col-md-3">
                                        <label class="form-control">{{$contract->stallID}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3">Tenant Name</label>
                                    <div class="col-md-3">
                                        <label class="form-control">{{\Illuminate\Support\Str::upper($contract->StallHolder->stallHFName)}} {{\Illuminate\Support\Str::upper($contract->StallHolder->stallHMName)}} {{\Illuminate\Support\Str::upper($contract->StallHolder->stallHLName)}}</label>
                                    </div>
                                    <label class="col-md-3">Date</label>
                                    <div class="col-md-3">
                                        <label class="form-control">{{\Illuminate\Support\Str::upper(\Carbon\Carbon::today()->format('F d,Y'))}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-3">Collection Status</label>
                                    <div class="col-md-3">
                                        <label class="form-control"></label>
                                    </div>
                                    <label class="col-md-3">Balance</label>
                                    <div class="col-md-3">
                                        <label class="form-control"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-right" style="margin-right:5%">
                                            <label>Amount</label>
                                        </div>
                                    </div>
                                    <?php $total = 0;?> @if(count($contract->UnpaidInitial) > 0)
                                        <div class="col-md-12">
                                            <label>Initial Fee</label>
                                            <ul style="list-style:none"> @foreach($contract->UnpaidInitial as $i)
                                                <li>{{$i->InitialFee->initDesc}}
                                                    <input type="hidden" name="init[]" value="{{$i->initDetID}}">
                                                    <div class="pull-right" style="margin-right:5%">₱ {{number_format($i->InitialFee->initAmt,2,'.',',')}}</div>
                                                </li>
                                                <?php $total += $i->InitialFee->initAmt;?> @endforeach </ul>
                                        </div> @endif @if(count($unpaidCollections) > 0)
                                        <div class="col-md-12">
                                            <label>Unpaid Collection</label>
                                            <ul style="list-style:none"> @foreach($unpaidCollections as $u)
                                                <li>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="unpaid[]" style="width: 15px;height: 15px" type="checkbox" value=""> {{$u['date']}} </label>
                                                    </div>
                                                    <div class="pull-right" style="margin-right:5%">₱ {{number_format($u['amount'],2,'.',',')}} </div>
                                                </li>
                                                <?php $total += $u['amount']; ?> @endforeach </ul>
                                        </div> @endif </div>
                                <div class="row">
                                    <label class="col-md-3"></label>
                                    <div class="col-md-3">
                                        <label>Total Amount: ₱ {{number_format($total,2,'.',',')}}</label>
                                    </div>
                                    <label class="col-md-3">Amount Received:</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" /> </div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="col-md-12">
                                <a class="btn btn-primary btn-flat" id="save" style="width:100px; margin: 20px;" href="/StallHolderList"> <i class="fa fa-save"></i> Save</a>
                            </div>
                        </div>
                        <!-- box box-primary -->
                    </div>
                    <!-- tab1primary -->
                    <div class="tab-pane fade" id="tab2primary">
                        <form>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Payment Number:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-control">{{$payID}}</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                            <label>Tenant Name:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-control">{{\Illuminate\Support\Str::upper($contract->StallHolder->stallHFName)}} {{\Illuminate\Support\Str::upper($contract->StallHolder->stallHMName)}} {{\Illuminate\Support\Str::upper($contract->StallHolder->stallHLName)}}</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                            <label>Stall Code:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-control">{{$contract->stallID}}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Business Name:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-control"> {{\Illuminate\Support\Str::upper($contract->businessName)}}</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-2">
                                            <label>Date From:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label id="dateFrom" name="dateFrom" class="form-control">{{$dateFrom}}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Date To:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="datepicker form-control" id='dateTo' name='dateTo' readonly="true" style="cursor:pointer; background-color: #FFFFFF;" /> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box  box-primary" style="margin-top:30px;">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="tbladpay" class="table table-bordered table-striped display select" role="grid">
                                            <thead>
                                                <th>
                                                    <input name="select_all" value="1" type="checkbox">
                                                </th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" style="text-align: right; ">Total Amount:</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-3"></div>
                                        <label class="col-md-3">Amount to be Paid:</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" id="sum" disabled="" /> </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-3"></div>
                                        <label class="col-md-3">Amount Received:</label>
                                        <div class="col-md-3">
                                            <input type="text" id="amtPaid" name="amtPaid" class="form-control" /> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <div class="col-md-12">
                                    <a class="btn btn-primary btn-flat" id="adsave" style="width:100px; margin: 20px;"> <i class="fa fa-save"></i> Save</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <form>
                            <div class="table-responsive">
                                <table class="table table-condensed" style="margin-top: 20px;" id="tblDateRange">
                                    <tr>
                                        <td>
                                            <label>Date Range</label>
                                        </td>
                                        <td>
                                            <input type="text" class="datepicker form-control" id='rangeFrom' name='rangeFrom' readonly="true" style="cursor:pointer; background-color: #FFFFFF;" disabled="" />
                                        </td>
                                        <td>&nbsp;to</td>
                                        <td>
                                            <input type="text" class="datepicker form-control" id='rangeTo' name='rangeTo' readonly="true" style="cursor:pointer; background-color: #FFFFFF;" disabled="" />
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-flat" id="generate"> <i class="fa fa-angle-double-right"></i> Go</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label id="summary" style="margin-left: 4px;">Summary For</label>
                                </div>
                            </div>
                            <div class="box  box-primary" style="margin-top:30px;">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="tblhistory" class="table table-bordered table-striped display" role="grid">
                                            <thead>
                                                <th width="100px">Payment Number</th>
                                                <th width="100px">Date Paid</th>
                                                <th width="200px">Description</th>
                                                <th width="100px">Amount</th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- col-md-12-->
</div>
<!-- row-->@stop @section('script')
<script type="text/javascript">
    var sum = 0;
    var array = [];
    $(document).on('ready', function () {
        $("#rangeFrom").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: '{{$contract->contractStart}}'
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#rangeTo').datepicker('setStartDate', minDate);
        });
        $("#rangeTo").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
        $(".datepicker").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: '{{$dateFrom}}'
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
        $('#generate').on('click', function (e) {
            if ($('#rangeFrom').val().length === 0 || $('#rangeTo').val().length === 0) {
                toastr.error('Fill missing fields');
            }
            else {
                $('#summary').html("Summary for " + $('#rangeFrom').val() + " to " + $('#rangeTo').val());
                e.preventDefault();
                var _token = $("input[name='_token']").val();
                var contractID = "{{$contract->contractID}}";
                var dateFrom = $('#rangeFrom').val();
                var dateTo = $('#rangeTo').val();
                $.ajax({
                    type: "GET"
                    , url: "/ViewPaymentHistory"
                    , data: {
                        '_token': $('input[name=_token]').val()
                        , 'contractID': contractID
                        , 'dateFrom': dateFrom
                        , 'dateTo': dateTo
                    }
                    , success: function (data) {
                        if ($.isEmptyObject(data.error)) {
                            var table = $('#tblhistory').DataTable({
                                "aaData": data
                                , destroy: true
                                , "columns": [
                                    {
                                        "data": "paymentID"
                                    }
                                    , {
                                        "data": "paidDate"
                                    }
                                    , {
                                        "data": "description"
                                    }
                                    , {
                                        "data": "paidAmt"
                                    }
                     ]
                            });
                        }
                        else {
                            printErrorMsg(data.error);
                        }
                    }
                });

                function printErrorMsg(msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display', 'block');
                    $.each(msg, function (key, value) {
                        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    });
                }
            }
        });
        $('#tbladpay').dataTable({});
        $('#tblpay').dataTable({});
        var contractID = "{{$contract->contractID}}";
        var dateFrom = $('#rangeFrom').val();
        var dateTo = $('#rangeTo').val();
        $.ajax({
            type: "GET"
            , url: "/ViewPaymentHistory"
            , data: {
                '_token': $('input[name=_token]').val()
                , 'contractID': contractID
                , 'dateFrom': dateFrom
                , 'dateTo': dateTo
            }
            , success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    var table = $('#tblhistory').DataTable({
                        "aaData": data
                        , destroy: true
                        , "columns": [
                            {
                                "data": "paymentID"
                            }
                            , {
                                "data": "paidDate"
                            }
                            , {
                                  "data": "description"
                            }
                            , {
                                "data": "paidAmt"
                            }
                     ]
                    });
                }
                else {
                    printErrorMsg(data.error);
                }
            }
        });
        $("#tblhistory").DataTable({
            responsive: {
                details: false
            }
        });
        var rows_selected = [];
        $("#dateTo").on('change', function () {
            sum = 0;
            $("#sum").val(sum);
            var dateFrom = $('#dateFrom').text();
            var contractID = "{{$contract->contractID}}";
            var dateTo = $("#dateTo").val();
            var rows_selected = [];
            $.ajax({
                type: "get"
                , url: "/collectionTable"
                , cache: false
                , data: {
                    dateFrom: dateFrom
                    , dateTo: dateTo
                    , contractID: contractID
                }
            }).done(function (data) {
                var table = $('#tbladpay').DataTable({
                    "aaData": data
                    , destroy: true
                    , "columns": [
                        {
                            "data": "cb"
                        }
                        , {
                            "data": "date"
                        }
                        , {
                            "data": "desc"
                        }
                        , {
                            "data": "amount"
                        }
               ]
                });
                $('#tbladpay').dataTable({
                    destroy: true
                    , "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        /*
                         * Calculate the total market share for all browsers in this table (ie inc. outside
                         * the pagination)
                         */
                        var iTotalMarket = 0;
                        for (var i = 0; i < aaData.length; i++) {
                            iTotalMarket += parseFloat(aaData[i][3]) * 1;
                        }
                        /* Calculate the market share for browsers on this page */
                        var iPageMarket = 0;
                        for (var i = iStart; i < iEnd; i++) {
                            iPageMarket += parseFloat(aaData[aiDisplay[i]][3]) * 1;
                        }
                        /* Modify the footer row to match what we want */
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[1].innerHTML = "Php " + " " + parseFloat(iPageMarket).toFixed(2) + " (Php " + parseFloat(iTotalMarket).toFixed(2) + " total)";
                    }
                });
            });
        });
    });
    // Handle click on table cells with checkboxes
    $('#tbladpay').on('click', 'tbody td, thead th:first-child', function (e) {
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });
    $('#tbladpay').on('click', 'input[type="checkbox"]', function () {
        // var price = parseInt(($(this).find('td').last().html()));
        var row = $(this).closest('tr');
        var price = parseInt((row.find('td').last().html()));
        var data = row.find('td:eq(1)').text();
        if ($(this).prop('checked') == false) {
            sum -= price;
            var i = array.indexOf(data);
            if (i != -1) {
                array.splice(i, 1);
            }
        }
        else {
            sum += price;
            if (array.indexOf(data) == -1) {
                array.push(data);
            }
        }
        $('#sum').val("Php " + " " + parseFloat(sum).toFixed(2));
    });
    $(document).on('click', '#adsave', function (e) {
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var contractID = "{{$contract->contractID}}";
        var dates = array;
        var money = $('#amtPaid').val();
        $.ajax({
            type: "POST"
            , url: "/Collection"
            , data: {
                '_token': $('input[name=_token]').val()
                , 'contractID': contractID
                , 'dates': dates
                , 'money': money
            }
            , success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    toastr.success(data.success);
                    window.location = '/ViewPayment/' + "{{$contract->contractID}}";
                }
                else {
                    printErrorMsg(data.error);
                }
            }
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
</script> @stop