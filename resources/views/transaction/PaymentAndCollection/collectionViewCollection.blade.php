@extends('layout.app')

@section('title')
{{'Collections'}}
@stop
@section('content-header')

@stop

@section('content')

    <div class="box box-primary">
        <div class="box-body">
        <form>
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
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
                                  <label>Date:</label>
                              </div>
                              <div class="col-md-8">
                              <input type="text" name="" id = "dateFrom" name = "dateFrom" class="form-control" disabled value="{{$first}} - {{$lastDate}}">
                              </div>

                                    
                          </div>


                      <div class="box  box-primary" style="margin-top: 40px;">
                        <div class="box-body">

                          <div class="table-responsive">
                            <table id="tblcollect" class="table table-bordered table-striped" role="grid">
                              <thead>
                                  <th>Date</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Amount</th>

                                
                               
                              </thead>

                              <tbody>
                              @foreach($data as $d)
                                <tr>
                                  <td>{{$d['date']}}</td>
                                  <td>{{$d['desc']}}</td>
                                  <td>Unpaid</td>
                                  <td>{{$d['amount']}}</td>
                                </tr>
                              @endforeach
                              </tbody>

                              <tfoot>
                                <tr >
                                  <th colspan = "3" style="text-align: right; ">Total:</th> 
                                  <th>Php {{$totalAmt}}</th>
                                </tr>
                              </tfoot>
                             
                            </table>
                          </div>
                        </div>
  </div>
</form>

                        <div class = "pull-right">
                          <div class = "col-md-12" >
                            <button class="btn btn-primary btn-flat"  disabled id = "save" style="width:100px; margin: 20px;"> <i class=""></i>Update</button>
                          </div>
                        </div>
                      </div>
    </div>
</div>

@stop
@section('script')
<script type="text/javascript" src ="{{ URL::asset('js/billing.js') }}"></script>
<script type="text/javascript">
     
$(document).on('ready',function(){

         

        $('#tblcollect').dataTable({
            destroy:true,
           "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                /*
                 * Calculate the total market share for all browsers in this table (ie inc. outside
                 * the pagination)
                 */
                var iTotalMarket = 0;
                for ( var i=0 ; i<aaData.length ; i++ )
                {

                    iTotalMarket += parseFloat(aaData[i][3])*1 ;
                }

                /* Calculate the market share for browsers on this page */
                var iPageMarket = 0;
                for ( var i=iStart ; i<iEnd ; i++ )
                {
                    iPageMarket += parseFloat(aaData[ aiDisplay[i] ][3])*1;
                }

                /* Modify the footer row to match what we want */
                var nCells = nRow.getElementsByTagName('th');
                nCells[1].innerHTML = "Php "+" "+parseFloat(iPageMarket).toFixed(2)+" (Php "+parseFloat(iTotalMarket).toFixed(2)+" total)" ;
            }
        });
        });  
         
        });
 
});

    

       

</script>
@stop