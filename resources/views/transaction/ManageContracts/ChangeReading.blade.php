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
        <div class="box box-primary">
            <div class="box-header with-border" style="text-align: center;">
                <h3 class="box-title"><b>{{$stall->stallID}} Current Submeter Reading</b></h3> </div>
            <div class="box-body">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Utility</th>
                                <th>Current Reading</th>
                                <th>Reading Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form id="reading" method="post" action="/UpdateReading">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$contract->contractID}}">
                            @if(count($stall->StallUtility->where('utilityType','1')) != 0)
                            <tr>
                                <td>Electricity</td>
                                <td>
                                    <input type="hidden" name="elecID" value="{{(count($stall->StallUtility->where('utilityType','1')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->subMeterID : ''}}">
                                    <input type="hidden" name="elecUtil" value="{{$stall->StallUtility->where('utilityType','1')->first()->stallUtilityID}}">
                                    <input type="text" name="electricity" class="form-control money" id="sec_amount" disabled value="{{(count($stall->StallUtility->where('utilityType','1')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->presRead : ''}}"> </td>
                                <td>
                                    <input type="text" name="secDate" class="form-control datepicker" id="sec_date" disabled value="{{(count($stall->StallUtility->where('utilityType','1')->first()->Submeter) > 0) ? date('F d, Y',strtotime($stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->updated_at)) : ''}}" style="text-align: center"> </td>
                            </tr>
                            @endif
                            @if(count($stall->StallUtility->where('utilityType','2')) != 0)
                            <tr>
                                <td>Water</td>
                                <td>
                                    <input type="hidden" name="waterID" value="{{(count($stall->StallUtility->where('utilityType','2')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','2')->first()->Submeter()->latest()->first()->subMeterID : ''}}">
                                    <input type="hidden" name="waterUtil" value="{{$stall->StallUtility->where('utilityType','2')->first()->stallUtilityID}}">
                                    <input type="text" name="water" class="form-control money" id="main_amount" value="{{(count($stall->StallUtility->where('utilityType','2')->first()->Submeter) > 0) ? $stall->StallUtility->where('utilityType','2')->first()->Submeter()->latest()->first()->presRead : ''}}" disabled> </td>
                                <td>
                                    <input type="text" name="mainDate" class="form-control datepicker" id="main_date"  value="{{(count($stall->StallUtility->where('utilityType','2')->first()->Submeter) > 0) ? date('F d, Y',strtotime($stall->StallUtility->where('utilityType','1')->first()->Submeter()->latest()->first()->updated_at)) : ''}}" style="text-align: center" disabled> </td>
                            </tr>
                            @endif
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <div class = "col-md-6"></div>
                <div class = "col-md-4" style="text-align: right;">
                    <button class = "btn btn-flat btn-info" id="edit">Edit</button>
                    <button id="save" onclick="$('#reading').submit()" class = "btn btn-flat btn-primary" data-id='util_initial_fee' disabled>Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div> @stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/multipleAddinArea.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/icheck.js')}}">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#edit').on('click', function(){
            $('#sec_amount').prop("disabled",false);
            $('#main_amount').prop("disabled",false);
            $('#save').prop("disabled",false);
        });

        $(".money").inputmask("9999999", { numericInput: true, placeholder: "0",clearMaskOnLostFocus: false});
    });
</script>
<script src="{{ URL::asset('js/jquery.inputmask.bundle.js')}}"></script>
<script src="{{ URL::asset('js/phone-ru.js')}}"></script>
<script src="{{ URL::asset('js/phone-be.js')}}"></script>
<script src="{{ URL::asset('js/phone.js')}}"></script> @stop