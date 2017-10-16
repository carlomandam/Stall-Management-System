@extends('layout.app')

@section('title')
{{'Status List Report'}}
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
    th{
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
          <div class = "col-md-6">
              <select class="form-control" id = "bldg">
               <option value="" selected disabled>-- SELECT BUILDING --</option>
              @if(isset($building) && count($building)> 1)
                  @foreach($building as $build)
                  <option value = "{{$build->bldgID}}">{{$build->bldgName}}</option>
                    @endforeach
              @else
                   @foreach($building as $build)
                  <option value = "{{$build->bldgID}}" selected="">{{$build->bldgName}}</option>     
                      @endforeach
              @endif

            </select>

          </div>
        </div>
            
           
            <div class="col-md-12">

                  <div class="box box-solid box-primary" style= "margin-top: 20px;">
                        <div class="box-header with-border">
                          <h4><center>Status List Report as of today({{Carbon\Carbon::today()->format('F d,Y')}} )</center> </h4>
                          <h4 id = "bldgName" style="text-align: center;">
                          @if(isset($building) && count($building)==1)

                          @foreach($building as $build)
                          in Building{{$build->bldgName}}
                          @endforeach
                          @endif
                          </h4>
                        </div>
                        <div>
                              <div class="box-body">
                               
                                    <div class="col-xs-12">
                                          <div class="table-responsive"> 

                                           <table id="tblStatus" class="table table-bordered table-striped table-responsive" role="grid" style="font-size:15px;">
                                                <thead>
                                                  <tr>
                                                    <th>Collection Status</th>
                                                    <th>No. of Stall/s</th>
                                                    <th>Total Amount</th>
                                                  </tr>
                                                </thead> 
                                                <tfoot>

                                                    <tr>
                                                   
                                                       <th ></th>
                                                       <th></th>
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
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
 $('#stallList').dataTable({
    responsive:true,
    autoWidth:false,
    destroy:true
 });
 $(document).on('ready',function(){
$('#tblStatus').dataTable();

 });
 $('#bldg').on('change',function(){
      $('#bldgName').text("in " + $('#bldg').find(":selected").text() +" Building"); 
      $.ajax({
          type: "GET"
        , url: "/getStallStatusReport"
        , data: {
                  'bldgID': $('#bldg').val()
                }
            }).done(function (data) {
                var table = $('#tblStatus').DataTable({
               
                    "aaData": data
                    , destroy: true
                    ,"columns": [
                        {
                            "data": "status"

                        }
                        , {
                            "data": "count"
                        }
                        , {
                            "data": "amount"
                        }

                        
               ]
              });
                  $('#tblStatus').dataTable({
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
                    $( api.column( 1 ).footer() ).html("Total Stall/s: " +
                    api.column( 1 ).data().reduce( function ( a, b ) {
                    return intVal(a) + intVal(b);
                     }, 0 )
                    );
                    $( api.column( 2 ).footer() ).html("Total Amount Receivables: Php " +
                    api.column( 2 ).data().reduce( function ( a, b ) {
                    return intVal(a) + intVal(b);
                     }, 0. )
                    );
                    }
                });
            });
 });
 

</script>
@stop