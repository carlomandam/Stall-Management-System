@extends('layout.app') @section('title') {{'Create Bill'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i>Payment and Collection</li>
    <li class="active">Billing</li>
</ol> @stop
<style>
    body {
        margin-left: -80px;
    }
</style> @section('content')
<div class="defaultNewButton">
    <form method="get" action="/ViewBill"> {{csrf_field()}}
        <button class="btn btn-primary btn-flat" name="id" value="{{$contract->contractID}}"><span class='fa fa-arrow-left'></span>&nbsp;Back</button>
    </form>
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="row">
                <div class="col-md-2">
                    <label>Billing Number:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="" class="form-control" disabled value="{{date('Y-m-d')}}"> </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label>Tenant Name:</label>
                </div>
                <div class="col-md-8">
                    <input type="text" name="" class="form-control" disabled value="{{$contract->StallHolder->stallHFName}} {{$contract->StallHolder->stallHMName}} {{$contract->StallHolder->stallHLName}}"> </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label>Stall Code:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="" class="form-control" disabled value="{{$contract->stallID}}"> </div>
                <div class="col-md-2">
                    <label>Business Name:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="" class="form-control" disabled value="{{$contract->businessName}}"> </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <label>Bill Date From:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id='from' name='from' readonly="true" style="cursor:pointer; background-color: #FFFFFF;" /> </div>
                <div class="col-md-2">
                    <label>Bill Date To:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id='datepicker' name='datepicker' readonly="true" style="cursor:pointer; background-color: #FFFFFF;" /> </div>
            </div>
        </div>
    </div>
</div>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <table id="tbl" class="table table-responsive table-striped" role="grid">
                <thead>
                    <tr>
                        <th style="width:5%"></th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody> @foreach($contract->UnbilledUtilities as $util)
                    <tr id="{{$util->stallMeterID}}">
                        <td></td>
                        <td>{{($util->MonthlyReading->utilType == 1) ? "Electricity ": (($util->MonthlyReading->utilType == 2) ? "Water" : "Invalid Utility Type")}}</td>
                        <td>₱ {{number_format($util->utilityAmt,2,'.',',')}}</td>
                    </tr> @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 pull-right">
        <div class="pull-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#update" style="margin-right:">Add Charge</button>
            <button id="createBtn" class="btn btn-success">Create Bill</button>
        </div>
    </div>
</div>
<div class="modal fade" id="update" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Additional Charges</h4> </div>
            <div class="modal-body" style="padding-right: 35px">
                <div class="row">
                    <div class="col-md-12" style="border: 1px solid gray;border-radius: 5px;padding: 10px;margin-left: 10px;margin-right:10px">
                        <label>Charges</label>
                        <table id="chargetbl" class="table table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr style="border-bottom: 1px solid black !important">
                                    <th style="width:5%"></th>
                                    <th style="width:70%">Description</th>
                                    <th style="width:25%">Amount</th>
                                </tr>
                            </thead>
                            <tbody> 
                            @foreach($charges as $c)
                                <tr id="{{$c->chargeID}}">
                                    <td></td>
                                    <td>{{$c->chargeName}}</td>
                                    <td>₱ {{number_format($c->chargeAmount,2,'.',',')}}</td>
                                </tr> 
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12" style="border: 1px solid gray;border-radius: 5px;padding: 10px;margin-left: 10px;margin-right:10px;margin-top: 10px;">
                        <form id="newChargeForm">
                            <div class="form-group">
                                <label>New Charge</label>
                                <br>
                                <label>Description</label>
                                <input type="text" id="chargeDesc" name="chargeDesc" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" id="chargeAmt" name="chargeAmt" class="form-control">
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-success" id="btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript">
    $(document).on('ready', function () {
        $("#createBtn").on('click',function(){
            var form = jQuery('<form>',{
                "action":"/newBill"
                , "method": "POST"
            }).append(jQuery('<input>',{
                "name":"_token"
                , "value": "{{csrf_token()}}"
                , "type": "hidden"   
            }));
            var selected = table.rows({selected:true}).data();

            for(var i = 0; i < selected.length; i++){
                var data = selected[i].DT_RowId.split("_");
                if(data[0] == "newCharge"){
                    form.append(jQuery('<input>',{
                        "name":"newCharge[]"
                        , "value": selected[i][1]+":"+selected[i][2]
                        , "type": "hidden"   
                    }))
                }
                else if(data[0] == "Charge"){
                    form.append(jQuery('<input>',{
                        "name":"charge[]"
                        , "value": data[1]
                        , "type": "hidden"   
                    }))
                }
                else{
                    form.append(jQuery('<input>',{
                        "name":"util[]"
                        , "value": data[0]
                        , "type": "hidden"   
                    }))
                }
            }
            form.append(jQuery('<input>',{
                "name":"dateFrom"
                , "value": $("#from").val()
                , "type": "hidden"   
            }))
            form.append(jQuery('<input>',{
                "name":"dateTo"
                , "value": $("#datepicker").val()
                , "type": "hidden"   
            }))
            form.append(jQuery('<input>',{
                "name":"contract"
                , "value": "{{$contract->contractID}}"
                , "type": "hidden"   
            }))
            form.appendTo("body");
            form.submit();
        });

        var table =  $('#tbl').DataTable({
            'responsive': true
            , "searching": true
            , "paging": true
            , "info": true
            , "retrieve": true
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 0
                    , className: 'select-checkbox'
                }
            ]
            , select: {
                style: 'multi'
                , selector: 'td:first-child'
            }
        });

        var chargeTbl = $('#chargetbl').DataTable({
            'responsive': true
            , "order": [[ 1, "asc" ]]
            , "retrieve": true
            , "bFilter": false
            , "bLengthChange": false
            , "info": false
            , "dom": '<"top"i>rt<"pull-left"pfl><"pull-right" B><"clear">'
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 0
                    , className: 'select-checkbox'
                }
                , {
                    "searchable": false
                    , "targets": [1,2]
                }
            ]
            , select: {
                style: 'multi'
                , selector: 'td:first-child'
            }
            , buttons: [
                {
                    text: 'Add',
                    className: 'btn btn-success',
                    action: function ( e, dt, node, config ) {
                        var rows = chargeTbl.rows({selected:true}).data();
                        var brows = table.rows().data();
                        
                        for(var i=0;i < rows.length;i++){
                            var ok = true;
                            for(var j=0;j < brows.length;j++){
                                if(rows[i][1] == brows[j][1])
                                    ok = false;
                            }
                            if(ok){
                                table.rows.add( [ {
                                    "0": "",
                                    "1": rows[i][1],
                                    "2": rows[i][2],
                                    "DT_RowId": "Charge_"+rows[i].DT_RowId
                                }] ).draw();
                            }
                        }
                    }
                }
            ]
        });

        //if($last == null) 
        $("#from").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'mm/dd/yyyy'
        });
        //else 
        //$("#from").val("{{$last}}");
        //endif

        $("#datepicker").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'mm/dd/yyyy'
        });

        jQuery.validator.addMethod("unique", function (value, element) {
            var rows = table.rows().data();
            
            for(var i=0;i < rows.length;i++){
                if(element.value == rows[i][1])
                    return false;
            }

            return true;
        });

        $("#newChargeForm").validate({
            rules: {
                chargeDesc: {
                    required: true
                    , "unique": true
                }
                , chargeAmt: {
                    required: true
                    , number: true
                }
            }
            , messages: {
                chargeDesc: {
                    required: "Enter charge Description"
                    , "unique": "Charge with the same description already exist"
                }
                , chargeAmt: {
                    required: "Enter charge Amount"
                    , number: "Invalid Amount"
                }
            }
            , errorClass: "error-class"
            , validClass: "valid-class"
        });

        $("#newChargeForm").submit(function(e){
            e.preventDefault();
            if(!$(this).valid())
                return;
            table.rows.add( [ {
                "0": "",
                "1": $("#chargeDesc").val(),
                "2": "₱ " + parseFloat(Math.round($("#chargeAmt").val() * 100) / 100).toFixed(2),
                "DT_RowId": "newCharge"
            }] )
            .draw();
        });
    });
</script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/select.dataTables.min.css')}}">
@stop