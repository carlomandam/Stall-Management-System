@extends('layout.app')

@section('title')
{{'Balance Summary Report'}}
@stop
@section('content-header')

<ol class="breadcrumb">
  <li><i class="fa fa-dashboard"></i>Reports</li>
  <li class="active">Stall Status Report</li>
</ol>

<style>
    .yellow{
      background-color: #f7e64c;
      color:black;
    }
    .label{
      font-size:14px;
    }
    th,td{
      text-align: center;
    }
    tfoot > tr > th{
      text-align: left;
    }
  
</style>
@stop

@section('content')
<div>
    
    <div class="box box-solid box-default">

        <div class="box-body" >
       
        <div class = "col-xs-12"> 
          <div class="defaultNewButton">  
            <div class=" pull-right" id="print" style="margin-right: 20px; "> <a href="" class="btn btn-success btn-flat"  style="width: 200px;"><span class='fa fa-print'></span>&nbsp;Generate</a>
            </div>
          </div>
            
           
            <div class="col-md-12">

                  <div class="box box-solid box-primary" style= "margin-top: 20px;">
                        <div class="box-header with-border">
                          <h4><center>Balance Summary as of today({{Carbon\Carbon::today()->format('F d,Y')}} )</center> </h4>
                         
                        </div>
                        <div>
                              <div class="box-body">
                               
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 

                                           <table id="tblBalance" class="table table-bordered table-striped table-responsive" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>Stall Code</th>
                                                    <th>Tenant Name</th>
                                                    <th>Collection Status</th>
                                                    <th>Total Balance</th>
                                                  </tr>
                                                </thead> 
                                                <tfoot>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                       <th  style="text-align: right;">Total Amount Receivables:</th>
                                                       <th  ></th>
                                                    
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
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 $('#tblBalance').dataTable({
    responsive:true,
    autoWidth:false,
    destroy:true
 });
 $(document).on('ready',function(){
$.ajax({
          type: "GET"
        , url: "/getBalanceSummary"
            }).done(function (data) {
                var table = $('#tblBalance').DataTable({
               
                    "aaData": data
                    , destroy: true
                    ,"columns": [
                        {
                            "data": "stallID"

                        }
                        , {
                            "data": "name"
                        }
                        ,{
                           "data" : "status"
                        }
                        , {
                            "data": "amount"
                        }

                        
               ]
              });
                  $('#tblBalance').dataTable({
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
                    return intVal(    a) + intVal(b);
                     }, 0 ));
                   
                   
                    }
                });
            });

 });

 

</script>
@stop