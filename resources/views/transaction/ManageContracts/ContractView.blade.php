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
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/square/blue.css')}}"> @stop @section('content')
<div class="row">
    <div style="margin-left: 20px; margin-bottom: 10px;"> <a href="/StallHolderList" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbsp; Back to StallHolder List</a></div>
    <div class="col-md-12">
        <div class="tabcontent active" id="1">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Contract Details</b></h3> </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><span style="font-size:21px;font-weight: light">Stall Holder:</span> {{$contract->StallHolder->stallHFName.' '.$contract->StallHolder->stallHMName[0].'. '.$contract->StallHolder->stallHLName}} <a href="/getTennant/{{$contract->StallHolder->stallHID}}" style="font-size: 12px">View Details</a></h3> </div>
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
                            <p>{{'₱'.number_format($stall->StallType->StallRate->dblRate,2,'.',',')}}</p>
                        </div>
                        <div class="col-sm-3">
                            <label>Peak Days Additional Rate</label>
                            <p>{{($stall->StallType->StallRate->peakRateType == 1) ? '₱'.$stall->StallType->StallRate->dblPeakRate : $stall->StallType->StallRate->dblPeakAdditional.'% (₱'.number_format(($stall->StallType->StallRate->dblRate * ($stall->StallType->StallRate->dblPeakAdditional / 100)),2,'.',',').')'}} </p>
                        </div>
                        <div class="col-md-6">
                            <label>Location</label>
                            <p>{{(($stall->Floor->floorLevel == '1') ? $stall->Floor->floorLevel.'st' : (($stall->Floor->floorLevel == '2') ? $stall->Floor->floorLevel.'nd' : (($stall->Floor->floorLevel == '3') ? $stall->Floor->floorLevel.'rd' : $stall->Floor->floorLevel.'th'))).' Floor'}}, {{$stall->Floor->Building->bldgName}} Building</p>
                        </div>
                        <div class="col-md-3" id="changeClass">
                            <label for="startdate">Start Date </label>
                            <p>{{$contract->contractStart}}</p>
                        </div>
                        <div class="col-md-3">
                            <label for="startdate">End Date </label>
                            <p>{{$contract->contractEnd}}</p>
                        </div>
                        <div class="col-md-12">
                            <label for="address"><b>List of Products</b></label>
                            <ul>
                                <?php
                                    foreach($prod as $x){
                                        echo "<li>".$x['productName']."</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger btn-flat">Terminate</button>
                                <button type="button" class="btn btn-primary btn-flat tablinks" onclick="openTab('#1', '#2');">Ammend</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabcontent" id="2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Ammend Contract</b></h3> </div>
                <div class="box-body">
                    <div class="row" style="margin-top:20px;margin-left: 15px;">
                        <form id="ammend">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$contract->contractID}}">
                            <div class="col-md-6">
                                <label>End Date</label>
                                <br>
                                <div class="input-group date datepicker" style="width:300px">
                                    <input type="text" class="form-control" name="endDate">
                                    <div class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Stall Rate</label>
                                <br>
                                <select name="rate"> @foreach($rates as $rate)
                                    <option value="{{$rate->stallRateID}}">{{date_format(date_create($rate->stallRateEffectivity),"F d, Y").' - '.'₱'.number_format($rate->dblRate,2,'.',',')}}</option> @endforeach </select>
                            </div>
                        </form>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success btn-flat tablinks" onclick="$('#ammend').submit();">Save</button>
                        <button type="button" class="btn btn-danger btn-flat tablinks" onclick="openTab('#2', '#1');">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>@stop @section('script')
    <script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/icheck.js')}}">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
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
            
            $('#ammend').submit(function(e){
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
    </script>
    <script src="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{ URL::asset('js/phone-ru.js')}}"></script>
    <script src="{{ URL::asset('js/phone-be.js')}}"></script>
    <script src="{{ URL::asset('js/phone.js')}}"></script> @stop