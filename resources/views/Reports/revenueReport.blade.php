@extends('layout.app')

@section('title')
{{'Payments Collected Report'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Reports</li>
  <li class="active">Payments Collected Report</li>
</ol>

<style>
    .yellow{
      background-color: #f7e64c;
      color:black;
    }
    .label{
      font-size:14px;
    }
    th{
      text-align: center;
    }
    tfoot > tr > th{
      text-align: left;
    }
 
</style>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css')}}">

@stop

@section('content')
<div>
    
    <div class="box box-solid box-default">

        <div class="box-body" >
       
        <div class = "col-xs-12"> 
        <div class = "col-md-5">
           <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
           <span></span> <b class="caret"></b>
            </div>
             
           
        </div>
           
         
            
           
            <div class="col-md-12">

                  <div class="box box-solid box-primary" style= "margin-top: 20px;">
                        <div class="box-header with-border">
                          <h4 ><center>Payments Collected Report for </center></h4>
                          <h4 id = "reportName" style="text-align: center;">
                          </h4>
                         
                        </div>
                        <div>
                              <div class="box-body">
                               
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 

                                           <table id="tblRevenue" class="table table-bordered table-striped table-responsive" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>Payment Number</th>
                                                    <th>Tenant Name</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                  </tr>
                                                </thead> 
                                                <tfoot>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>Total Amount Received</th>
                                                       <th></th>
                                                       
                                                    
                                                  </tr>
                                                </tfoot>
                                              
                                            </table>
                                          </div>
                                    </div>  
                              </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script')
<script type="text/javascript"  src = "{{URL::asset('assets/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src = "{{URL::asset('assets/daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 $('#tblRevenue').dataTable({
    responsive:true,
    autoWidth:false,
    destroy:true
 });
 $(document).on('ready',function(){
$(function() {

    var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          var startdate = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
          var enddate = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD')
          if(enddate == startdate)
          {
              $('#reportName').text(""+start.format('MMMM D, YYYY'));
          }
          else{
        $('#reportName').text(""+start.format('MMMM D, YYYY')+" to "+end.format('MMMM D, YYYY') );
      }
     
       $.ajax({
          type: "GET"
        , url: "/getPayment"
        ,data: {
          'startdate' :  startdate,
          'enddate' : enddate

        }
            }).done(function (data) {
                var table = $('#tblRevenue').DataTable({
               
                    "aaData": data
                    , destroy: true
                    ,"columns": [
                        {
                            "data": "paymentID"

                        }
                        ,{
                            "data": "tenantName"
                        }
                        ,{
                            "data" : "paymentDate"
                        }
                        , {
                            "data": "totalAmt"
                        }
                        

                        
               ]
              });
                  $('#tblRevenue').dataTable({
                    destroy: true
                    , "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                       var api = this.api(), aaData;
                        // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };       
                    $( api.column( 3 ).footer() ).html( api.column( 3 ).data().reduce( function ( a, b ) {
                    return (intVal(a) + intVal(b)).toFixed(2);
                     }, 0 ));
                   
                   
                    }
                });
            });

    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});




 });



</script>
@stop