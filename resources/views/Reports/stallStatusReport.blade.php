@extends('layout.app')

@section('title')
{{'Stall Status Report'}}
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
    
</style>
@stop

@section('content')
<div>
    
    <div class="box box-solid box-default">

        <div class="box-body" >
       
        <div class = "col-xs-12">
            <div class="dropdown-holder">
              <div class="dropdown">
                  <button class="btn btn-primary btn-flat btn-city dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="margin-top: 20px; width: 200px;">
                      -- Select -- 
                     <span class="caret caret-search"></span>
                     </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 200px;">
                            <li><a href="#">Daily</a></li>
                            <li><a href="#">Weekly</a></li>
                            <li><a href="#">Monthly</a></li>
                            <li><a>Yearly</a></li>
                            <li><a href="#">Custom Date</a></li>
                          </ul>
                  </div>
                </div>
              </div>
           
            <div class="col-md-12">
                  <div class="box box-solid box-primary" style= "margin-top: 20px;">
                        <div class="box-header with-border">
                          <h5 style="display: none;"><center>Stall Status Report for</center> </h5>
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


</script>
@stop