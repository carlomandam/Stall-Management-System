@extends('layout.app') @section('title') {{ 'Registration'}} @stop @section('content-header')
<style>
    .tabcontent {
        display: none
    }
    
    .active {
        display: block;
        transition: 1s;
    }
    
    label {
        margin-top: 10px;
    }
    
    p {
        margin-left: 14px;
    }
</style>
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Transactions </li>
    <li><a href="{{ url('/StallHolderList') }}">Manage Contracts</a></li>
    <li>Registration</li>
</ol>
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/square/blue.css')}}"> @stop @section('content')
<div class="row">
    <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="/StallHolderList" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbsp; Back to StallHolder List</a></div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Contract Details</b></h3>
                @if($contract->NextContract != null)
                <div class="pull-right" style="display:inline !important;">
                    <h4 style="display:inline !important;">Note: This contract is renewed.</h4> 
                </div>
                @endif
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3><span style="font-size:21px;font-weight: light">Stall Holder:</span> {{$contract->StallHolder->stallHFName.' '.(($contract->StallHolder->stallHMName != null) ? $contract->StallHolder->stallHMName[0].'. ': '').$contract->StallHolder->stallHLName}} <a href="/getTennant/{{$contract->StallHolder->stallHID}}" style="font-size: 12px">View Details</a></h3> </div>
                    <div class="col-md-12">
                        <label for="bussiname" style="font-size:18px;font-weight: normal">Business Name: <span style="font-size:20px;font-weight: normal">{{$contract->businessName}}</span> <a href="#" style="font-size: 12px"><span class='glyphicon glyphicon-pencil'></span>Rename</a></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Stall Code</label>
                        <p>{{$stall->stallID}}</p>
                    </div>
                    <div class="col-sm-3">
                        <label>Stall Type</label>
                        <p>{{$stall->StallType->StallType->stypeName }} ({{$stall->StallType->StallTypeSize->stypeArea}} m&sup2)</p>
                    </div>
                    <div class="col-sm-3">
                        <label>Stall Rate</label>
                        <p>{{'₱ '.number_format($stall->StallType->StallRate->dblRate,2,'.',',')}}</p>
                    </div>
                    <div class="col-sm-3">
                        <label>Peak Days Additional Rate</label>
                        <p>{{($stall->StallType->StallRate->peakRateType == 1) ? '₱ '.number_format($stall->StallType->StallRate->dblPeakAdditional,2,'.',',') : $stall->StallType->StallRate->dblPeakAdditional.'% (₱ '.number_format(($stall->StallType->StallRate->dblRate * ($stall->StallType->StallRate->dblPeakAdditional / 100)),2,'.',',').')'}} </p>
                    </div>
                    <div class="col-md-6">
                        <label>Location</label>
                        <p>{{(($stall->Floor->floorLevel == '1') ? $stall->Floor->floorLevel.'st' : (($stall->Floor->floorLevel == '2') ? $stall->Floor->floorLevel.'nd' : (($stall->Floor->floorLevel == '3') ? $stall->Floor->floorLevel.'rd' : $stall->Floor->floorLevel.'th'))).' Floor'}}, {{$stall->Floor->Building->bldgName}} Building</p>
                    </div>
                    <div class="col-md-3" id="changeClass">
                        <label for="startdate">Start Date </label>
                        <p>{{date("F d, Y",strtotime($contract->contractStart))}}</p>
                    </div>
                    <div class="col-md-3">
                        <label for="startdate">End Date </label>
                        <p>{{date("F d, Y",strtotime($contract->contractEnd))}}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="address"><b>Products</b></label>
                        <p>
                            <?php
                                for($i = 0;$i<count($prod);$i++){
                                    echo $prod[$i]['productName'].(($i < count($prod)-1) ? ", ":'');
                                }
                            ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label>Utilities <a href="#" id="initial" style="font-size: 12px">Change Current Reading</a></label>
                        <p>@for($i=0;$i < count($stall->StallUtility);$i++) {{($stall->StallUtility[$i]->utilityType == 1) ? "Electricity":(($stall->StallUtility[$i]->utilityType == 2) ? "Water" : "Unkown Utility")}}@if($i < count($stall->StallUtility)-1), @endif @endfor
                        </p>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#confirm-terminate">Terminate</button>
                            @if($contract->contractEnd <= date("Y-m-d", strtotime("+1 month")) && $contract->NextContract == null)
                            <button type="button" class="btn btn-primary btn-flat tablinks" data-toggle="modal" data-target="#confirm-extend">Extend</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-extend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Renew Contract</h4>
            </div>
        
            <div class="modal-body">
                <p>Are you sure you want to renew this contract?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success btn-ok" onclick='renewContract()' data-dismiss="modal">Proceed</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-terminate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Terminate Contract</h4>
            </div>
        
            <div class="modal-body">
                <p>Are you sure you want to terminate this contract?</p>
                <p>Note: <span class="required">THIS PROCEDURE IS IRREVERSIBLE</span></p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" onclick='terminateContract()' data-dismiss="modal">Proceed</a>
            </div>
        </div>
    </div>
</div>
@stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/icheck.js')}}">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#initial").on('click',function(){
            var form = jQuery('<form>',{
                "action":"/ChangeReading"
                , "method": "POST"
            }).append(jQuery('<input>',{
                "name":"_token"
                , "value": "{{csrf_token()}}"
                , "type": "hidden"   
            }));

            form.append(jQuery('<input>',{
                "name":"id"
                , "value": "{{$contract->contractID}}"
                , "type": "hidden"   
            }));

            form.appendTo("body");
            form.submit();
            return false;
        });

        $(".datepicker").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "dateToday"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'mm/dd/yyyy'
        });

        $('#ammend').submit(function (e) {
            e.preventDefault();
            var formdata = new FormData($(this)[0]);
            $.ajax({
                type: "POST"
                , url: '/ammendContract'
                , data: formdata
                , processData: false
                , contentType: false
                , context: this
                , success: function (data) {
                    if (data == "same") {
                        toastr.warning('Nothing Change');
                    }
                    else {
                        toastr.success('Contract Ammended');
                        setTimeout(function () {
                            window.location = "/ViewContract/" + data;
                        }, 3000);
                    }
                }
            });
        });
    });

    function openTab(from, to) {
        $(from).fadeOut(function () {
            $(this).removeClass('active')
            $(to).fadeIn(function () {
                $(this).addClass('active');
            })
        });
    }

    function renewContract(){
        var form = jQuery('<form>',{
                "action":"/RenewContract"
                , "method": "POST"
            }).append(jQuery('<input>',{
                "name":"_token"
                , "value": "{{csrf_token()}}"
                , "type": "hidden"   
            })).append(jQuery('<input>',{
                "name":"id"
                , "value": "{{$contract->contractID}}"
                , "type": "hidden"   
            }));
        form.appendTo("body");
        form.submit();
    }
    function terminateContract(){
        var form = jQuery('<form>',{
                "action":"/rejectRental"
                , "method": "POST"
            }).append(jQuery('<input>',{
                "name":"_token"
                , "value": "{{csrf_token()}}"
                , "type": "hidden"   
            })).append(jQuery('<input>',{
                "name":"id"
                , "value": "{{$contract->contractID}}"
                , "type": "hidden"   
            }));
        form.appendTo("body");
        form.submit();
    }
</script>
<script src="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
<script src="{{ URL::asset('js/phone-ru.js')}}"></script>
<script src="{{ URL::asset('js/phone-be.js')}}"></script>
<script src="{{ URL::asset('js/phone.js')}}"></script> @stop