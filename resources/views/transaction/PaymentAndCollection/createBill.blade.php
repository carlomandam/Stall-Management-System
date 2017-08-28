@extends('layout.app')

@section('title')
{{ 'Create Bill'}}
@stop
@section('style')

<style type="text/css">
    .col-md-12{
        margin-top: 10px;
    }
    thead{
     background-color: #DBDADA;
    }
</style>
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i> Payment and Collections</li>
  <li>Create Bill</li>
</ol>
@stop


@section('content')
<a class="btn btn-primary btn-flat" style="margin-left: 20px; margin-bottom: 10px;" href="{{ url('/Payment')}}"><span class='fa fa-arrow-left'></span>&nbspBack to Payment and Collections</a>
 <div class="box box-primary">
  <div class = "box-header with-border"> 
    <h4 class="box-title">Billing Information</h4>
  </div>
      <div class="box-body">
         <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class = "col-md-2">
                        <label for="billno">Bill Number</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="billno" name="billno" readonly="" />
                    </div>

                    <div class = "col-md-2">
                      <label for="billno">Bill Date</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="billdate" name="billdate" readonly="" style="text-align: left;" />
                    </div>
                </div>
            </div>
                 
         </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class = "col-md-2">
                  <label for="billto">Select Stallholder</label><span class="required">&nbsp*</span>
                </div>
                <div class = "col-md-8">
                     <select class="js-example-multiple-limit" style="width: 100%;  " id="ven_name" name="ven_name"> </select>
                </div>
             </div>
          </div>


          <div class="col-md-12">
                <div class="form-group">
                    <div class = "col-md-2">
                    <label>Bill From</label>
                    </div>
                  <div class = "col-md-3">
                    <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input type="text" class="form-control pull-right" id="datepicker" name="startDate">
                    </div>
                  </div>

                  <div class = "col-md-2">
                  <label>Bill To</label>
                  </div>
                  <div class = "col-md-3">
                    <div class="input-group date">
                                <div class="input-group-addon"> <i class="fa fa-calendar"></i> </div>
                                <input type="text" class="form-control pull-right" id="datepicker_end" name="endDate"> 
                    </div>
                  </div>
                 
              </div>
            </div>


         
     
      </div>

</div>
@stop

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
        $datenow =  (new Date()).toString().split(' ').splice(1,3).join(' ');
        $('#billdate').val($datenow);

         $('.js-example-basic-multiple').select2({
            width: 'resolve'
        });

           //INITIALIZE DATEPICKER//
        $("#datepicker").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "dateToday"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
        //INITIALIZE DATEPICKER//
        $("#datepicker_end").datepicker({
            showOtherMonths: true
            , selectOtherMonths: true
            , changeMonth: true
            , changeYear: true
            , autoclose: true
            , startDate: "dateToday"
            , todayHighlight: true
            , orientation: 'bottom'
            , format: 'yyyy-mm-dd'
        });
    });

    $.ajax({
    url: "",
    error: function(){
        alert('meow');
    },
    success: function(){
        //do something
    },
    timeout: 1000 // sets timeout to 3 seconds
    });


  </script>
@stop