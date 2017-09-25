@extends('layout.app')

@section('title')
{{ 'Payment'}}
@stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/bootstrap/css/panel-tab.css')}}">
<style type="text/css">
    .col-md-12{
        margin-top: 10px;
    }
</style>
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
</ol>
@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab">Payments</a></li>
                    <li><a href="#tab2primary" data-toggle="tab">Advance Payments</a></li>
                                   
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <div class="box box-primary">
                            <div class="box-body">
                              <div class="col-md-12">
                                <label class="col-md-3">Payment No.</label>
                                <div class="col-md-3"> 
                                  <input type="text" disabled="" class="form-control">
                                </div>
                                <label class="col-md-3">Date Paid</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask/>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <label class="col-md-3">Stall Code</label>
                                <div class="col-md-3"> 
                                  <input type="text" disabled="" class="form-control">
                                </div>
                              </div>

                              <div class="col-md-12">
                                <label class="col-md-3">StallHolder Name</label>
                                <div class="col-md-3"> 
                                  <input type="text" disabled="" class="form-control">
                                </div>
                              </div>

                            </div>
                        </div>
                        <!-- box box-primary -->
                    </div>
                    <!-- tab1primary -->
                    <div class="tab-pane fade" id="tab2primary">
                        <div class="box box-primary">
                            <div class="box-body">
                               <div class="row">
                              <div class="col-md-2"><label>Payment Number:</label></div>
                              <div class="col-md-3"><input type="text" name="" class="form-control" disabled value=""></div>
                          </div>

                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2"><label>Tenant Name:</label></div>
                              <div class="col-md-8"><input type="text" name="" class="form-control" disabled value="{{$contract->StallRental->StallHolder->stallHFName}} {{$contract->StallRental->StallHolder->stallHMName}} {{$contract->StallRental->StallHolder->stallHLName}}"></div>
                          </div>

                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2"><label>Stall Code:</label></div>
                              <div class="col-md-3"><input type="text" name="" class="form-control" disabled value="{{$contract->StallRental->stallID}}" 
                              ></div>
                               <div class="col-md-2"><label>Business Name:</label></div>
                              <div class="col-md-3">
                               <input type="text" name="" class="form-control" disabled value="{{$contract->StallRental->businessName}}">
                           
                              </div>
                          </div>

                          <div class="row" style="margin-top: 10px;">
                              <div class="col-md-2">
                                  <label>Date From:</label>
                              </div>
                              <div class="col-md-3">
                                <input type="text" name="" class="form-control" disabled value="{{$lastCollection}}">
                              </div>

                              <div class="col-md-2">
                                  <label>Date To:</label>
                              </div>
                              <div class = "col-md-3">
                                  <input type="text" class="datepicker form-control" id='dateTo' name='dateTo' readonly="true" style="cursor:pointer; background-color: #FFFFFF;"/>
                              </div>

                                    
                          </div>


                        <div class="box  box-primary">
                        <div class="box-body">

                          <div class="table-responsive">
                            <table id="tblpay" class="table table-bordered table-striped" role="grid">
                              <thead>
                                  <th>Date</th>
                                  <th>Description</th>
                                  <th>Amount</th>
                                
                               
                              </thead>
                            </table>
                          </div>
                        </div>
                      </div>
                        </div>
                    </div>
                 
                    <!-- tab2primary -->
                </div>
                <!-- tab content-->
            </div>
            <!-- panel body-->
        </div>
        <!-- panel with-nav-tabs-->
    </div>
    <!-- col-md-12 -->
</div>
<!-- row -->


@stop
@section('script')
<script type="text/javascript">
   $(document).on('ready',function(){

        $(".datepicker").datepicker({
        showOtherMonths: true
        , selectOtherMonths: true
        , changeMonth: true
        , changeYear: true
        , autoclose: true
        , startDate: "{{$nextCollection}}"
        , orientation: 'bottom'
        ,format: 'yyyy-mm-dd'
    });

  $("#dateTo").on('change',function () {

    
  });

    });   
  

</script>
@stop